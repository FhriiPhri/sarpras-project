@extends('layouts.app')

@section('title', 'Kelola Peminjaman Sarana')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Peminjaman Sarana</h1>
        <a href="{{ route('export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Laporan Peminjaman (.xlsx)
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

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
                    <th class="px-4 py-2 border-b text-left">Status</th>
                    <th class="px-4 py-2 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->user->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->barang->nama_barang }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $item->jumlah }}</td>
                    <td class="px-4 py-2 border-b">{{ Str::limit($item->tujuan, 20) }}</td>
                    <td class="px-4 py-2 border-b">{{ $item->tanggal_pinjam}} </td>
                    <td class="px-4 py-2 border-b">{{ $item->tanggal_kembali}}</td>
                    <td class="px-4 py-2 border-b">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                            @if($item->status === 'menunggu') bg-yellow-100 text-yellow-800
                            @elseif($item->status === 'disetujui') bg-blue-100 text-blue-800
                            @elseif($item->status === 'dipinjam') bg-purple-100 text-purple-800
                            @elseif($item->status === 'dikembalikan') bg-green-100 text-green-800
                            @elseif($item->status === 'ditolak') bg-red-100 text-red-800
                            @elseif($item->status === 'rusak_ringan') bg-orange-100 text-orange-800
                            @elseif($item->status === 'rusak_berat' || $item->status === 'hilang') bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">
                        <div class="flex flex-wrap justify-center gap-2">
                            @if($item->status === 'menunggu')
                            <form action="{{ route('peminjaman-sarana.confirm', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-sm">
                                    Konfirmasi Pinjam
                                </button>
                            </form>
                            <button onclick="showRejectModal({{ $item->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                Tolak
                            </button>
                            @elseif($item->status === 'disetujui')
                            @elseif($item->status === 'dipinjam')
                                <button onclick="showReturnModal({{ $item->id }})" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                    Kembalikan
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk penolakan -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Alasan Penolakan</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <textarea name="catatan" rows="3" class="w-full px-3 py-2 border rounded" required></textarea>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="hideRejectModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk pengembalian -->
<div id="returnModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Form Pengembalian</h3>
        <form id="returnForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Kondisi Barang</label>
                <select name="kondisi" class="w-full px-3 py-2 border rounded" required>
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="catatan" rows="3" class="w-full px-3 py-2 border rounded"></textarea>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="hideReturnModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showRejectModal(peminjamanId) {
        const form = document.getElementById('rejectForm');
        form.action = `/peminjaman-sarana/${peminjamanId}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function hideRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    function showReturnModal(peminjamanId) {
        const form = document.getElementById('returnForm');
        form.action = `/peminjaman-sarana/${peminjamanId}/return`;
        document.getElementById('returnModal').classList.remove('hidden');
    }

    function hideReturnModal() {
        document.getElementById('returnModal').classList.add('hidden');
    }
</script>
@endsection