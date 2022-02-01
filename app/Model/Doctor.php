<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Model\Region','region_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Model\District','district_id');
    }

    public function getFullNameAttribute($value)
    {
       return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
    
    public function patients() {
        return $this->hasMany('App\Model\Patient','doctor_id','id');
    }

    public function schedules() {
        return $this->hasMany('App\Model\Schedule','doctor_id','id');
    }
}
