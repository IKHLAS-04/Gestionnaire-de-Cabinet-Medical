<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = \App\Models\Patient::all();
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
    // On vérifie que les données sont conformes pour éviter les injections
    {
        $validated = $request->validate(
            [
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'telephone' => 'required|string|max:20',
                'date_naissance' => 'required|date',
                'antecedents' => 'nullable|string',
                'document' => 'nullable|file|mimes:pdf|max:2048',
            ],
            [
                'document.mimes' => 'Le document doit impérativement être au format PDF.',
                'document.max' => 'Le fichier est trop lourd (maximum 2Mo).',
            ]
        );

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('ordonnances', 'private');
            $validated['document_path'] = $path;
        }
        //Création du patient dans la base 
        \App\Models\Patient::create($validated);

        return redirect()->route('dashboard')->with('success', 'Patient ajouté avec succés !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
