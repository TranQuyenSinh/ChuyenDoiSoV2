<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class DoanhNghiep extends Model
{
    protected $collection = "linhvuc";
    protected $fillable = [
        'user_id',
        'nganhnghe_id',
        'ten',
        'nguoidaidien',
        'mota',
        'logo',
        'masothue',
        'email',
        'diachi',
        'dienthoai',
        'website',
    ];
}
