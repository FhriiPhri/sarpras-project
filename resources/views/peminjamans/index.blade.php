@extends('layouts.app')

@section('title', 'Kelola Peminjaman Sarana')

@section('content')
<div class="p-6">
    <!-- Premium Header Section -->
    <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-5 mb-6 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <span>Manajemen Peminjaman Sarana</span>
                </h1>
                <p class="text-sm text-gray-600 mt-2">Kelola seluruh proses peminjaman sarana dan prasarana</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('export') }}" 
                   class="bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-file-excel"></i>
                    <span>Export Laporan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6 rounded-lg shadow-inner">
        <div class="flex items-center">
            <div class="flex-shrink-0 text-emerald-500 animate-pulse">
                <i class="fas fa-check-circle fa-lg"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-inner">
        <div class="flex items-center">
            <div class="flex-shrink-0 text-red-500">
                <i class="fas fa-exclamation-circle fa-lg"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Peminjaman Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Transaksi Peminjaman</h3>
                <p class="text-xs text-gray-500">{{ $peminjaman->count() }} transaksi ditemukan</p>
            </div>
            <div class="relative">
                <input type="text" placeholder="Cari peminjaman..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Tujuan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pinjam</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Kembali</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider pr-8">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($peminjaman as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium mr-3">
                                    {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                </div>
                                <div class="text-sm font-medium text-gray-900">{{ $item->user->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->barang->nama_barang }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            {{ $item->jumlah }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 hidden lg:table-cell">
                            <div class="line-clamp-1">{{ $item->tujuan }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->tanggal_pinjam }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                            {{ $item->tanggal_kembali ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($item->status === 'menunggu') bg-yellow-100 text-yellow-800
                                @elseif($item->status === 'disetujui') bg-blue-100 text-blue-800
                                @elseif($item->status === 'dipinjam') bg-purple-100 text-purple-800
                                @elseif($item->status === 'dikembalikan') bg-green-100 text-green-800
                                @elseif($item->status === 'ditolak') bg-red-100 text-red-800
                                @elseif($item->status === 'rusak_ringan') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                <span class="w-2 h-2 rounded-full mr-1.5 
                                    @if($item->status === 'menunggu') bg-yellow-500
                                    @elseif($item->status === 'disetujui') bg-blue-500
                                    @elseif($item->status === 'dipinjam') bg-purple-500
                                    @elseif($item->status === 'dikembalikan') bg-green-500
                                    @elseif($item->status === 'ditolak') bg-red-500
                                    @elseif($item->status === 'rusak_ringan') bg-orange-500
                                    @else bg-red-500 @endif"></span>
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium pr-6">
                            <div class="flex justify-end space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                @if($item->status === 'menunggu')
                                <form action="{{ route('peminjaman-sarana.confirm', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="text-purple-600 hover:text-purple-900 transition-colors duration-200 p-2 rounded-full hover:bg-purple-50"
                                            title="Konfirmasi">
                                        <i class="fas fa-check-circle fa-sm"></i>
                                    </button>
                                </form>
                                <button onclick="showRejectModal({{ $item->id }})" 
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200 p-2 rounded-full hover:bg-red-50"
                                        title="Tolak">
                                    <i class="fas fa-times-circle fa-sm"></i>
                                </button>
                                @elseif($item->status === 'dipinjam')
                                <button onclick="showReturnModal({{ $item->id }})" 
                                        class="text-green-600 hover:text-green-900 transition-colors duration-200 p-2 rounded-full hover:bg-green-50"
                                        title="Kembalikan">
                                    <i class="fas fa-undo-alt fa-sm"></i>
                                </button>
                                @endif
                                <a href="#" 
                                   class="text-gray-600 hover:text-gray-900 transition-colors duration-200 p-2 rounded-full hover:bg-gray-100"
                                   title="Detail">
                                    <i class="fas fa-ellipsis-h fa-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State -->
    @if($peminjaman->isEmpty())
    <div class="bg-white rounded-xl border border-gray-200 p-8 text-center shadow-lg">
        <div class="mx-auto h-24 w-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-exchange-alt text-3xl text-blue-300"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada transaksi peminjaman</h3>
        <p class="text-sm text-gray-500 mb-4">Semua transaksi peminjaman akan muncul di sini</p>
    </div>
    @endif
</div>

<!-- Modal untuk penolakan -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Form Penolakan Peminjaman</h3>
            <button onclick="hideRejectModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="rejectForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                <textarea name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="hideRejectModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                    Tolak Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal untuk pengembalian -->
<div id="returnModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Form Pengembalian Barang</h3>
            <button onclick="hideReturnModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="returnForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi Barang</label>
                <select name="kondisi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                <textarea name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="hideReturnModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Proses Pengembalian
                </button>
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

<style>
    .glass-card {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>
@endsection