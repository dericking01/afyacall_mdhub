<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Ward extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Userstamps, Rememberable;

    public $rememberCacheTag = 'ward_queries';

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
        'district_id',
    ];

    /**
     * Get district.
     */
    public function district()
    {
        return $this->belongsTo('App\Model\District');
    }

    /**
     * Get streets.
     */
    public function streets()
    {
        return $this->hasMany('App\Model\Street');
    }

    /**
     * Get pos.
     */
    public function pos()
    {
        return $this->hasManyThrough('App\Model\Pos', 'App\Model\Street');
    }
}
