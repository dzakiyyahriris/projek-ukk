<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// =============================================================
// IMPORT CONTROLLERS
// =============================================================
use App\Http\Controllers\DashboardController; // Admin Dashboard
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\TipeTiketController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\CheckinController;

// User Namespace Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\UserOrderController;

// =============================================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// =============================================================
Route::get('/', [UserDashboardController::class, 'index'])->name('landing');
Route::get('/destinasi', [UserDashboardController::class, 'allEvents'])->name('user.destinasi');

// =============================================================
// 2. RUTE TERPROTEKSI (Wajib Login)
// =============================================================
Route::middleware(['auth'])->group(function () {

    // --- A. GLOBAL (Profile & Logout) ---
    Route::get('/profil', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profil', [UserProfileController::class, 'update'])->name('profile.update');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');


    // =============================================================
    // AREA ADMIN (Resource & Manajemen Data)
    // =============================================================

    // 1. Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Export PDF (WAJIB DI ATAS RESOURCE AGAR TIDAK ERROR)
    Route::get('/users/pdf', [UserController::class, 'cetakPdf'])->name('users.pdf');
    Route::get('/acara/cetak-pdf', [AcaraController::class, 'cetakPdf'])->name('acara.pdf');
    // Khusus Pesanan PDF (Laporan Semua Pesanan)
    Route::get('/pesanan/cetak-pdf', [PesananController::class, 'pdf'])->name('pesanan.pdf');

    // 3. Admin Custom Actions (Status & Nota)
    Route::patch('/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])->name('admin.pesanan.updateStatus');

    // -- PERBAIKAN NOTA --
    // Ini route untuk mencetak SATU nota pesanan tertentu
    Route::get('/pesanan/{id}/nota', [PesananController::class, 'cetakNota'])->name('pesanan.nota');

    // 4. Resource CRUD (Bawaan Laravel)
    Route::resource('users', UserController::class);
    Route::resource('acara', AcaraController::class);
    Route::resource('tipe_tiket', TipeTiketController::class);
    Route::resource('pesanan', PesananController::class);

    // 5. Fitur Khusus Admin: Checkin & Loket
    // Saya beri prefix 'admin' agar URL-nya menjadi /admin/checkin
    Route::prefix('admin')->group(function () {
        Route::get('/checkin', [CheckinController::class, 'index'])->name('admin.checkin.index');
        Route::post('/checkin', [CheckinController::class, 'check'])->name('admin.checkin.check');
        Route::post('/checkin/process-payment/{id}', [CheckinController::class, 'processPayment'])->name('admin.checkin.process_payment');

        // Konfirmasi Pembayaran Manual
        Route::put('/pembayaran/konfirmasi/{id_pembayaran}', [PembayaranController::class, 'konfirmasiAdmin'])->name('admin.pembayaran.konfirmasi');
    });


    // =============================================================
    // AREA USER / PELANGGAN
    // =============================================================

    // Dashboard User
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Booking & Order Flow
    Route::get('/booking/{id}', [BookingController::class, 'index'])->name('user.booking');
    Route::post('/booking/store', [BookingController::class, 'storeOrder'])->name('user.booking.store');
    Route::get('/pesanan-saya', [UserOrderController::class, 'index'])->name('user.orders');

    // Pembayaran User
    Route::post('/pembayaran/bayar/{id_pesanan}', [PembayaranController::class, 'bayarCash'])->name('pesanan.bayar');
    Route::post('/pembayaran/proses/{id_pesanan}', [PembayaranController::class, 'prosesPembayaran'])->name('pembayaran.simpan');
    Route::get('/pembayaran/instruksi/{id_pesanan}', [PembayaranController::class, 'instruksi'])->name('pembayaran.instruksi');
    // Route untuk Admin
    Route::get('/admin/pesanan/{id}/nota', [PesananController::class, 'cetakNotaAdmin'])->name('admin.pesanan.nota');

    // Route untuk User
    Route::get('/pesanan/{id}/nota', [PesananController::class, 'cetakNotaUser'])->name('pesanan.nota');
});

require __DIR__ . '/auth.php';
