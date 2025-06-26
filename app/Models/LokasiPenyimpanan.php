<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiPenyimpanan extends Model
{
    //
    protected $fillable = ['nama', 'keterangan'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
