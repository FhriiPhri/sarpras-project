<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id', 'barang_id', 'tanggal_pinjam', 
        'tanggal_kembali', 'tanggal_dikembalikan', 'jumlah', 'tujuan',
        'status', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}