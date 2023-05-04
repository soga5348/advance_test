<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'email',
        'postal_code',
        'address',
        'building',
        'message',
        'created_at',
        'firstname',
        'lastname',

    ];
}


