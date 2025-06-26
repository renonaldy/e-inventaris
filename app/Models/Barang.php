<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $fillable = ['nama', 'kode', 'stok', 'satuan', 'lokasi_penyimpanan_id',  'keterangan', 'kategori_id'];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


    public function lokasi()
    {
        return $this->belongsTo(LokasiPenyimpanan::class, 'lokasi_penyimpanan_id');
    }
}
