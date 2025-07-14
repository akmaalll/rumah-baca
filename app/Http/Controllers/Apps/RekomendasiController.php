<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use App\Models\RekomendasiBuku;
use App\Services\ContentBasedRecommendationService;

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

        $this->recommendationService->generateRecommendations($userId);


        return redirect()->route('user.rekomendasi.index')->with('success', 'Rekomendasi berhasil diperbarui!');
    }

    public function index()
    {
        $userId = auth()->id();

        $kategoris = KategoriBuku::all();

        // Ambil daftar rekomendasi yang sudah dihitung
        $rekomendasi = RekomendasiBuku::where('user_id', $userId)
            ->with('buku') // Ambil data buku
            ->orderByDesc('skor_rekomendasi')
            ->orderByRaw('RAND()')
            ->get();
        // dd($rekomendasi);

        return view('app.rekomendasi.index', compact('rekomendasi', 'kategoris'));
    }
}
