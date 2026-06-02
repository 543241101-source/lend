<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ============================================
// ADMIN ROUTES (Proteksi dengan Middleware)
// ============================================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // CRUD Peralatan (Admin only)
    Route::resource('peralatan', PeralatanController::class);

    // CRUD Pengguna (Admin only)
    Route::resource('pengguna', PenggunaController::class);

    // CRUD Peminjaman dengan Approve/Reject
    Route::resource('peminjaman', PeminjamanController::class);
    Route::put('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::put('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    // Export
    Route::get('/peminjaman-export', [PeminjamanController::class, 'export'])->name('peminjaman.export');
});

// ============================================
// USER ROUTES (Proteksi dengan Middleware)
// ============================================
Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

    // User hanya bisa buat peminjaman, bukan CRUD penuh
    Route::get('/peminjaman', [PeminjamanController::class, 'userIndex'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'userCreate'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'userStore'])->name('peminjaman.store');
});

// ============================================
// AUTHENTICATED ROUTES (untuk kedua role)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Fallback dashboard route
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
        