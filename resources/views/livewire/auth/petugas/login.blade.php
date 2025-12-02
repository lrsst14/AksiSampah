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
                <img src="{{ asset('img/Gemini_Generated_Image_ckcuywckcuywckcu-removebg-preview.png') }}" alt="Logo" style="width: 230px; height: auto; object-fit: contain; margin-top:-20px; align-items:center;">
            </div>
        </div>
        <!-- Tabs Login / Register -->
        <div class="d-flex justify-content-center mb-6 gap-4" style="margin-top: -30px;">
            <a href="{{ route('petugas.login') }}" class="text-secondary text-decoration-none fw-bold">
                Login
            </a>

            <a href="{{ route('petugas.register') }}" class="text-secondary text-decoration-none fw-bold">
                Register
            </a>
        </div>
        <br>
        <!-- Form Login Petugas -->
        <form method="POST" action="{{ route('petugas.login.store') }}">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3 d-flex align-items-center gap-2">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="ID/Email Petugas" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password Petugas" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn w-100 shadow-sm mb-2" style="background-color: #d7e2d6;">
                Login
            </button>

            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-muted text-decoration-none">
                    Forgot Password ?
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

