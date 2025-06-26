<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $selectedYear = $request->input('year', now()->year);
        $selectedKategori = $request->input('kategori');

        // Query BarangMasuk & BarangKeluar
        $barangMasukQuery = BarangMasuk::whereYear('tanggal', $selectedYear);
        $barangKeluarQuery = BarangKeluar::whereYear('tanggal', $selectedYear);

        if ($selectedKategori) {
            $barangMasukQuery->whereHas('barang.kategori', fn($q) => $q->where('nama', $selectedKategori));
            $barangKeluarQuery->whereHas('barang.kategori', fn($q) => $q->where('nama', $selectedKategori));
        }

        // Statistik
        $data = [
            'total_barang' => Barang::count(),
            'barang_masuk' => $barangMasukQuery->sum('jumlah'),
            'barang_keluar' => $barangKeluarQuery->sum('jumlah'),
        ];

        if ($user->role === 'admin') {
            $data['total_user'] = User::count();
        }

        // Tahun sekarang s/d 5 tahun ke depan
        $currentYear = now()->year;
        $years = collect(range($currentYear, $currentYear + 5));

        // Ambil daftar kategori dari tabel kategori
        $kategoriList = Kategori::pluck('nama');

        // Grafik batang: 12 bulan
        $months = collect(range(1, 12))->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('M'));
        $barangMasukChart = [];
        $barangKeluarChart = [];

        foreach (range(1, 12) as $month) {
            $bm = clone $barangMasukQuery;
            $bk = clone $barangKeluarQuery;

            $barangMasukChart[] = $bm->whereMonth('tanggal', $month)->sum('jumlah');
            $barangKeluarChart[] = $bk->whereMonth('tanggal', $month)->sum('jumlah');
        }

        // Pie chart
        $kategoriChartLabels = $selectedKategori
            ? collect([$selectedKategori])
            : $kategoriList;

        $kategoriChartColors = [
            '#007bff',
            '#28a745',
            '#ffc107',
            '#dc3545',
            '#6f42c1',
            '#17a2b8',
            '#fd7e14',
            '#20c997',
            '#6610f2',
            '#e83e8c',
            '#fdc006'
        ];

        // Potong warna sesuai jumlah label
        $kategoriChartColors = array_slice($kategoriChartColors, 0, $kategoriChartLabels->count());

        $kategoriChartData = $kategoriChartLabels->map(function ($kategori) use ($selectedYear) {
            return BarangMasuk::whereHas('barang.kategori', function ($q) use ($kategori) {
                $q->where('nama', $kategori);
            })->whereYear('tanggal', $selectedYear)->sum('jumlah');
        });

        return view('dashboard.index', compact(
            'data',
            'user',
            'months',
            'barangMasukChart',
            'barangKeluarChart',
            'years',
            'selectedYear',
            'kategoriList',
            'selectedKategori',
            'kategoriChartLabels',
            'kategoriChartData',
            'kategoriChartColors'
        ));
    }

    public function exportPdf(Request $request)
    {
        $selectedYear = $request->input('year', now()->year);
        $selectedKategori = $request->input('kategori');

        $barangMasukQuery = BarangMasuk::whereYear('tanggal', $selectedYear);
        $barangKeluarQuery = BarangKeluar::whereYear('tanggal', $selectedYear);

        if ($selectedKategori) {
            $barangMasukQuery->whereHas('barang.kategori', fn($q) => $q->where('nama', $selectedKategori));
            $barangKeluarQuery->whereHas('barang.kategori', fn($q) => $q->where('nama', $selectedKategori));
        }

        $barangMasuk = $barangMasukQuery->get();
        $barangKeluar = $barangKeluarQuery->get();

        $pdf = Pdf::loadView('dashboard.export-pdf', compact(
            'barangMasuk',
            'barangKeluar',
            'selectedYear',
            'selectedKategori'
        ))->setPaper('a4', 'portrait');

        $fileName = 'laporan-dashboard-' . $selectedYear;
        if ($selectedKategori) $fileName .= '-' . str_replace(' ', '-', strtolower($selectedKategori));
        $fileName .= '.pdf';

        return $pdf->download($fileName);
    }

    public function grafikStok()
    {
        $kategoriLabels = Kategori::pluck('nama');
        $stokData = $kategoriLabels->map(function ($kategori) {
            return Barang::whereHas('kategori', fn($q) => $q->where('nama', $kategori))->sum('stok');
        });

        return view('dashboard.grafik-stok', compact('kategoriLabels', 'stokData'));
    }
}
