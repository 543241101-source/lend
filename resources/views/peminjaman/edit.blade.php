@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Peminjaman</h2>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Pengguna</label>
            <select name="id_user" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $peminjaman->id_user == $user->id ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Peralatan</label>
            <select name="id_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($peralatan as $item)
                    <option value="{{ $item->id }}" {{ $peminjaman->id_barang == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_peralatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Evidence Foto Saat Ini</label>
            @if($peminjaman->evidence_foto)
                <img src="{{ asset('storage/' . $peminjaman->evidence_foto) }}" alt="Evidence" class="w-32 h-32 object-cover rounded mb-2">
            @else
                <p class="text-sm text-gray-400 italic mb-2">Belum ada foto yang diunggah</p>
            @endif

            <label class="block text-gray-700 font-semibold mb-2">Ganti Evidence Foto</label>
            <input type="file" name="evidence_foto" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Perbarui</button>
        </div>
    </form>
</div>
@endsection
