<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\ClusterBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClusterBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClusterBuku::create([
            ['buku_id' => 1, 'nama_kelompok' => 'Kelompok A'],
            ['buku_id' => 2, 'nama_kelompok' => 'Kelompok B'],
            ['buku_id' => 3, 'nama_kelompok' => 'Kelompok A'],
            ['buku_id' => 4, 'nama_kelompok' => 'Kelompok C'],
            ['buku_id' => 5, 'nama_kelompok' => 'Kelompok B']
        ]);
    }
}
