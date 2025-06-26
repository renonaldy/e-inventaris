<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Models\ActivityLog;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\LokasiPenyimpanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'lokasi']);

        // Filter berdasarkan nama kategori (bukan ID)
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama', $request->kategori);
            });
        }

        // Filter berdasarkan lokasi penyimpanan ID
        if ($request->filled('lokasi_penyimpanan_id')) {
            $query->where('lokasi_penyimpanan_id', $request->lokasi_penyimpanan_id);
        }

        // Filter pencarian nama barang
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $barangs = $query->latest()->paginate(10);

        // Ambil nama kategori dari tabel kategoris
        $kategoriList = Kategori::pluck('nama');
        $lokasiList = LokasiPenyimpanan::all();

        return view('barang.index', compact('barangs', 'kategoriList', 'lokasiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $lokasis = LokasiPenyimpanan::all();
        $kategoris = Kategori::all();
        $lastBarang = Barang::latest('id')->first();
        $lastNumber = 0;

        if ($lastBarang && preg_match('/BRG-(\d+)/', $lastBarang->kode, $matches)) {
            $lastNumber = (int) $matches[1];
        }

        $kode = 'BRG-SMK1-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return view('barang.create', compact('lokasis', 'kategoris', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_penyimpanan_id' => 'nullable|exists:lokasi_penyimpanans,id',
        ]);

        // Cek kode terakhir yang memiliki prefix BRG-SMK1-
        $lastBarang = Barang::where('kode', 'LIKE', 'BRG-SMK1-%')->latest('id')->first();
        $lastNumber = 0;

        if ($lastBarang && preg_match('/BRG-SMK1-(\d+)/', $lastBarang->kode, $matches)) {
            $lastNumber = (int) $matches[1];
        }

        // Looping untuk memastikan kode unik
        do {
            $lastNumber++;
            $kode = 'BRG-SMK1-' . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
        } while (Barang::where('kode', $kode)->exists());

        // Simpan data
        $barang = Barang::create([
            'nama' => $request->nama,
            'kode' => $kode,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'kategori_id' => $request->kategori_id,
            'lokasi_penyimpanan_id' => $request->lokasi_penyimpanan_id,
            'stok_minimum' => $request->stok_minimum ?? 5,
            'keterangan' => $request->keterangan,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Tambah Barang',
            'model' => 'Barang',
            'model_id' => $barang->id,
            'description' => 'Menambahkan barang: ' . $barang->nama,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
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
    public function edit(Barang $barang)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $lokasis = LokasiPenyimpanan::all();
        return view('barang.edit', compact('barang', 'lokasis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:barangs,kode,' . $barang->id,
            'stok' => 'required|integer',
            'satuan' => 'required',
            'lokasi_penyimpanan_id' => 'nullable|exists:lokasi_penyimpanans,id',
        ]);

        $exists = Barang::where('id', '!=', $barang->id)
            ->where('nama', $request->nama)
            ->where('kategori', $request->kategori)
            ->where('lokasi_penyimpanan_id', $request->lokasi_penyimpanan_id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'nama' => 'Barang dengan kombinasi nama, kategori, dan lokasi ini sudah ada.'
            ])->withInput();
        }

        $barang->update($request->all());

        // Simpan activity log
        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Update Barang',
            'model' => 'Barang',
            'model_id' => $barang->id,
            'description' => 'Memperbarui barang: ' . $barang->nama,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Hapus Barang',
            'model' => 'Barang',
            'model_id' => $barang->id,
            'description' => 'Menghapus barang: ' . $barang->nama,
        ]);


        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    public function export()
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return Excel::download(new BarangExport, 'data-barang.xlsx');
    }

    public function import(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new BarangImport, $request->file('file'));

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diimpor');
    }
}
