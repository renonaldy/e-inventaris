<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('role:admin')->only([
    //         'create',
    //         'store',
    //         'edit',
    //         'update',
    //         'destroy'
    //     ]);
    // }

    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $barangMasuk = BarangMasuk::with('barang')
            ->when($from, fn($q) => $q->whereDate('tanggal', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('tanggal', '<=', $to))
            ->get();

        $barangKeluar = BarangKeluar::with('barang')
            ->when($from, fn($q) => $q->whereDate('tanggal', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('tanggal', '<=', $to))
            ->get();

        return view('laporan.index', compact('barangMasuk', 'barangKeluar', 'from', 'to'));
    }

    public function exportPdf(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $barangMasuk = BarangMasuk::with('barang')
            ->when($from, fn($q) => $q->whereDate('tanggal', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('tanggal', '<=', $to))
            ->get();

        $barangKeluar = BarangKeluar::with('barang')
            ->when($from, fn($q) => $q->whereDate('tanggal', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('tanggal', '<=', $to))
            ->get();

        $pdf = FacadePdf::loadView('laporan.pdf', compact('barangMasuk', 'barangKeluar', 'from', 'to'));
        return $pdf->download('laporan-barang.pdf');
    }

    public function exportExcel(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        return Excel::download(new \App\Exports\LaporanExport($from, $to), 'laporan-barang.xlsx');
    }
}
