<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\ClusterBuku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $clusterResults = ClusterBuku::with('buku')
            ->get()
            ->groupBy('nama_kelompok');
        // dd($clusterResults);
        return view('app.index', compact('clusterResults'));
    }
}
