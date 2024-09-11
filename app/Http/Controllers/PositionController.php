<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

// use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        //
        $data = Position::query()->get();
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diambil',
            'data' => $data
        ], 200);
    }
}
