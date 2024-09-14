<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class TinTuc extends Model
{
    protected $collection = "tintuc";
    protected $fillable = [
        'linhvuc_id',
        'user_id',
        'tieude',
        'tomtat',
        'hinhanh',
        'noidung',
        'luotxem',
        'nguon',
        'trangthai',
    ];

    public function linhvuc()
    {
        return $this->belongsTo(LinhVuc::class, "linhvuc_id", "_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "_id");
    }
}
