<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'ten',
        'phone'
    ];
}
