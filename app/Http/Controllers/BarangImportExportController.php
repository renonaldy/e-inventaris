<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangImportExportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:admin')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);
    }


    public function export()
    {
        return Excel::download(new BarangExport, 'data-barang.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);

        Excel::import(new BarangImport, $request->file('file'));

        return redirect()->route('barang.index')->with('success', 'Import berhasil!');
    }
}
