<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\RekomendasiBuku;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekomendasiBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengguna = User::where('role', 'user')->get();
        $buku = Buku::all();

        foreach ($pengguna as $user) {
            // Setiap user mendapat 3-6 rekomendasi
            $jumlahRekomendasi = rand(3, 6);
            if ($buku->count() < $jumlahRekomendasi) {
                $jumlahRekomendasi = $buku->count(); // Ambil semua buku yang tersedia
            }
            $bukuRandom = $buku->random($jumlahRekomendasi);

            foreach ($bukuRandom as $b) {
                RekomendasiBuku::create([
                    'user_id' => $user->id,
                    'buku_id' => $b->id,
                    'skor_rekomendasi' => rand(50, 100) / 100 // Generate nilai random 0.50-1.00
                ]);
            }
        }
    }
}
