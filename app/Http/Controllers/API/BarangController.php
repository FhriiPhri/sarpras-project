<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //get all barang
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return response()->json([
            'data' => $barangs
        ]);
    }
}