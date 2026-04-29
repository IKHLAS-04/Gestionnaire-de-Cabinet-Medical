<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // 1. Tes statistiques actuelles (Total et Récents)
    $stats = [
        'total' => \App\Models\Patient::count(),
        'recents' => \App\Models\Patient::latest()->take(5)->get(),
    ];

    // 2. LA NOUVEAUTÉ : Tes futurs rendez-vous pour l'agenda
    $rdvs = \App\Models\Patient::whereNotNull('prochain_rdv')
        ->where('prochain_rdv', '>=', now())
        ->orderBy('prochain_rdv', 'asc')
        ->take(5)
        ->get();

    // 3. On envoie les DEUX variables à la vue
    return view('dashboard', compact('stats', 'rdvs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::resource('patients', PatientController::class)->middleware(['auth']); // seules les personnes qui sont connectés peuvent accéder aux patients