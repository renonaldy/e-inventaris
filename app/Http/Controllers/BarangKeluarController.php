<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        $barangKeluars = BarangKeluar::with('barang')->latest()->paginate(10);
        return view('barang-keluar.index', compact('barangKeluars'));
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
        $barangs = Barang::all();
        return view('barang-keluar.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string', // jika ada kolom ini
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);

        // Cek apakah stok cukup
        if ($barang->stok < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Simpan data barang keluar
        BarangKeluar::create($validated);

        // Kurangi stok barang
        $barang->stok -= $validated['jumlah'];
        $barang->save();

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan.');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $barang = $barangKeluar->barang;
        $barang->stok += $barangKeluar->jumlah;
        $barang->save();

        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil dihapus');
    }
}
