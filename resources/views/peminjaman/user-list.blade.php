@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Peminjaman Saya</h1>
                <p class="text-gray-600 mt-2">Kelola data peminjaman barang Anda</p>
            </div>
            <a href="{{ route('user.peminjaman.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium transition">
                + Ajukan Peminjaman Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-green-700 font-medium">✓ {{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Barang</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Est. Kembali</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($peminjamans as $key => $peminjaman)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $key + 1 }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $peminjaman->peralatan->nama_peralatan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($peminjaman->tanggal_kembali)
                                        {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($peminjaman->tanggal_kembali)
                                        {{ $peminjaman->tanggal_kembali->format('d M Y') }}
                                    @else
                                        <span class="text-orange-600 font-medium">Belum Kembali</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(!$peminjaman->tanggal_kembali)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            ✓ Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            ✓ Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        @if($peminjaman->evidence_foto)
                                            <a href="{{ asset('storage/' . $peminjaman->evidence_foto) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-900 font-medium">
                                                Bukti
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-400 text-lg mb-3">📭</div>
                                    <p class="text-gray-600 font-medium">Belum ada riwayat peminjaman</p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        <a href="{{ route('user.peminjaman.create') }}" class="text-blue-600 hover:underline">Mulai pinjam barang sekarang</a>
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
