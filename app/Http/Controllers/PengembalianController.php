<?php

namespace App\Http\Controllers;

use App\Exports\PengembalianExport;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengembalianController extends Controller
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

    public function index()
    {
        $pengembalians = Pengembalian::with('barang')->latest()->paginate(10);
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PengembalianExport, 'pengembalian.xlsx');
    }
}
