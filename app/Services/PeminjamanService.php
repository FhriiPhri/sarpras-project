<?php

namespace App\Services;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class PeminjamanService
{
    public function ajukan(array $data): Peminjaman
    {
        return Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $data['barang_id'],
            'tanggal_pinjam' => $data['tanggal_pinjam'],
            'tanggal_kembali' => $data['tanggal_kembali'],
            'jumlah' => $data['jumlah'],
            'catatan' => $data['catatan'],
            'status' => 'menunggu'
        ]);
    }

    public function tolak(Peminjaman $peminjaman, $alasan)
    {
        $peminjaman->status = 'ditolak';
        $peminjaman->catatan_admin = $alasan;
        $peminjaman->save();
    }

    public function setujui(Peminjaman $peminjaman): void
    {
        $barang = $peminjaman->barang;

        if ($barang->stok < $peminjaman->jumlah) {
            throw new \Exception("Stok tidak mencukupi.");
        }

        $peminjaman->update(['status' => 'disetujui']);
    }

    public function konfirmasi(Peminjaman $peminjaman): void
    {
        $barang = $peminjaman->barang;

        if ($barang->stok < $peminjaman->jumlah) {
            throw new \Exception("Stok tidak cukup.");
        }

        $barang->stok -= $peminjaman->jumlah;
        $barang->save();

        $peminjaman->update(['status' => 'dipinjam']);
    }

    public function kembalikan(Peminjaman $peminjaman, array $data): void
    {
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now(),
            'kondisi' => $data['kondisi'],
            'catatan' => $data['catatan'] ?? null,
        ]);

        $barang = $peminjaman->barang;

        if ($data['kondisi'] === 'baik') {
            $barang->stok += $peminjaman->jumlah;
        } elseif (in_array($data['kondisi'], ['rusak_ringan', 'rusak_berat'])) {
            $barang->kondisi = $data['kondisi'];
        }

        $barang->save();
    }
}