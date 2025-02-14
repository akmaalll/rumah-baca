<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\ClusterBuku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Buku::with(['kategori', 'kelompok'])->get();
        $groupedData = $books->groupBy(function ($book) {
            return $book->kelompok?->nama_kelompok ?? 'Tidak Terklaster';
        })->count();

        return view('pages.dashboard.index', [
            'menu' => 'dashboard',
            'buku' => Buku::count(),
            'cluster' => $groupedData,
        ]);
    }
}
