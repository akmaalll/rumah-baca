<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukuData = [
            ['kategori_id' => 1, 'judul' => 'Laravel for Beginners', 'penulis' => 'John Doe', 'penerbit' => 'TechPress', 'tahun_terbit' => 2021, 'isbn' => Str::random(13)],
            ['kategori_id' => 2, 'judul' => 'Novel Misterius', 'penulis' => 'Jane Smith', 'penerbit' => 'FictionHouse', 'tahun_terbit' => 2019, 'isbn' => Str::random(13)],
            ['kategori_id' => 3, 'judul' => 'Quantum Mechanics', 'penulis' => 'Albert Einstein', 'penerbit' => 'ScienceWorld', 'tahun_terbit' => 2020, 'isbn' => Str::random(13)],
            ['kategori_id' => 4, 'judul' => 'WWII History', 'penulis' => 'Winston Churchill', 'penerbit' => 'HistoryBooks', 'tahun_terbit' => 2018, 'isbn' => Str::random(13)],
            ['kategori_id' => 5, 'judul' => 'Startup Success', 'penulis' => 'Elon Musk', 'penerbit' => 'BusinessPro', 'tahun_terbit' => 2022, 'isbn' => Str::random(13)]
        ];

        foreach ($bukuData as $buku) {
            Buku::create($buku);
        }
    }
}
