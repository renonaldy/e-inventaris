<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:admin')->only([
    //         'create',
    //         'store',
    //         'edit',
    //         'update',
    //         'destroy'
    //     ]);
    // }


    public function index()
    {
        $files = collect(Storage::disk('public')->files('Laravel/backups'))
            ->sortDesc();

        return view('backup.index', compact('files'));
    }

    public function create()
    {
        Artisan::call('backup:run --only-db');

        return redirect()->route('backup.index')->with('success', 'Backup berhasil dibuat.');
    }

    public function destroy($filename)
    {
        $filePath = 'Laravel/backups/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return redirect()->route('backup.index')->with('success', 'Backup berhasil dihapus.');
        }

        return redirect()->route('backup.index')->with('error', 'File tidak ditemukan.');
    }
}
