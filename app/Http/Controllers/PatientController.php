<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment; // Importe le modèle pour les rendez-vous
use Carbon\Carbon;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // Dans ton DashboardController
    public function index()
    {
        $appointments = Appointment::whereHas('patient', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('appointments.index', compact('appointments'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // 1. Récupération des données validées (inclut 'prochain_rdv' venant du formulaire)
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required',
            'date_naissance' => 'required|date',
            'notes' => 'nullable|string',
            'prochain_rdv' => 'nullable',
            'prix' => 'nullable|numeric',
        ]);
        $patient = new \App\Models\Patient();
        // 2. Extraction de la date pour la table 'appointments'
        $prochainRdv = $data['prochain_rdv'] ?? null;

        // 3. Suppression du champ pour éviter l'erreur "Column not found" dans la table 'patients'
        unset($data['prochain_rdv']);

        // 4. Hydratation et sauvegarde sécurisée du patient
        $patient->fill($data);
        $patient->user_id = auth()->id();
        $patient->save();

        // 5. Création automatique du rendez-vous lié dans la table dédiée
        if ($prochainRdv) {
            $patient->appointments()->create([
                'appointment_date' => $prochainRdv,
                'prix' => $validated['prix'] ?? 0,
                'motif' => 'Consultation'
            ]);
        }

        return redirect()->route('patients.index')->with('success', 'Patient et rendez-vous créés !');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = \App\Models\Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = \App\Models\Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. On récupère le patient
        $patient = \App\Models\Patient::findOrFail($id);

        // 2. On assigne CHAQUE champ manuellement (sans passer par validation pour ce test)
        $patient->nom = $request->nom;
        $patient->prenom = $request->prenom;
        $patient->telephone = $request->telephone;
        $patient->date_naissance = $request->date_naissance;
        $patient->notes = $request->notes;
        // On sauvegarde d'abord les infos du patient (Nom, Prénom, etc.)
        $patient->save();

        // On ne met à jour le rendez-vous QUE si une date a été saisie
        if ($request->filled('prochain_rdv')) {
            $patient->appointments()->updateOrCreate(
                ['patient_id' => $patient->id],
                [
                    'appointment_date' => $request->prochain_rdv,
                    'motif' => $request->input('motif', 'Consultation') // Prend le motif du formulaire, sinon met 'Consultation' par défaut
                ]
            );
        }

        // 4. On nettoie tout
        \Illuminate\Support\Facades\Artisan::call('view:clear');

        return redirect()->route('patients.index')->with('success', 'Fiche mise à jour en base de données !');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // 1. On cherche le patient dans la base de données grâce à son ID
            $patient = \App\Models\Patient::findOrFail($id);

            // 2. On le supprime
            $patient->delete();

            // 3. On revient sur la liste avec un message de succès
            return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès !');

        } catch (\Exception $e) {
            // En cas de problème (ex: patient déjà supprimé), on affiche l'erreur
            return redirect()->route('patients.index')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
