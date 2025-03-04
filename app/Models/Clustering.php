<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    protected $table = 'clusterings';

    protected $fillable = [
        'user_id',
        'jumlah_cluster',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
