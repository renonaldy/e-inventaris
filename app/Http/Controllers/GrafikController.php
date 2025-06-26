<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function stokPerKategori()
    {
        // Ambil data stok berdasarkan kategori
        $stokData = Barang::select('kategori', DB::raw('SUM(stok) as total_stok'))
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        $labels = $stokData->pluck('kategori');
        $data = $stokData->pluck('total_stok');

        return view('grafik.stok-per-kategori', compact('labels', 'data'));
    }
}
