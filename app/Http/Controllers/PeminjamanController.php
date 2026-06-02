<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengguna;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan semua data peminjaman (Read)
     */
    public function index(Request $request)
    {
        $allPeminjaman = Peminjaman::with(['pengguna', 'peralatan'])->get();

        if ($request->get('role') === 'user') {
            $peminjamans = $allPeminjaman;
            return view('peminjaman.user', compact('peminjamans'));
        }

        return view('peminjaman.admin', compact('allPeminjaman'));
    }

    /**
     * Tampilkan form untuk menambah peminjaman (Create - View)
     */
    public function create()
    {
        $users = Pengguna::all();
        $peralatans = Peralatan::all();
        // Kirim dalam bentuk tunggal dan jamak agar aman dari salah ketik di Blade
        return view('peminjaman.create', [
            'users' => $users,
            'peralatans' => $peralatans,
            'peralatan' => $peralatans // Menyediakan bentuk tunggal juga
        ]);
    }

    /**
     * Proses simpan data peminjaman baru ke database (Create - Process)
     */
    public function store(Request $request)
    {
        // PERBAIKAN VALIDASI: Nama tabel disesuaikan ke 'penggunas' & 'peralatans', kolom primary key diubah ke 'id'
        $request->validate([
            'id_user' => 'required|exists:penggunas,id',
            'id_barang' => 'required|exists:peralatans,id',
            'evidence_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_pinjam' => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('evidence_foto')) {
            $fotoPath = $request->file('evidence_foto')->store('evidence', 'public');
        }

        Peminjaman::create([
            'id_user' => $request->id_user,
            'id_barang' => $request->id_barang,
            'evidence_foto' => $fotoPath,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => null,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Tampilkan detail data peminjaman tertentu (Show - View)
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['pengguna', 'peralatan'])->findOrFail($id);

        // SOLUSI ERROR UNDEFINED VARIABLE: Mengirimkan $peralatans untuk menyuplai komponen @forelse di show.blade
        $peralatans = Peralatan::all();

        return view('peminjaman.show', compact('peminjaman', 'peralatans'));
    }

    /**
     * Tampilkan form edit data peminjaman (Update - View)
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = Pengguna::all();
        $peralatan = Peralatan::all();
        return view('peminjaman.edit', compact('peminjaman', 'users', 'peralatan'));
    }

    /**
     * Proses update data peminjaman (Update - Process)
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // PERBAIKAN VALIDASI: Nama tabel disesuaikan ke 'penggunas' & 'peralatans', kolom primary key diubah ke 'id'
        $request->validate([
            'id_user' => 'required|exists:penggunas,id',
            'id_barang' => 'required|exists:peralatans,id',
            'evidence_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
        ]);

        $fotoPath = $peminjaman->evidence_foto;
        if ($request->hasFile('evidence_foto')) {
            if ($peminjaman->evidence_foto) {
                Storage::disk('public')->delete($peminjaman->evidence_foto);
            }
            $fotoPath = $request->file('evidence_foto')->store('evidence', 'public');
        }

        $peminjaman->update([
            'id_user' => $request->id_user,
            'id_barang' => $request->id_barang,
            'evidence_foto' => $fotoPath,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    /**
     * Hapus data peminjaman (Delete)
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->evidence_foto) {
            Storage::disk('public')->delete($peminjaman->evidence_foto);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }

    /**
     * Approve peminjaman (Admin only)
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'approved']);
        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    /**
     * Reject peminjaman (Admin only)
     */
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'rejected']);
        return back()->with('success', 'Peminjaman berhasil ditolak!');
    }

    /**
     * User Index - Lihat peminjaman milik sendiri
     */
    public function userIndex()
    {
        $peminjamans = Peminjaman::where('id_user', auth()->id())
            ->with(['peralatan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjaman.user-list', compact('peminjamans'));
    }

    /**
     * User Create - Form peminjaman dengan user ID otomatis
     */
    public function userCreate()
    {
        $peralatans = Peralatan::all();
        return view('peminjaman.user-create', compact('peralatans'));
    }

    /**
     * User Store - Simpan peminjaman dengan user ID dari Auth
     */
    public function userStore(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:peralatans,id',
            'evidence_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
        ]);

        $fotoPath = null;
        if ($request->hasFile('evidence_foto')) {
            $fotoPath = $request->file('evidence_foto')->store('evidence', 'public');
        }

        Peminjaman::create([
            'id_user' => auth()->id(), // OTOMATIS dari user yang login
            'id_barang' => $request->id_barang,
            'evidence_foto' => $fotoPath,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('user.peminjaman.index')->with('success', 'Peminjaman berhasil diajukan!');
    }
}
