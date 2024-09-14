<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Video extends Model
{
    protected $collection = "video";
    protected $fillable = [
        'ten',
        'link',
    ];
}
