<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Barang([
            //
            'nama' => $row['nama'],
            'kategori' => $row['kategori'],
            'stok' => $row['stok'],
            'lokasi_penyimpanan_id' => $row['lokasi_penyimpanan_id'] ?? null,
            'stok_minimum' => $row['stok_minimum'] ?? 5,
        ]);
    }
}
