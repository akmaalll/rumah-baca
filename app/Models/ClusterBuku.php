<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClusterBuku extends Model
{
    protected $table = 'cluster_bukus';

    protected $fillable = [
        'buku_id',
        'level_kelompok',
        'nama_kelompok'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
