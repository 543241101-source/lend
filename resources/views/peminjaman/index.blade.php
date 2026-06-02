@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Transaksi Peminjaman</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data peminjaman alat, pengembalian, dan bukti log inventaris TEFA.</p>
        </div>
        <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Peminjaman
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Peralatan / Barang</th>
                        <th class="px-6 py-4 text-center w-32">Bukti Foto</th>
                        <th class="px-6 py-4">Tgl Pinjam</th>
                        <th class="px-6 py-4">Tgl Kembali</th>
                        <th class="px-6 py-4 w-48 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    {{-- Kita berasumsi variabel yang dikirim dari index Controller bernama $allPeminjaman --}}
                    @forelse($allPeminjaman as $key => $pinjam)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-4 text-center font-medium text-gray-400">{{ $key + 1 }}</td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $pinjam->pengguna->nama ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">ID User: #{{ $pinjam->id_user }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">{{ $pinjam->peralatan->nama_peralatan ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">ID Barang: #{{ $pinjam->id_barang }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($pinjam->evidence_foto)
                                <img src="{{ asset('storage/' . $pinjam->evidence_foto) }}" alt="Evidence" class="w-12 h-12 object-cover rounded-lg mx-auto border border-gray-200 shadow-sm">
                            @else
                                <span class="text-xs text-gray-400 italic">Tidak ada foto</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-600 font-medium">
                            {{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            @if($pinjam->tanggal_kembali)
                                <span class="text-emerald-600 font-semibold">
                                    {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d M Y') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-lg text-xs font-bold animate-pulse">
                                    🔄 Sedang Dipinjam
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('peminjaman.show', $pinjam->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-600 text-xs font-semibold rounded-lg transition">
                                    Detail
                                </a>

                                <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 text-xs font-semibold rounded-lg transition">
                                    Edit
                                </a>

                                <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data log peminjaman ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 text-xs font-semibold rounded-lg transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400 italic bg-gray-50/30">
                            Belum ada riwayat transaksi peminjaman alat lab yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
