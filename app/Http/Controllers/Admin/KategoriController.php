<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'kategori';
        $kategori = KategoriBuku::all();
        return view('pages.kategori.index', compact('menu', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'kategori';
        $kategori = KategoriBuku::all();

        return view('pages.kategori.create', compact('menu', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $req = $request->all();
        if ($request->nama_kategori == 20) {
            $req['nama_kategori'] = $request->kategori_lain;
        }
        // dd($req['nama_kategori']);
        // dd($req);
        KategoriBuku::create($req);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = 'Kategori';
        $kategori = KategoriBuku::all();
        $data = KategoriBuku::find($id);
        return view('pages.kategori.edit', compact('menu', 'data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        if ($request->nama_kategori == '20') {
            $kategori->nama_kategori = $request->kategori_lain;
        } else {
            $kategori->nama_kategori = $request->nama_kategori;
        }

        $kategori->sub_kategori = $request->sub_kategori;
        $kategori->save();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KategoriBuku::findOrFail($id);
        $data->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
