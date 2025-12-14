<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\LoginRegisterController;

// Warga: rute kustom login/register
Route::get('/login', [LoginRegisterController::class, 'showWargaForm'])->name('login');
Route::post('/login', [LoginRegisterController::class, 'wargaLogin'])->name('login.store');

// Petugas: rute login petugas (placeholder untuk saat ini)
Route::get('/petugas/login', [LoginRegisterController::class, 'showPetugasForm'])->name('petugas.login');
Route::post('/petugas/login', [LoginRegisterController::class, 'petugasLogin'])->name('petugas.login.store');
Route::get('/petugas/register', [LoginRegisterController::class, 'showPetugasRegisterForm'])->name('petugas.register');
Route::post('/petugas/register', [LoginRegisterController::class, 'petugasRegister'])->name('petugas.register.store');
Route::get('/petugas/forgot-password', [LoginRegisterController::class, 'showPetugasForgotPasswordForm'])->name('petugas.password.request');
Route::post('/petugas/forgot-password', [LoginRegisterController::class, 'petugasForgotPassword'])->name('petugas.password.email');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Petugas dashboard (render dashboard view)
Route::view('/dashboardpetugas', 'dashboardpetugas')->name('petugas.dashboard');

// Petugas separate pages
Route::view('/petugas/daftar-laporan', 'daftar-laporan')->name('petugas.daftar');
Route::view('/petugas/jadwal-pengangkutan', 'jadwal-pengangkutan')->name('petugas.jadwal');

// (dashboardpetugas view exists but routes redirect to separate pages)

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

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

Route::middleware(['auth'])->group(function () {
    Route::get('dashboardwarga', function () {
        return view('dashboardwarga');
    })->name('warga.dashboard');
});

// tampilkan form laporan
Route::get('/warga/laporan', function () {
    return view('laporanwarga');
})->name('warga.laporan');

// terima submit laporan (dummy)
Route::post('/warga/laporan', function () {
    return redirect()
        ->route('warga.dashboard')
        ->with('success', 'Laporan sampah berhasil dikirim dan akan diproses petugas.');
})->name('warga.laporan.store');
