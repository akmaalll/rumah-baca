<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    protected $table = 'kategori_bukus';

    protected $fillable = [
        'nama_kategori',
        'sub_kategori',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
