<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Barang::select('nama', 'kategori', 'stok', 'minimum_stok', 'lokasi_penyimpanan_id')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Kategori', 'Stok', 'Minimum Stok', 'Lokasi Penyimpanan'];
    }
}
