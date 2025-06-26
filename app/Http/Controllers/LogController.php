<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //

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
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('log.index', compact('logs'));
    }
}
