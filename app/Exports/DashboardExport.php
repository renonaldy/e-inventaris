<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DashboardExport implements FromView
{
    protected $year, $kategori;

    public function __construct($year, $kategori = null)
    {
        $this->year = $year;
        $this->kategori = $kategori;
    }

    public function view(): View
    {
        $barangMasukQuery = BarangMasuk::whereYear('tanggal', $this->year);
        if ($this->kategori) {
            $barangMasukQuery->whereHas('barang.kategori', fn($q) =>
            $q->where('nama', $this->kategori));
        }

        $barangMasuk = $barangMasukQuery->with('barang.kategori')->get();

        return view('dashboard.export-excel', [
            'barangMasuk' => $barangMasuk,
            'year' => $this->year,
            'kategori' => $this->kategori
        ]);
    }
}
