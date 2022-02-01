<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'symptoms_name',
        'symptoms_note',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'prescription_chiefcomplaints');
    }
}
