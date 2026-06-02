@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="sm:flex sm:items-center sm:justify-between bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Riwayat Peminjaman Saya</h2>
            <p class="text-sm text-gray-500 mt-1">Daftar semua peminjaman peralatan lab Anda.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition">
            + Pinjam Peralatan
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase">Nama Barang</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase">Evidence</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase">Tgl Pinjam</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase">Tgl Kembali</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($peminjamans as $key => $pinjam)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $key + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $pinjam->peralatan->nama_peralatan }}</td>
                        <td class="px-6 py-4">
                            @if($pinjam->evidence_foto)
                            <img src="{{ asset('storage/' . $pinjam->evidence_foto) }}" alt="Evidence" class="w-12 h-12 object-cover rounded border border-gray-200">
                            @else
                            <span class="text-xs text-gray-400">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($pinjam->tanggal_kembali)
                            <span class="text-green-600 font-semibold">{{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') }}</span>
                            @else
                            <span class="text-yellow-600 font-semibold">Belum Dikembalikan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $pinjam->tanggal_kembali ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $pinjam->tanggal_kembali ? 'Dikembalikan' : 'Aktif' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <p class="text-gray-500 text-sm">Anda belum pernah meminjam peralatan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
