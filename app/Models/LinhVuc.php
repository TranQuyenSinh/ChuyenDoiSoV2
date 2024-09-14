<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class LinhVuc extends Model
{
    protected $collection = "linhvuc";
    protected $fillable = [
        'ten',
        'hinhanh'
    ];
}
