<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Banner extends Model
{
    protected $collection = "banner";
    protected $fillable = [
        'ten',
        'hinhanh',
        'thutu',
        'trangthai',
    ];
}
