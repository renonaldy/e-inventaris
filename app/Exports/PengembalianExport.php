<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengembalianExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengembalian::with('barang')->get()->map(function ($item) {
            return [
                'Barang' => $item->barang->nama,
                'Jumlah' => $item->jumlah,
                'Tanggal' => $item->tanggal,
                'Keterangan' => $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Barang', 'Jumlah', 'Tanggal', 'Keterangan'];
    }

    public function map($pengembalian): array
    {
        return [
            $pengembalian->id,
            $pengembalian->barang->nama ?? '-',
            $pengembalian->jumlah,
            $pengembalian->tanggal,
            $pengembalian->keterangan
        ];
    }
}
