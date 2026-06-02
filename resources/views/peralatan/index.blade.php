@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Peralatan</h2>
        <a href="{{ route('peralatan.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Peralatan</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3">Foto</th>
                <th class="p-3">Nama Alat</th>
                <th class="p-3">Kondisi</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peralatans as $alat)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">
                    <img src="{{ asset('storage/' . $alat->foto) }}" class="w-12 h-12 object-cover rounded">
                </td>
                <td class="p-3 font-semibold">{{ $alat->nama_peralatan }}</td>
                <td class="p-3">{{ $alat->kondisi }}</td>
                <td class="p-3">
                    <a href="{{ route('peralatan.edit', $alat->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    <form action="{{ route('peralatan.destroy', $alat->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus peralatan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
