@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-xl font-bold text-gray-900">Registrasi Anggota Baru</h2>
        <p class="text-xs text-gray-500 mt-1">Daftarkan akun siswa atau staf baru agar bisa menggunakan sistem lab TEFA.</p>
    </div>

    <form action="{{ route('pengguna.store') }}" method="POST" class="p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap siswa..." class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('nama')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('nama') }}" required>
            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email (Untuk Login)</label>
            <input type="email" name="email" placeholder="contoh@gmail.com" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('email')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('email') }}" required>
            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Telepon / WA</label>
                <input type="text" name="notelp" placeholder="08xxxxxxx" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('notelp')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" value="{{ old('notelp') }}" required>
                @error('notelp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Hak Akses Sistem (Role)</label>
                <select name="role" class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('role')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" required>
                    <option value="">-- Pilih Peran --</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Siswa / Peminjam)</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola Lab)</option>
                </select>
                @error('role') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi (Password)</label>
            <input type="password" name="password" placeholder="Minimal 6 karakter..." class="w-full px-3.5 py-2 border rounded-xl bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-sm" style="@error('password')border-color: rgb(239, 68, 68);@else border-color: rgb(229, 231, 235);@enderror" required>
            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-2 border-t border-gray-100 pt-5 mt-6">
            <a href="{{ route('pengguna.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition active:scale-95">Daftarkan Anggota</button>
        </div>
    </form>
</div>
@endsection
