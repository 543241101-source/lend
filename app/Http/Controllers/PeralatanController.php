<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeralatanController extends Controller
{
    /**
     * Tampilkan semua daftar peralatan (Read)
     */
    public function index()
    {
        $peralatans = Peralatan::all();
        return view('peralatan.index', compact('peralatans'));
    }

    /**
     * Tampilkan form untuk menambah peralatan baru (Create - View)
     */
    public function create()
    {
        return view('peralatan.create');
    }

    /**
     * Proses simpan data peralatan baru ke database (Create - Process)
     */
    public function store(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'nama_peralatan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib upload foto, maks 2MB
            'kondisi' => 'required|string|max:100', // Contoh isi: Bagus, Rusak Ringan, Rusak Total
        ]);

        // 2. Proses upload foto peralatan
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Menyimpan ke folder: storage/app/public/peralatan
            $fotoPath = $request->file('foto')->store('peralatan', 'public');
        }

        // 3. Simpan data ke database
        Peralatan::create([
            'nama_peralatan' => $request->nama_peralatan,
            'foto' => $fotoPath,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('peralatan.index')->with('success', 'Peralatan baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit peralatan berdasarkan ID (Update - View)
     */
    public function edit($id)
    {
        $peralatan = Peralatan::findOrFail($id);
        return view('peralatan.edit', compact('peralatan'));
    }

    /**
     * Proses update data peralatan (Update - Process)
     */
    public function update(Request $request, $id)
    {
        $peralatan = Peralatan::findOrFail($id);

        // 1. Validasi input form
        $request->validate([
            'nama_peralatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Boleh kosong jika tidak ingin ganti foto
            'kondisi' => 'required|string|max:100',
        ]);

        // 2. Handle penggantian foto jika ada file baru yang diunggah
        $fotoPath = $peralatan->foto; // Ambil path foto lama sebagai cadangan
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari folder storage agar menghemat ruang penyimpanan
            if ($peralatan->foto) {
                Storage::disk('public')->delete($peralatan->foto);
            }
            // Simpan foto yang baru dimasukkan
            $fotoPath = $request->file('foto')->store('peralatan', 'public');
        }

        // 3. Jalankan pembaruan data ke database
        $peralatan->update([
            'nama_peralatan' => $request->nama_peralatan,
            'foto' => $fotoPath,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('peralatan.index')->with('success', 'Data peralatan berhasil diperbarui!');
    }

    /**
     * Hapus data peralatan dari database (Delete)
     */
    public function destroy($id)
    {
        $peralatan = Peralatan::findOrFail($id);

        // Hapus file foto dari storage terlebih dahulu sebelum data di DB hilang
        if ($peralatan->foto) {
            Storage::disk('public')->delete($peralatan->foto);
        }

        // Hapus baris data dari database
        $peralatan->delete();

        return redirect()->route('peralatan.index')->with('success', 'Peralatan berhasil dihapus dari sistem!');
    }
}
