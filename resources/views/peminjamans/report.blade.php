@extends('layouts.app')

@section('title', 'Laporan Peminjaman Sarana')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan Peminjaman Sarana</h1>
        <a href="{{ route('peminjaman-sarana.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Kembali ke Kelola Peminjaman
        </a>
    </div>

    <div class="mb-4 flex flex-col sm:flex-row gap-4">
        <form method="GET" action="{{ route('peminjaman-sarana.report') }}" class="flex flex-col sm:flex-row gap-2 w-full">
            <select name="status" class="px-3 py-2 border rounded">
                <option value="">Semua Status</option>
                <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="rusak_ringan" {{ request('status') === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak_berat" {{ request('status') === 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                <option value="hilang" {{ request('status') === 'hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-3 py-2 border rounded">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-3 py-2 border rounded">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Filter
            </button>
            <a href="{{ route('peminjaman-sarana.report') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-center">
                Reset
            </a>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">No</th>
                    <th class="px-4 py-2 border-b text-left">Peminjam</th>
                    <th class="px-4 py-2 border-b text-left">Barang</th>
                    <th class="px-4 py-2 border-b text-left">Jumlah</th>
                    <th class="px-4 py-2 border-b text-left">Tujuan</th>
                    <th class="px-4 py-2 border-b text-left">Tanggal Pinjam</th>
                    <th class="px-4 py-2 border-b text-left">Tanggal Kembali</th>
                    <th class="px-4 py-2 border-b text-left">Dikembalikan</th>
                    <th class="px-4 py-2 border-b text-left">Status</th>
                    <th class="px-4 py-2 border-b text-left">Disetujui Oleh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->barang->nama_barang }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $item->jumlah }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->tujuan }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->tanggal_kembali->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 border-b">
                        {{ $item->tanggal_dikembalikan ? $item->tanggal_dikembalikan->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-2 border-b">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                            @if($item->status === 'dipinjam') bg-purple-100 text-purple-800
                            @elseif($item->status === 'dikembalikan') bg-green-100 text-green-800
                            @elseif($item->status === 'rusak_ringan') bg-orange-100 text-orange-800
                            @elseif($item->status === 'rusak_berat' || $item->status === 'hilang') bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">
                        {{ $item->approver ? $item->approver->name : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection