<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // 1. On récupère les rendez-vous du jour via la table appointments
    // On utilise eager loading (with('patient')) pour éviter trop de requêtes SQL
    $appointments = \App\Models\Appointment::with('patient')
        ->where('user_id', auth()->id())
        ->whereDate('appointment_date', \Carbon\Carbon::today())
        ->orderBy('appointment_date', 'asc')
        ->get();

    // 2. On envoie uniquement $appointments à la vue
    return view('dashboard', compact('appointments'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::resource('patients', PatientController::class)->middleware(['auth']); // seules les personnes qui sont connectés peuvent accéder aux patients