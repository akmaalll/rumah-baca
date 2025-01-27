<?php

namespace Database\Seeders;

use App\Models\KategoriBuku;
use App\Models\PreferensiUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferensiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengguna = User::where('role', 'user')->get();
        $kategori = KategoriBuku::all();

        foreach ($pengguna as $user) {
            // Setiap user memiliki preferensi untuk 2-4 kategori
            $jumlahPreferensi = rand(2, 4);
            $kategoriRandom = $kategori->random($jumlahPreferensi);

            foreach ($kategoriRandom as $kat) {
                PreferensiUser::create([
                    'user_id' => $user->id,
                    'kategori_id' => $kat->id,
                    'bobot_preferensi' => rand(1, 100) / 100 // Generate nilai random 0.01-1.00
                ]);
            }
        }
    }
}
