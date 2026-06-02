@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Pengguna</h2>

    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input type="text" name="nama" value="{{ $pengguna->nama }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ $pengguna->email }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">No. Telp</label>
            <input type="text" name="notelp" value="{{ $pengguna->notelp }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Password <span class="text-xs text-gray-500">(Kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Role</label>
            <select name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="user" {{ $pengguna->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('pengguna.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Perbarui</button>
        </div>
    </form>
</div>
@endsection
