<?php

namespace App\Http\Controllers;

use App\Mail\StokKritisMail;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $barangMasuks = BarangMasuk::with('barang')->latest()->paginate(10);
        return view('barang-masuk.index', compact('barangMasuks'));
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
        return view('barang-masuk.create', compact('barangs'));
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
            'keterangan' => 'nullable|string', // jika kamu punya kolom ini
        ]);

        // Simpan data barang masuk
        BarangMasuk::create($validated);

        // Update stok barang terkait
        $barang = Barang::findOrFail($validated['barang_id']);
        $barang->stok += $validated['jumlah'];
        if ($barang->stok < $barang->stok_minimum) {
            Mail::to('reenonaldy28@gmail.com')->send(new StokKritisMail($barang));
        }

        $barang->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil ditambahkan.');
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
    public function destroy(BarangMasuk $barangMasuk)
    {
        //

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $barang = $barangMasuk->barang;
        $barang->stok -= $barangMasuk->jumlah;
        $barang->save();

        $barangMasuk->delete();

        return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil dihapus');
    }
}
