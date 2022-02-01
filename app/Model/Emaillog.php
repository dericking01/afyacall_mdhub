<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Emaillog extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id', 'to', 'message', 'status',
    ];
}
