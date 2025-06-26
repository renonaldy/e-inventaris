<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //

    protected $fillable = ['nama', 'alamat', 'telepon'];

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
