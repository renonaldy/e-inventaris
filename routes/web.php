<?php

use App\Exports\DashboardExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangImportExportController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LokasiPenyimpananController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard hanya untuk user terautentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kategori hanya untuk admin
    // Route::middleware(['can:isAdmin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('users', UserController::class);
        Route::resource('lokasi', LokasiPenyimpananController::class);
        Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/backup/create', [BackupController::class, 'create'])->name('backup.create');
        Route::get('/backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('/backup/delete/{filename}', [BackupController::class, 'delete'])->name('backup.delete');
        Route::get('/aktivitas', [LogController::class, 'index'])->name('log.index');
    // });

    // Supplier hanya admin yang boleh kelola
    // Route::middleware('role:admin')->group(function () {
        Route::resource('supplier', SupplierController::class);
        Route::resource('lokasi-penyimpanan', LokasiPenyimpananController::class);
    // });

    // Barang boleh diakses admin dan petugas
    // Route::middleware('role:admin,user')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('barang-masuk', BarangMasukController::class)->except(['show', 'edit', 'update']);
        Route::resource('barang-keluar', BarangKeluarController::class)->except(['show', 'edit', 'update']);
        Route::get('/barang/export', [BarangImportExportController::class, 'export'])->name('barang.export');
        Route::post('/barang/import', [BarangImportExportController::class, 'import'])->name('barang.import');
    // });

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');

    // Stok & Pengembalian
    Route::get('/stok/riwayat', [StokController::class, 'riwayatStok'])->name('stok.riwayat');
    Route::get('/stok/pengembalian', [StokController::class, 'pengembalian'])->name('stok.pengembalian');
    Route::post('/stok/pengembalian', [StokController::class, 'simpanPengembalian'])->name('stok.pengembalian.simpan');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
    Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
    Route::get('/pengembalian/export', [PengembalianController::class, 'exportExcel'])->name('pengembalian.export');

    // Grafik
    Route::get('/grafik/stok-per-kategori', [GrafikController::class, 'stokPerKategori'])->name('grafik.stok-per-kategori');
    Route::get('/grafik-stok', [DashboardController::class, 'grafikStok'])->name('grafik.stok');

    // Supplier stok minimum & testing kirim email
    Route::get('/stok-minimum', [SupplierController::class, 'stokMinimum'])->name('supplier.stok.minimum');
    Route::get('/test-kirim-email', [SupplierController::class, 'kirimNotifikasiStokMinimum']);
});



Route::get('/dashboard/export-excel', function (Request $request) {
    $year = $request->input('year', now()->year);
    $kategori = $request->input('kategori');
    return Excel::download(new DashboardExport($year, $kategori), 'dashboard-' . $year . '.xlsx');
})->name('dashboard.export.excel');




Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
