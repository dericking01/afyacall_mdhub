<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Schedule extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Userstamps, Rememberable;

    public $rememberCacheTag = 'schedule_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'date',
      'start_time',
      'end_time',
    ];

    /**
     * Exclude from json form.
     *
     */
    protected $hidden = [
        'doctor_id',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Model\Doctor','doctor_id');
    }

}
