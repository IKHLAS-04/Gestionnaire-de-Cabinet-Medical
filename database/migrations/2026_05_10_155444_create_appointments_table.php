<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        // Relation avec le médecin (SITCN : Isolation des données)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Relation avec le patient
        $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        // On utilise 'appointment_date' pour être clair dans le code
        $table->datetime('appointment_date'); 
        $table->string('motif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
