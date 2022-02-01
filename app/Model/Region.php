<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Region extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Userstamps, Rememberable;

    public $rememberCacheTag = 'region_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'postcode',
    ];

    /**
     * Exclude from json form.
     *
     */
    protected $hidden = [
        'zone_id',
    ];

    /**
     * Get zone.
     */
    public function zone()
    {
        return $this->belongsTo('App\Model\Zone');
    }

    /**
     * Get districts.
     */
    public function districts()
    {
        return $this->hasMany('App\Model\District');
    }
}
