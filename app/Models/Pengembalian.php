<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    //
    protected $fillable = ['barang_id', 'jumlah', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
