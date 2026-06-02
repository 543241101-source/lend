@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mt-2">Jelajahi barang-barang yang tersedia dan ajukan peminjaman</p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form action="{{ route('user.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang</label>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nama barang..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Kondisi</label>
                    <select name="kondisi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Kondisi</option>
                        <option value="Bagus" {{ $kondisi == 'Bagus' ? 'selected' : '' }}>Bagus</option>
                        <option value="Rusak Ringan" {{ $kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ $kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">
                        🔍 Cari
                    </button>
                    <a href="{{ route('user.dashboard') }}" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 text-center font-medium">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Available Items Grid -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">📦 Barang Tersedia</h2>
                <a href="{{ route('user.peminjaman.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-medium">
                    + Ajukan Peminjaman
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($peralatans as $barang)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <!-- Image -->
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_peralatan }}"
                                    class="w-full h-full object-cover hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">📦</div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $barang->nama_peralatan }}</h3>

                            <div class="mb-3">
                                <p class="text-xs text-gray-600 mb-1">Kondisi:</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($barang->kondisi == 'Bagus')
                                        bg-green-100 text-green-800
                                    @elseif($barang->kondisi == 'Rusak Ringan')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ $barang->kondisi }}
                                </span>
                            </div>

                            <a href="{{ route('user.peminjaman.create') }}" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-medium text-center text-sm transition">
                                Pinjam Barang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Tidak ada barang yang sesuai dengan pencarian</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $peralatans->links() }}
            </div>
        </div>

        <!-- My Recent Peminjaman -->
        @if($my_peminjamans->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Riwayat Peminjaman Saya</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($my_peminjamans as $peminjaman)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $peminjaman->peralatan->nama_peralatan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($peminjaman->tanggal_kembali)
                                        {{ $peminjaman->tanggal_kembali->format('d M Y') }}
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
            <p class="text-blue-900">Belum ada riwayat peminjaman. <a href="{{ route('user.peminjaman.create') }}" class="font-bold underline">Mulai pinjam sekarang!</a></p>
        </div>
        @endif
    </div>
</div>
@endsection
