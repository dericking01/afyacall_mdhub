<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Wildside\Userstamps\Userstamps;
use Watson\Rememberable\Rememberable;

class Street extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Userstamps, Rememberable;

    public $rememberCacheTag = 'street_queries';

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
        'ward_id',
    ];

    /**
     * Get ward.
     */
    public function ward()
    {
        return $this->belongsTo('App\Model\Ward');
    }

    public function pos()
    {
        return $this->hasMany('App\Model\Pos');
    }
}
