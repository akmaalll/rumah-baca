<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = 'tag';
        $tag = Tag::all();
        return view('pages.tag.index', compact('menu', 'tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = 'tag';
        $tag = Tag::all();

        return view('pages.tag.create', compact('menu', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $req = $request->all();
        // dd($req['nama_tag']);
        // dd($req);
        Tag::create($req);
        return redirect()->route('tag.index')->with('success', 'tag berhasil ditambahkan');
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
        $menu = 'tag';
        $tag = Tag::all();
        $data = Tag::find($id);
        return view('pages.tag.edit', compact('menu', 'data', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return redirect()->route('tag.index')->with('success', 'tag berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Tag::findOrFail($id);
        $data->delete();
        return redirect()->route('tag.index')->with('success', 'tag berhasil dihapus');
    }
}
