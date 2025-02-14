<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\ClusterBuku;
use App\Models\KategoriBuku;
use App\Models\PreferensiUser;
use Illuminate\Support\Facades\Auth;
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

    public function detail($id)
    {
        $data = Buku::find($id);
        // dd($data->gambar);
        return view('app.detail-buku.index', compact('data'));
    }
}
