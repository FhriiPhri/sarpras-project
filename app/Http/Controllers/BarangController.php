<?php

// app/Http/Controllers/BarangController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barangs.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('barang_images', 'public');
            $data['gambar'] = $imagePath;
        }

        Barang::create($data);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barangs.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'status' => 'required|in:tersedia,dipinjam,perbaikan',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            
            $imagePath = $request->file('gambar')->store('barang_images', 'public');
            $data['gambar'] = $imagePath;
        }

        $barang->update($data);

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}