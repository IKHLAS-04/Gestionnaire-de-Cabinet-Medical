<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment; // Importe le modèle pour les rendez-vous
use Carbon\Carbon;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // Dans ton DashboardController
    public function index()
    {
        // On récupère tous les patients appartenant au médecin connecté
        $patients = \App\Models\Patient::where('user_id', auth()->id())->get();

        // On renvoie vers la vue LISTE des patients, pas le dashboard !
        return view('patients.index', compact('patients'));
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
        // 1. Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'notes' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf|max:2048',
            'prochain_rdv' => 'nullable|date',
            'prix' => 'nullable|numeric',
        ], [
            'document.mimes' => 'Le document doit impérativement être au format PDF.',
            'document.max' => 'Le fichier est trop lourd (maximum 2Mo).',
        ]);

        // 2. Gestion du fichier PDF
        if ($request->hasFile('document')) {
            $validated['document_path'] = $request->file('document')->store('documents', 'public');
        }

        // 3. Ajout du user_id
        $validated['user_id'] = auth()->id();

        // 4. CRÉATION DU PATIENT
        // On retire 'prochain_rdv' ET 'prix' car ils vont dans la table appointments
        $patientData = collect($validated)->except(['prochain_rdv', 'prix'])->toArray();
        $patient = \App\Models\Patient::create($patientData);

        // 5. CRÉATION DU RENDEZ-VOUS
        if (!empty($validated['prochain_rdv'])) {
            \App\Models\Appointment::create([
                'user_id' => auth()->id(),
                'patient_id' => $patient->id,
                'appointment_date' => $validated['prochain_rdv'],
                'prix' => $validated['prix'] ?? 0,
                'motif' => 'Première consultation',
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
    public function update(Request $request, string $id)
    {
        try {
            // 1. On cherche le patient
            $patient = \App\Models\Patient::findOrFail($id);

            // 2. Validation (Sécurité : on vérifie les nouvelles données)
            $validated = $request->validate(
                [
                    'nom' => 'required|string|max:255',
                    'prenom' => 'required|string|max:255',
                    'telephone' => 'required|string|max:20',
                    'notes' => 'nullable|string',
                    'document' => 'nullable|file|mimes:pdf|max:2048',
                    'prochain_rdv' => 'nullable|date',
                ],
                [
                    'document.mimes' => 'Le document doit être au format PDF.',
                ]
            );
            if ($request->hasFile('document')) {
                $path = $request->file('document')->store('documents', 'public');
                $validated['document_path'] = $path;
            }


            // 3. Mise à jour dans la base de données
            $patient->update($validated);

            // 4. Redirection avec message de succès
            return redirect()->route('patients.index')->with('success', 'La fiche du patient a été mise à jour !');

        } catch (\Exception $e) {
            return redirect()->route('patients.index')->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
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
