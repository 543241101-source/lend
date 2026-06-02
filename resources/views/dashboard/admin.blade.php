@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Kelola sistem peminjaman barang aplikasi</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total User -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total User</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_user }}</p>
                    </div>
                    <div class="text-blue-500 text-4xl opacity-10">👥</div>
                </div>
                <a href="{{ route('admin.pengguna.index') }}" class="text-blue-500 text-sm mt-4 inline-block hover:underline">Kelola User →</a>
            </div>

            <!-- Total Barang -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Barang</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total_barang }}</p>
                    </div>
                    <div class="text-green-500 text-4xl opacity-10">📦</div>
                </div>
                <a href="{{ route('admin.peralatan.index') }}" class="text-green-500 text-sm mt-4 inline-block hover:underline">Kelola Barang →</a>
            </div>

            <!-- Peminjaman Aktif -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sedang Dipinjam</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $peminjaman_aktif }}</p>
                    </div>
                    <div class="text-orange-500 text-4xl opacity-10">🔄</div>
                </div>
                <p class="text-gray-500 text-xs mt-4">Barang yang belum dikembalikan</p>
            </div>

            <!-- Pending Approval -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Perlu Persetujuan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $peminjaman_pending }}</p>
                    </div>
                    <div class="text-red-500 text-4xl opacity-10">⚠️</div>
                </div>
                <a href="{{ route('admin.peminjaman.index') }}" class="text-red-500 text-sm mt-4 inline-block hover:underline">Review →</a>
            </div>
        </div>

        <!-- Recent Peminjaman Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Peminjaman Terbaru</h2>
                <a href="{{ route('admin.peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tgl Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tgl Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($peminjamans as $peminjaman)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $peminjaman->pengguna->nama ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $peminjaman->peralatan->nama_peralatan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($peminjaman->tanggal_kembali)
                                        {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                    @else
                                        <span class="text-orange-600 font-medium">Belum Kembali</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(!$peminjaman->tanggal_kembali)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('admin.peminjaman.show', $peminjaman->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data peminjaman</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <a href="{{ route('admin.peralatan.create') }}" class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:bg-blue-100 transition">
                <div class="text-2xl mb-2">➕</div>
                <h3 class="font-semibold text-gray-900">Tambah Barang</h3>
                <p class="text-sm text-gray-600 mt-1">Tambahkan barang baru ke inventaris</p>
            </a>

            <a href="{{ route('admin.pengguna.create') }}" class="bg-green-50 border border-green-200 rounded-lg p-6 hover:bg-green-100 transition">
                <div class="text-2xl mb-2">👤</div>
                <h3 class="font-semibold text-gray-900">Tambah User</h3>
                <p class="text-sm text-gray-600 mt-1">Daftarkan pengguna baru ke sistem</p>
            </a>

            <a href="{{ route('admin.peminjaman.index') }}" class="bg-orange-50 border border-orange-200 rounded-lg p-6 hover:bg-orange-100 transition">
                <div class="text-2xl mb-2">📋</div>
                <h3 class="font-semibold text-gray-900">Kelola Peminjaman</h3>
                <p class="text-sm text-gray-600 mt-1">Approve atau reject pengajuan pinjam</p>
            </a>
        </div>
    </div>
</div>
@endsection
