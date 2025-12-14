@extends('layouts.app')

@section('content')

<!-- Tombol Login Warga -->
<div class="position-absolute top-0 end-0 p-4">
    <a href="{{ route('login') }}" class="btn d-flex align-items-center gap-2 shadow-sm" style="background-color:#ffff;">
        <i class="bi bi-box-arrow-in-right"></i> Login Warga
    </a>
</div>

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow p-3" style="width: 420px; background:#ffffff">
        
        <!-- Logo -->
        <div class="text-center mb-2">
            <div class="mx-auto d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 230px; height: auto; object-fit: contain; margin-top:-20px; align-items:center;">
            </div>
            <h3 class="mt-1 fw-bold" style="color: #598665;">DAFTAR</h3>
        </div>
        <!-- Form Register -->
        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                      placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                      placeholder="Email Anda" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="Konfirmasi Password" required>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn w-100 shadow-sm mb-2" style="background-color: #598665; color: white;">
                Daftar
            </button>

            <div class="text-center">
                <span class="text-muted">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                    Masuk di sini
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
