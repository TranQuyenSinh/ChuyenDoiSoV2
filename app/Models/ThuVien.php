<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ThuVien extends Model
{
    protected $collection = "thuvien";
    protected $fillable = [
        'ten',
        'file',
        'namphathanh',
        'hinhanh',
        'loai'
    ];
}