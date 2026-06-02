<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Tampilkan semua data anggota (Read)
     */
    public function index()
    {
        // Menggunakan variabel $penggunas agar cocok dengan @forelse($penggunas as ...) di index.blade
        $penggunas = Pengguna::all();
        return view('pengguna.index', compact('penggunas'));
    }

    /**
     * Tampilkan form registrasi anggota (Create - View)
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Proses simpan anggota baru (Create - Process)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Menembak tabel 'penggunas' yang asli)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas,email',
            'notelp' => 'required|string|max:15',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:6',
        ]);

        // 2. Simpan data ke tabel penggunas
        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Password wajib di-hash demi keamanan
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Anggota berhasil didaftarkan!');
    }

    /**
     * Tampilkan form edit data anggota (Update - View)
     */
    // Pastikan parameter di dalam kurung menggunakan ($id) biasa
public function edit($id)
{
    $pengguna = Pengguna::findOrFail($id);
    return view('pengguna.edit', compact('pengguna'));
}



    /**
     * Proses update data anggota (Update - Process)
     */
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        // 1. Validasi Input (Kecualikan email milik user ini sendiri agar tidak mentok unique)
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunas,email,' . $pengguna->id,
            'notelp' => 'required|string|max:15',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:6', // Boleh kosong kalau tidak mau ganti password
        ]);

        // 2. Siapkan data untuk diupdate
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'notelp' => $request->notelp,
            'role' => $request->role,
        ];

        // 3. Jika password diisi, enkripsi dan masukkan ke data update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    /**
     * Hapus data anggota (Delete)
     */
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Anggota berhasil dihapus dari sistem!');
    }
}
