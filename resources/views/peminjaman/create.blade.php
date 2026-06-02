@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Form Peminjaman Barang Baru</h2>

    <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Pilih Pengguna (Peminjam)</label>
            <select name="id_user" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->role }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Pilih Peralatan</label>
            <select name="id_barang" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($peralatan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_peralatan }} (Kondisi: {{ $item->kondisi }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Evidence Foto (Bukti Pinjam)</label>
            <input type="file" name="evidence_foto" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Kembali (Opsional)</label>
                <input type="date" name="tanggal_kembali" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="flex justify-end gap-2 border-t pt-4">
            <a href="{{ route('peminjaman.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow">Simpan Transaksi</button>
        </div>
    </form>
</div>
@endsection
