<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Barang;


class StokController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:admin')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);
    }


    public function pengembalian()
    {
        $barangs = Barang::all();
        return view('stok.pengembalian', compact('barangs'));
    }

    public function simpanPengembalian(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        Pengembalian::create($request->all());

        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect()->route('stok.pengembalian')->with('success', 'Pengembalian berhasil disimpan dan stok diperbarui.');
    }

    public function indexPengembalian()
    {
        $pengembalians = Pengembalian::with('barang')->latest()->paginate(10);
        return view('stok.pengembalian.index', compact('pengembalians'));
    }

    public function editPengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $barangs = Barang::all();
        return view('stok.pengembalian.edit', compact('pengembalian', 'barangs'));
    }

    public function updatePengembalian(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $barangLama = Barang::find($pengembalian->barang_id);
        $barangBaru = Barang::find($request->barang_id);

        // Kurangi stok lama
        $barangLama->stok -= $pengembalian->jumlah;
        $barangLama->save();

        // Tambahkan stok baru
        $barangBaru->stok += $request->jumlah;
        $barangBaru->save();

        $pengembalian->update($request->all());

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui');
    }

    public function destroyPengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $barang = Barang::find($pengembalian->barang_id);

        // Kurangi stok
        $barang->stok -= $pengembalian->jumlah;
        $barang->save();

        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
