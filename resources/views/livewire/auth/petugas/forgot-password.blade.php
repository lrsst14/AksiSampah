@extends('layouts.app')

@section('content')

<!-- Tombol Login Warga -->
<div class="position-absolute top-0 end-0 p-4">
    <a href="{{ route('login') }}" class="btn d-flex align-items-center gap-2 shadow-sm" style="background-color:#ffff;">
        <i class="bi bi-box-arrow-in-right"></i> Login Warga
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
            <h5 class="fw-bold text-secondary">Forgot Password Petugas</h5>
            <p class="text-muted small">Masukkan email Anda untuk menerima link reset password</p>
        </div>
        <br>
        <!-- Form Forgot Password Petugas -->
        <form method="POST" action="{{ route('petugas.password.email') }}">
            @csrf

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
                       placeholder="Email Petugas" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn w-100 shadow-sm mb-2" style="background-color: #d7e2d6;">
                Kirim Link Reset Password
            </button>

            <div class="text-center">
                <span class="text-muted">Ingat password Anda?</span>
                <a href="{{ route('petugas.login') }}" class="text-muted text-decoration-none">
                    Login di sini
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
