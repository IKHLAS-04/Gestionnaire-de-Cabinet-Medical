<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // On liste les colonnes que Laravel a le droit d'écrire d'un coup
    protected $fillable = [
        'patient_id',
        'appointment_date',
        'prix',
        'motif',
    ];

    // N'oublie pas de définir la relation pour ton Dashboard
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
