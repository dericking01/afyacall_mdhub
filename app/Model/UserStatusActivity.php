<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserStatusActivity extends Model
{
    protected $fillable = [
        'user_id',
        'new_status',
        'activity',
        'changed_by',
        'source',
        'ip_address',
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo('App\\User', 'user_id');
    }

    public function changedBy()
    {
        return $this->belongsTo('App\\User', 'changed_by');
    }
}