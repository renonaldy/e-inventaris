<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    protected $from, $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $barangMasuk = BarangMasuk::with('barang')
            ->when($this->from, fn($q) => $q->whereDate('tanggal', '>=', $this->from))
            ->when($this->to, fn($q) => $q->whereDate('tanggal', '<=', $this->to))
            ->get();

        $barangKeluar = BarangKeluar::with('barang')
            ->when($this->from, fn($q) => $q->whereDate('tanggal', '>=', $this->from))
            ->when($this->to, fn($q) => $q->whereDate('tanggal', '<=', $this->to))
            ->get();

        return view('laporan.excel', compact('barangMasuk', 'barangKeluar'));
    }
}
