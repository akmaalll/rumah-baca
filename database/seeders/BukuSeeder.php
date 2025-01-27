<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukuData = [
            [
                'kategori_id' => 1, // Teknologi - Pemrograman
                'judul' => 'Python for Data Analysis',
                'penulis' => 'Wes McKinney',
                'penerbit' => 'O\'Reilly Media',
                'tahun_terbit' => 2022,
                'isbn' => '9781098104030',
                'deskripsi' => 'Panduan lengkap analisis data dengan Python',
                'tag' => 'python,data analysis,programming,pandas',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 550
            ],
            [
                'kategori_id' => 1,
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'isbn' => '9780132350884',
                'deskripsi' => 'Panduan menulis kode yang bersih dan mudah dipelihara',
                'tag' => 'programming,software engineering,best practices',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 464
            ],
            [
                'kategori_id' => 2, // Teknologi - Data Science
                'judul' => 'Machine Learning with Python',
                'penulis' => 'Sebastian Raschka',
                'penerbit' => 'Packt',
                'tahun_terbit' => 2019,
                'isbn' => '9781789955750',
                'deskripsi' => 'Implementasi machine learning dengan Python',
                'tag' => 'machine learning,python,AI,data science',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 770
            ],
            [
                'kategori_id' => 3, // Bisnis - Manajemen
                'judul' => 'Good to Great',
                'penulis' => 'Jim Collins',
                'penerbit' => 'Harper Business',
                'tahun_terbit' => 2001,
                'isbn' => '9780066620992',
                'deskripsi' => 'Penelitian tentang perusahaan yang berhasil bertransformasi',
                'tag' => 'business,management,leadership,success',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 400
            ],
            [
                'kategori_id' => 4, // Bisnis - Kewirausahaan
                'judul' => 'Zero to One',
                'penulis' => 'Peter Thiel',
                'penerbit' => 'Crown Business',
                'tahun_terbit' => 2014,
                'isbn' => '9780804139298',
                'deskripsi' => 'Notes on startups and how to build the future',
                'tag' => 'startup,entrepreneurship,innovation,business',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 224
            ],
            [
                'kategori_id' => 5, // Sains - Fisika
                'judul' => 'A Brief History of Time',
                'penulis' => 'Stephen Hawking',
                'penerbit' => 'Bantam',
                'tahun_terbit' => 1988,
                'isbn' => '9780553380163',
                'deskripsi' => 'Penjelasan tentang alam semesta untuk pembaca umum',
                'tag' => 'physics,cosmology,science,universe',
                'bahasa' => 'Inggris',
                'jumlah_halaman' => 212
            ]
        ];

        foreach ($bukuData as $buku) {
            Buku::create($buku);
        }
    }
}
