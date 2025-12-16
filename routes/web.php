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
Route::get('/petugas/reset-password/{token}', [LoginRegisterController::class, 'showPetugasResetPasswordForm'])->name('petugas.password.reset');
Route::post('/petugas/reset-password', [LoginRegisterController::class, 'petugasResetPassword'])->name('petugas.password.update');

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::middleware(['auth'])->group(function () {
    // Warga routes
    Route::get('/warga/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Statistik sampah bulanan
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        $currentMonthGram = $user->laporans()->whereYear('created_at', $currentYear)->whereMonth('created_at', $currentMonth)->sum('gram');
        $lastMonthGram = $user->laporans()->whereYear('created_at', $lastMonthYear)->whereMonth('created_at', $lastMonth)->sum('gram');

        // Persentase jenis sampah
        $jenisCounts = $user->laporans()->selectRaw('jenis_sampah, COUNT(*) as count')->groupBy('jenis_sampah')->pluck('count', 'jenis_sampah')->toArray();
        $totalLaporans = array_sum($jenisCounts);
        $jenisPercentages = [];
        foreach (['organik', 'anorganik', 'b3'] as $jenis) {
            $count = $jenisCounts[$jenis] ?? 0;
            $jenisPercentages[$jenis] = $totalLaporans > 0 ? round(($count / $totalLaporans) * 100) : 0;
        }
        // Plastik mungkin tidak ada, tapi sesuai request
        $jenisPercentages['plastik'] = 0; // Asumsi tidak ada

        return view('dashboardwarga', compact('currentMonthGram', 'lastMonthGram', 'jenisPercentages'));
    })->name('warga.dashboard');

    Route::get('/warga/laporan', function () {
        return view('laporanwarga');
    })->name('warga.laporan');

    Route::post('/warga/laporan', [LaporanController::class, 'store'])->name('warga.laporan.store');

    Route::get('/warga/riwayat', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $laporans = $user->laporans()->with('jadwal')->orderBy('created_at', 'desc')->get();
    return view('riwayatwarga', compact('laporans'));
    })->name('warga.riwayat');

    Route::get('/warga/jadwal', function () {
        $jadwals = \App\Models\Jadwal::orderBy('tanggal', 'desc')->get();
        return view('jadwalwarga', compact('jadwals'));
    })->name('warga.jadwal');

    // Petugas routes
    Route::get('/petugas/dashboard', function () {
        // Data untuk ringkasan hari ini
        $today = now()->toDateString();
        $pendingToday = \App\Models\Laporan::whereDate('created_at', $today)->where('status', 'pending')->count();
        $verifiedToday = \App\Models\Laporan::whereDate('created_at', $today)->where('status', 'verified')->count();
        $totalToday = $pendingToday + $verifiedToday;
        $percentage = $totalToday > 0 ? round(($verifiedToday / $totalToday) * 100) : 0;

        // Data untuk grafik bulanan
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = \App\Models\Laporan::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count();
            $monthlyData[] = $count;
        }

        return view('dashboardpetugas', compact('pendingToday', 'verifiedToday', 'totalToday', 'percentage', 'monthlyData'));
    })->name('petugas.dashboard');

    Route::get('/petugas/laporan', [LaporanController::class, 'index'])->name('petugas.laporan');
    Route::post('/petugas/laporan/{id}/verify', [LaporanController::class, 'verify'])->name('petugas.laporan.verify');
    Route::put('/petugas/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('petugas.laporan.updateStatus');
    Route::get('/petugas/jadwal', [JadwalController::class, 'index'])->name('petugas.jadwal');
    Route::post('/petugas/jadwal', [JadwalController::class, 'store'])->name('petugas.jadwal.store');
    Route::put('/petugas/jadwal/{jadwal}', [JadwalController::class, 'update'])->name('petugas.jadwal.update');
    Route::delete('/petugas/jadwal/{jadwal}', [JadwalController::class, 'destroy'])->name('petugas.jadwal.destroy');
    Route::post('/petugas/jadwal/{jadwal}/complete', [JadwalController::class, 'complete'])->name('petugas.jadwal.complete');

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