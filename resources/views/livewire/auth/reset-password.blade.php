@extends('layouts.app')

@section('content')

<!-- Tombol Login Petugas -->
<div class="position-absolute top-0 end-0 p-4">
    <a href="{{ route('petugas.login') }}" class="btn d-flex align-items-center gap-2 shadow-sm" style="background-color:#ffff;">
        <i class="bi bi-box-arrow-in-right"></i> Login Petugas
    </a>
</div>

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow p-4" style="width: 420px; background:#ffff">
        
        <!-- Logo -->
        <div class="text-center mb-4">
            <div class="mx-auto d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 230px; height: auto; object-fit: contain; margin-top:-20px; align-items:center;">
            </div>
        </div>
        <!-- Title -->
        <div class="text-center mb-4">
            <h5 class="fw-bold text-secondary">Reset Password</h5>
            <p class="text-muted small">Silakan masukkan password baru Anda</p>
        </div>
        <br>
        <!-- Form Reset Password -->
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Email Anda" value="{{ request('email') ?? old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password Baru" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="Konfirmasi Password Baru" required>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn w-100 shadow-sm mb-2" style="background-color: #d7e2d6;">
                Reset Password
            </button>

            <div class="text-center">
                <span class="text-muted">Ingat password Anda?</span>
                <a href="{{ route('login') }}" class="text-muted text-decoration-none">
                    Login di sini
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
