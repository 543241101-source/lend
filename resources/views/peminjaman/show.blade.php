@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Peminjaman</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap peminjaman peralatan lab.</p>
                </div>
                <span class="px-3 py-1 rounded-lg text-sm font-bold {{ $peminjaman->tanggal_kembali ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $peminjaman->tanggal_kembali ? 'Dikembalikan' : 'Sedang Dipinjam' }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Peminjam</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->pengguna->nama ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">{{ $peminjaman->pengguna->email ?? '' }}</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Peralatan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->peralatan->nama_peralatan ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">Kondisi: <span class="font-semibold">{{ $peminjaman->peralatan->kondisi ?? 'N/A' }}</span></p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal Peminjaman</label>
                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal Pengembalian</label>
                    <p class="text-lg font-semibold text-gray-900">
                        @if($peminjaman->tanggal_kembali)
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                        @else
                            <span class="text-yellow-600">Belum dikembalikan</span>
                        @endif
                    </p>
                </div>
            </div>

            @if($peminjaman->evidence_foto)
            <div class="border-t border-gray-100 pt-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Foto Evidence</label>
                <img src="{{ asset('storage/' . $peminjaman->evidence_foto) }}" alt="Evidence" class="max-w-sm rounded-lg border border-gray-200 shadow-sm">
            </div>
            @endif

            <div class="flex justify-end gap-2 border-t border-gray-100 pt-6 mt-6">
                <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-200 transition">Kembali</a>
                @if(!$peminjaman->tanggal_kembali)
                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition">Edit</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
