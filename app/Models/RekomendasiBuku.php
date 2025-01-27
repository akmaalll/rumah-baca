<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekomendasiBuku extends Model {
    protected $table = 'rekomendasi_bukus';

    protected $fillable = [
        'user_id',
        'buku_id',
        'skor_rekomendasi'
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
