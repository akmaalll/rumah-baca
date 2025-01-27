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
            [
                'nama_kategori' => 'Teknologi',
                'sub_kategori' => 'Pemrograman',
                'deskripsi' => 'Buku-buku tentang pemrograman dan pengembangan software'
            ],
            [
                'nama_kategori' => 'Teknologi',
                'sub_kategori' => 'Data Science',
                'deskripsi' => 'Buku-buku tentang analisis data dan machine learning'
            ],
            [
                'nama_kategori' => 'Bisnis',
                'sub_kategori' => 'Manajemen',
                'deskripsi' => 'Buku-buku tentang manajemen dan kepemimpinan'
            ],
            [
                'nama_kategori' => 'Bisnis',
                'sub_kategori' => 'Kewirausahaan',
                'deskripsi' => 'Buku-buku tentang memulai dan mengelola bisnis'
            ],
            [
                'nama_kategori' => 'Sains',
                'sub_kategori' => 'Fisika',
                'deskripsi' => 'Buku-buku tentang ilmu fisika'
            ]
        ];

        foreach ($categories as $category) {
            KategoriBuku::create($category);
        }
    }
}
