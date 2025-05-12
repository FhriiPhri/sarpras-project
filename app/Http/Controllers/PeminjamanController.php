<?php

// app/Http/Controllers/PeminjamanController.php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Services\PeminjamanService;

class PeminjamanController extends Controller
{
    // app/Http/Controllers/PeminjamanController.php

    public function index()
    {
        // Ambil data peminjaman dari database
        $peminjaman = Peminjaman::with(['user', 'barang'])->orderBy('created_at', 'desc')->get();

        // Kirim data peminjaman ke view
        return view('peminjamans.index', compact('peminjaman'));
    }

    protected $service;

    public function __construct(PeminjamanService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'required|string|max:255'
        ]);

        $peminjaman = $this->service->ajukan($request->all());

        return response()->json([
            'message' => 'Peminjaman berhasil diajukan',
            'data' => $peminjaman
        ], 201);
    }

    public function confirm($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $this->service->konfirmasi($peminjaman);

        return redirect()->back()->with('success', 'Peminjaman dikonfirmasi');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $this->service->tolak($peminjaman, $request->alasan);

        return redirect()->back()->with('success', 'Peminjaman ditolak');
    }

    public function return(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'catatan' => 'nullable|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $this->service->kembalikan($peminjaman, $request->all());

        return redirect()->back()->with('success', 'Pengembalian dicatat');
    }
}