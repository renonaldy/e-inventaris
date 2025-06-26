<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Exports\SupplierExport;
use App\Imports\SupplierImport;
use App\Mail\StokMinimumNotification;
use App\Models\Barang;
use App\Models\Pengembalian;
use App\Models\Supplier;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{


    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->latest()->paginate(10);
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('supplier.create');
    }

    public function store(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ]);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        if (FacadesGate::denies('admin-only')) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }

    public function riwayatStok()
    {
        $barangs = Barang::with('supplier')->orderBy('nama')->get();
        return view('stok.riwayat', compact('barangs'));
    }

    // Fitur 4: Pengembalian Barang
    public function pengembalian()
    {
        // logika pengembalian bisa disesuaikan
        return view('stok.pengembalian');
    }

    public function pengembalianExport()
    {
        return Excel::download(new PengembalianExport, 'pengembalian.xlsx');
    }

    // Tambahan fitur pengembalian (index)
    public function pengembalianIndex()
    {
        $pengembalians = Pengembalian::with('barang')->latest()->paginate(10);
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function stokMinimum()
    {
        $barangMinimum = Barang::where('stok', '<=', 5)->get();
        return view('supplier.stok-minimum', compact('barangMinimum'));
    }

    public function kirimNotifikasiStokMinimum()
    {
        $barangKritis = Barang::where('stok', '<=', 5)->get();
        if ($barangKritis->count()) {
            Mail::to('admin@example.com')->send(new StokMinimumNotification($barangKritis));
        }
    }

    public function exportExcel()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SupplierImport, $request->file('file'));

        return back()->with('success', 'Import data supplier berhasil');
    }
}
