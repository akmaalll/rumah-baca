<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\PreferensiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferensiController extends Controller
{
    public function showForm()
    {
        if (PreferensiUser::where('user_id', Auth::id())->exists()) {
            return redirect()->route('user.dashboard'); // Jika sudah, arahkan ke dashboard
        }

        // Ambil data kategori dan buku populer dari database
        $kategoris = KategoriBuku::all();
        $bukuPopuler = Buku::whereIn('kategori_id', $kategoris->pluck('id'))
            ->inRandomOrder() // Ambil secara acak
            ->take(10) // Ambil 10 buku
            ->get();

        return view('pages.rekomendasi.index', compact('kategoris', 'bukuPopuler'));
    }

    public function simpanPreferensi(Request $request)
    {
        $user = Auth::user();
        // dd($user);

        // Simpan preferensi kategori
        if ($request->has('kategori_id')) {
            foreach ($request->kategori_id as $kategoriId) {
                PreferensiUser::create([
                    'user_id' => $user->id,
                    'kategori_id' => $kategoriId,
                    'bobot_preferensi' => 1, // Bobot default
                ]);
            }
        }

        // Simpan preferensi buku
        if ($request->has('buku_id')) {
            foreach ($request->buku_id as $bukuId) {
                // Anda bisa menyimpan preferensi buku ke tabel lain jika diperlukan
                // Misalnya, tabel `preferensi_buku`
            }
        }

        return redirect()->route('user.rekomendasi.index')->with('success', 'Preferensi berhasil disimpan!');
    }
}
