@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-xl font-bold text-gray-900">Edit Data Pengguna</h2>
        <p class="text-xs text-gray-500 mt-1">Perbarui informasi akun pengguna sistem lab TEFA.</p>
    </div>

    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST" class="p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap..." class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('nama')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('nama', $pengguna->nama) }}" required>
            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
            <input type="email" name="email" placeholder="contoh@gmail.com" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('email')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('email', $pengguna->email) }}" required>
            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Telepon / WA</label>
            <input type="text" name="notelp" placeholder="08xxxxxxx" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('notelp')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('notelp', $pengguna->notelp) }}" required>
            @error('notelp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Hak Akses Sistem (Role)</label>
            <select name="role" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('role')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" required>
                <option value="user" {{ (old('role', $pengguna->role) == 'user') ? 'selected' : '' }}>User (Siswa / Peminjam)</option>
                <option value="admin" {{ (old('role', $pengguna->role) == 'admin') ? 'selected' : '' }}>Admin (Pengelola Lab)</option>
            </select>
            @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi (Password) <span class="text-xs font-normal text-gray-500">(Kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password..." class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('password')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror">
            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-2 border-t border-gray-100 pt-5 mt-6">
            <a href="{{ route('pengguna.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition active:scale-95">Perbarui Data</button>
        </div>
    </form>
</div>
@endsection
