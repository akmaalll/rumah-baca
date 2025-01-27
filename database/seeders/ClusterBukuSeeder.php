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
        $buku = Buku::all();
        
        foreach ($buku as $index => $b) {
            ClusterBuku::create([
                'buku_id' => $b->id,
                'level_kelompok' => 1,
                'nama_kelompok' => 'Kelompok ' . ceil(($index + 1) / 3) // 3 buku per kelompok
            ]);
        }
    }
}
