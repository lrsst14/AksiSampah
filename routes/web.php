<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/petugas/login', [LoginRegisterController::class, 'showPetugasForm'])->name('petugas.login');
Route::post('/petugas/login', [LoginRegisterController::class, 'petugasLogin'])->name('petugas.login.store');
Route::get('/petugas/register', [LoginRegisterController::class, 'showPetugasRegisterForm'])->name('petugas.register');
Route::post('/petugas/register', [LoginRegisterController::class, 'petugasRegister'])->name('petugas.register.store');
Route::get('/petugas/forgot-password', [LoginRegisterController::class, 'showPetugasForgotPasswordForm'])->name('petugas.password.request');
Route::post('/petugas/forgot-password', [LoginRegisterController::class, 'petugasForgotPassword'])->name('petugas.password.email');

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Warga routes
    Route::get('/warga/dashboard', function () {
        return view('dashboardwarga');
    })->name('warga.dashboard');

    Route::get('/warga/laporan', function () {
        return view('laporanwarga');
    })->name('warga.laporan');

    Route::post('/warga/laporan', [LaporanController::class, 'store'])->name('warga.laporan.store');

    Route::get('/warga/riwayat', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $laporans = $user->laporans()->orderBy('created_at', 'desc')->get();
    return view('riwayatwarga', compact('laporans'));
    })->name('warga.riwayat');

    Route::get('/warga/jadwal', function () {
        $jadwals = \App\Models\Jadwal::orderBy('tanggal', 'desc')->get();
        return view('jadwalwarga', compact('jadwals'));
    })->name('warga.jadwal');

    // Petugas routes
    Route::get('/petugas/dashboard', function () {
        return view('dashboardpetugas');
    })->name('petugas.dashboard');

    Route::get('/petugas/laporan', [LaporanController::class, 'index'])->name('petugas.laporan');
    Route::post('/petugas/laporan/{id}/verify', [LaporanController::class, 'verify'])->name('petugas.laporan.verify');
    Route::put('/petugas/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('petugas.laporan.updateStatus');
    Route::get('/petugas/jadwal', [JadwalController::class, 'index'])->name('petugas.jadwal');
    Route::post('/petugas/jadwal', [JadwalController::class, 'store'])->name('petugas.jadwal.store');
    Route::put('/petugas/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('petugas.jadwal.update');
    Route::delete('/petugas/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('petugas.jadwal.destroy');

    Route::get('/warga/edukasi', function () {
        return view('edukasiwarga');
    })->name('warga.edukasi');

    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Route::get('dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'warga') {
            return redirect()->route('warga.dashboard');
        } elseif ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }
        return redirect('/');
    })->name('dashboard');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');