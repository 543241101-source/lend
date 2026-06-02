<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peralatan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard dengan statistik
     */
    public function adminDashboard()
    {
        // Statistik untuk Admin
        $total_user = User::where('role', 'user')->count();
        $total_barang = Peralatan::count();
        $peminjaman_aktif = Peminjaman::whereNull('tanggal_kembali')->count();
        $peminjaman_pending = Peminjaman::whereNull('status')->orWhere('status', 'pending')->count();

        // Data peminjaman terbaru untuk ditampilkan di tabel
        $peminjamans = Peminjaman::with(['pengguna', 'peralatan'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact(
            'total_user',
            'total_barang',
            'peminjaman_aktif',
            'peminjaman_pending',
            'peminjamans'
        ));
    }

    /**
     * User Dashboard
     */
    public function userDashboard(Request $request)
    {
        // Search dan filter barang
        $search = $request->get('search');
        $kondisi = $request->get('kondisi');

        $peralatans = Peralatan::query();

        if ($search) {
            $peralatans->where('nama_peralatan', 'like', "%{$search}%");
        }

        if ($kondisi) {
            $peralatans->where('kondisi', $kondisi);
        }

        $peralatans = $peralatans->paginate(12);

        // Data peminjaman user sendiri
        $my_peminjamans = Peminjaman::where('id_user', Auth::id())
            ->with('peralatan')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.user', compact('peralatans', 'my_peminjamans', 'search', 'kondisi'));
    }
}
