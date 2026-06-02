@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Anggota Lab</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data hak akses, profil siswa, dan admin sistem TEFA PPLG.</p>
        </div>
        <a href="{{ route('pengguna.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Anggota
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Nama Anggota</th>
                        <th class="px-6 py-4">Kontak / Email</th>
                        <th class="px-6 py-4 w-40 text-center">Role</th>
                        <th class="px-6 py-4 w-48 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($penggunas as $key => $user)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-4 text-center font-medium text-gray-400">{{ $key + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $user->nama }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">ID Anggota: #{{ $user->id }}</div>
                        </td>
                        <td class="px-6 py-4 space-y-0.5">
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <span class="font-medium">{{ $user->email }}</span>
                            </div>
                            <div class="text-xs text-gray-400">{{ $user->notelp }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->role === 'admin')
                            <span class="inline-flex items-center px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-100 rounded-lg text-xs font-semibold">
                                🔑 Admin Lab
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-semibold">
                                👤 Peminjam
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('pengguna.edit', $user->id) }}" class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 text-xs font-semibold rounded-lg transition">
                                    Edit
                                </a>

                                <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 text-xs font-semibold rounded-lg transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic bg-gray-50/30">
                            Belum ada data anggota yang terdaftar di dalam sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
