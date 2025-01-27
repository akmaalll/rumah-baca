<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    protected $table = 'kategori_bukus';

    protected $fillable = [
        'nama_kategori',
        'sub_kategori',
        'deskripsi',
    ];
}
