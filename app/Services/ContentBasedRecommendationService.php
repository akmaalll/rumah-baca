<?php

namespace App\Services;

use App\Models\Buku;
use App\Models\RekomendasiBuku;
use App\Models\PreferensiUser;

class ContentBasedRecommendationService
{
    public function generateRecommendations($userId)
    {
        // Ambil preferensi pengguna
        $preferensi = PreferensiUser::where('user_id', $userId)->get();
        // dd($preferensi);


        if ($preferensi->isEmpty()) {
            return []; // Jika tidak ada preferensi, tidak ada rekomendasi
        }

        $rekomendasi = [];

        // Looping setiap preferensi pengguna
        foreach ($preferensi as $pref) {
            // Ambil semua buku yang sesuai dengan kategori preferensi
            $bukus = Buku::where('kategori_id', $pref->kategori_id)->get();


            foreach ($bukus as $buku) {
                // Hitung skor rekomendasi
                $skor = $pref->bobot_preferensi; // Bisa dikalikan faktor tambahan jika ada

                // Simpan rekomendasi ke array
                $rekomendasi[] = [
                    'user_id' => $userId,
                    'buku_id' => $buku->id,
                    'skor_rekomendasi' => $skor
                ];
            }
        }

        // Simpan rekomendasi ke database
        RekomendasiBuku::where('user_id', $userId)->delete(); // Hapus rekomendasi lama
        RekomendasiBuku::insert($rekomendasi);

        return $rekomendasi;
    }
}
