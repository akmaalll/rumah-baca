<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use App\Models\Tag;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'buku';
        $buku = Buku::all();
        $tag = Tag::all();
        // dd($buku);

        return view('pages.buku.index', compact('menu', 'buku', 'tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'buku';
        $tag = Tag::all();

        $kategori = KategoriBuku::all();
        // dd($kategori);

        return view('pages.buku.create', compact('menu', 'kategori', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = $request->all();
        if ($request->hasFile('image')) {
            $imgName =  $request->file('image')->getClientOriginalName();
            $imgName = time() . '_' . $imgName;
            $request->image->move(public_path('images/buku'), $imgName);
            $req['image'] = $imgName;
        }
        $req['tag'] = implode(',', $request->tag);
        // dd($req);

        Buku::create($req);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
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
        $menu = 'buku';
        $kategori = KategoriBuku::all();
        $tag = Tag::all();
        $data = Buku::findOrFail($id);
        // dd($data);
        return view('pages.buku.edit', compact('data', 'menu', 'kategori', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $req = $request->all();
        $data = Buku::find($request->id);
        if ($request->hasFile('image')) {

            $imgName =  $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images/buku'), $imgName);
            $req['image'] = $imgName;
        } else {
            $req['image'] = $request->gambarLama;
        }
        // dd($req);
        // $req['tag'] = implode(',', $request->tag);


        $data->update($req);
        // dd($req);   

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Buku::findOrFail($id);
        $data->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
