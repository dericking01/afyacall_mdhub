<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Call extends Model
{
    /**
     * Get doctor.
     */
    public function doctor()
    {
        return $this->belongsTo('App\Model\Doctor');
    }

    public function user()
    {
        return $this->belongsTo('App\User','doctor_id');
    }

    /**
     * Get patient.
     */
    public function patient()
    {
        return $this->belongsTo('App\Model\Patient');
    }
}
