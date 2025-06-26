<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori'); // Tambahkan kolom kategori
            $table->unsignedBigInteger('lokasi_penyimpanan_id'); // Tambahkan kolom lokasi_penyimpanan_id

            $table->string('kode')->unique();
            $table->integer('stok')->default(0);
            $table->string('satuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Tambahkan constraint unik kombinasi
            $table->unique(['nama', 'kategori', 'lokasi_penyimpanan_id'], 'unique_barang_combination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
