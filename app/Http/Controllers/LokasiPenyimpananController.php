<?php

namespace App\Http\Controllers;

use App\Models\LokasiPenyimpanan;
use Illuminate\Http\Request;

class LokasiPenyimpananController extends Controller
{
    //


    public function index()
    {
        $lokasis = LokasiPenyimpanan::paginate(10);
        return view('lokasi.index', compact('lokasis'));
    }

    public function create()
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('lokasi.create');
    }

    public function store(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        LokasiPenyimpanan::create($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit(LokasiPenyimpanan $lokasi)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, LokasiPenyimpanan $lokasi)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $lokasi->update($request->all());

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(LokasiPenyimpanan $lokasi)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $lokasi->delete();

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus');
    }
}
