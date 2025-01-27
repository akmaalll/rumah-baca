<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $fillable = [
        'kategori_id',
        'sub_kategori',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'deskripsi',
        'tag',
        'bahasa',
        'jumlah_halaman',
        'image'
    ];

    public function kelompok()
    {
        return $this->hasOne(ClusterBuku::class);
    }

    public function rekomendasi()
    {
        return $this->hasMany(RekomendasiBuku::class);
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class,  'kategori_id');
    }
}
