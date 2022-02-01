<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChiefComplaint extends Model
{
    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'prescription_chiefcomplaints');
    }
}
