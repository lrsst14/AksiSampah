@extends('layouts.app')

@section('content')

<!-- Tombol Login Petugas -->
<div class="position-absolute top-0 end-0 p-4">
    <a href="{{ route('petugas.login') }}" class="btn d-flex align-items-center gap-2 shadow-sm" style="background-color:#ffff;">
        <i class="bi bi-box-arrow-in-right"></i> Login Petugas
    </a>
</div>

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow p-3" style="width: 420px; background:#ffffff">
        
        <!-- Logo -->
        <div class="text-center mb-2">
            <div class="mx-auto d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 230px; height: auto; object-fit: contain; margin-top:-20px; align-items:center;">
            </div>
            <h3 class="mt-1 fw-bold" style="color: #598665;">MASUK</h3>
        </div>
        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3 d-flex align-items-center gap-2">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Email/Username Anda" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password Anda" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn w-100 shadow-sm mb-2" style="background-color: #598665; color: white;">
                Login
            </button>

            <div class="text-center">
                <span class="text-muted">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                    Daftar di sini
                </a>
                <br>
                <a href="{{ route('password.request') }}" class="text-danger text-decoration-none">
                    Lupa Sandi?
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
