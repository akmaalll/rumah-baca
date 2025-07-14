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

        return view('pages.rekomendasi.index', compact('kategoris'));
    }

    public function simpanPreferensi(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

        // Simpan preferensi kategori
        foreach ($request->kategori_id as $kategoriId) {
            $rating = $request->input('rating_' . $kategoriId); // Ambil rating dari input
            // dd($rating);
            PreferensiUser::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'kategori_id' => $kategoriId,
                ],
                [
                    'bobot_preferensi' => $rating, // Bobot berdasarkan rating
                ]
            );
        }

        return redirect()->route('user.rekomendasi.index')->with('success', 'Preferensi berhasil disimpan!');
    }
}
