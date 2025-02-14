<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\RekomendasiBuku;
use App\Services\ContentBasedRecommendationService;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    protected $recommendationService;

    public function __construct(ContentBasedRecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function generate()
    {
        $userId = auth()->id(); // Ambil ID user yang sedang login
        // dd($userId);
        // Panggil service untuk membuat rekomendasi
        $this->recommendationService->generateRecommendations($userId);


        return redirect()->route('user.rekomendasi.index')->with('success', 'Rekomendasi berhasil diperbarui!');
    }

    public function index()
    {
        $userId = auth()->id();

        $kategoris = KategoriBuku::all();
        $bukuPopuler = Buku::whereIn('kategori_id', $kategoris->pluck('id'))
            ->inRandomOrder() // Ambil secara acak
            ->take(10) // Ambil 10 buku
            ->get();

        // Ambil daftar rekomendasi yang sudah dihitung
        $rekomendasi = RekomendasiBuku::where('user_id', $userId)
            ->with('buku') // Ambil data buku
            ->orderByDesc('skor_rekomendasi')
            ->get();
        // dd($rekomendasi);

        return view('app.rekomendasi.index', compact('rekomendasi', 'bukuPopuler', 'kategoris'));   
    }
}
