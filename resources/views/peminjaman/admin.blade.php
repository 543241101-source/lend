@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Panel Admin: Semua Peminjaman</h2>
        <a href="{{ route('peminjaman.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow">
            + Tambah Peminjaman
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 border-b">Peminjam</th>
                    <th class="px-6 py-3 border-b">Barang</th>
                    <th class="px-6 py-3 border-b">Evidence</th>
                    <th class="px-6 py-3 border-b">Tgl Pinjam</th>
                    <th class="px-6 py-3 border-b">Tgl Kembali</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($allPeminjaman as $pinjam)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $pinjam->pengguna->nama ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500">{{ $pinjam->pengguna->email ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-700">
                        {{ $pinjam->peralatan->nama_peralatan ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($pinjam->evidence_foto)
                            <img src="{{ asset('storage/' . $pinjam->evidence_foto) }}" alt="Evidence" class="w-16 h-16 object-cover rounded border">
                        @else
                            <span class="text-xs text-gray-400 italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($pinjam->tanggal_kembali)
                            <span class="text-green-600 font-semibold">
                                {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') }}
                            </span>
                        @else
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">
                                Sedang Dipinjam
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="px-3 py-1 bg-yellow-500  text-xs rounded hover:bg-yellow-600 transition">Edit</a>

                            <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus log ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">Belum ada data transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
