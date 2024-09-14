<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;


class NganhNghe extends Model
{
    protected $collection = "nganhnghe";
    protected $fillable = [
        'ten',
        'linhvuc_id',
    ];

    public function linhvuc()
    {
        return $this->belongsTo(LinhVuc::class, 'linhvuc_id', '_id');
    }
}
