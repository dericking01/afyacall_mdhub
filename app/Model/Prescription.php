<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    // Many Prescriptions to One Patient relationship
    public function patient() {
        return $this->belongsTo('App\Model\Patient','patient_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function chiefcomplaints()
    {
        return $this->belongsToMany(ChiefComplaint::class, 'prescription_chiefcomplaints');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'prescription_symptoms');
    }
}
