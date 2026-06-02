@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Peralatan</h2>

    <form action="{{ route('peralatan.update', $peralatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Peralatan</label>
            <input type="text" name="nama_peralatan" value="{{ $peralatan->nama_peralatan }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Foto Saat Ini</label>
            <img src="{{ asset('storage/' . $peralatan->foto) }}" alt="Foto Alat" class="w-32 h-32 object-cover rounded mb-2">

            <label class="block text-gray-700 font-semibold mb-2">Ganti Foto <span class="text-xs text-gray-500">(Kosongkan jika tidak diganti)</span></label>
            <input type="file" name="foto" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Kondisi</label>
            <select name="kondisi" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="Bagus" {{ $peralatan->kondisi == 'Bagus' ? 'selected' : '' }}>Bagus</option>
                <option value="Rusak Ringan" {{ $peralatan->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="Rusak Berat" {{ $peralatan->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('peralatan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Perbarui</button>
        </div>
    </form>
</div>
@endsection
