<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class District extends Model implements AuthenticatableContract, AuthorizableContract
{
		use Authenticatable, Authorizable, Userstamps, Rememberable;

		public $rememberCacheTag = 'district_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
    ];

    /**
     * Exclude from json form.
     *
     */
    protected $hidden = [
        'region_id',
    ];

    /**
     * Get region.
     */
    public function region()
    {
        return $this->belongsTo('App\Model\Region');
    }

    /**
     * Get wards.
     */
    public function wards()
    {
        return $this->hasMany('App\Model\Ward');
    }

    /**
     * Get streets.
     */
    public function streets()
    {
        return $this->hasManyThrough('App\Model\Street', 'App\Model\Ward');
    }
}
