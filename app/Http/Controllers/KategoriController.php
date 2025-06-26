<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $kategoris = Kategori::latest()->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
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
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
