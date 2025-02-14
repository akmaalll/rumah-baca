<?php

namespace Database\Seeders;

use App\Models\KategoriBuku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['nama_kategori' => 'Teknologi', 'sub_kategori' => 'Pemrograman'],
            ['nama_kategori' => 'Sastra', 'sub_kategori' => 'Novel'],
            ['nama_kategori' => 'Sains', 'sub_kategori' => 'Fisika'],
            ['nama_kategori' => 'Sejarah', 'sub_kategori' => 'Perang Dunia'],
            ['nama_kategori' => 'Bisnis', 'sub_kategori' => 'Manajemen']
        ];

        foreach ($categories as $category) {
            KategoriBuku::create($category);
        }
    }
}
