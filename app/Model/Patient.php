<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{

    // One Patient has Many Prescriptions relationship
    public function prescriptions() {
        return $this->hasMany('App\Model\Prescription','patient_id','id');
    }

    public function region()
    {
        return $this->belongsTo('App\Model\Region','region_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Model\District','district_id');
    }

    public function age()
    {
        return $this->date_of_birth;
    }


    public static function getNextPatientNumber()
    {
        $lastNumber = Patient::orderBy('created_at', 'desc')->first();
        if (!$lastNumber) {
            $number = 0;
        } else {
            $number =explode("-",$lastNumber->pat_no);
            $number = $number[1];
        }
        return sprintf('%06d', intval($number) + 1);
    }
}
