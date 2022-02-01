<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class TotalPatientsPerDistrict extends Model implements AuthenticatableContract, AuthorizableContract
{
		use Authenticatable, Authorizable, Userstamps, Rememberable;

		public $rememberCacheTag = 'total_patients_per_district_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * Exclude from json form.
     *
     */
    protected $hidden = [
      'region_id', 'district_id'      
    ];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'total_patients_per_district';
}
