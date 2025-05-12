<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'deskripsi',
        'stok',
        'gambar',
        'kondisi',
        'status'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}