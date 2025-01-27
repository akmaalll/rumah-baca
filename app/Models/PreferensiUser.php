<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferensiUser extends Model
{
    protected $table = 'preferensi_users';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'bobot_preferensi'
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori_id');
    }
}
