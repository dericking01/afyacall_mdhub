<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Zone extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Userstamps, Rememberable;

    public $rememberCacheTag = 'zone_queries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
    ];

    /**
     * Get regions.
     */
    public function regions()
    {
        return $this->hasMany('App\Model\Region');
    }
}
