@extends('layouts.app')

@section('title', 'Login cafca')

@section('content')
<style>
    /* Mengatur latar belakang seluruh halaman */
    body, html {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        font-family: 'Poppins', sans-serif;
    }

    /* Pembungkus utama untuk memaksa posisi tepat di tengah layar */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
    }

    .card-login {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(56, 189, 248, 0.15);
        padding: 40px 30px;
    }

    .login-header h3 {
        color: #0284c7;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .login-header p {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #ffffff;
        border-color: #38bdf8;
        box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.2);
    }

    .btn-pastel-primary {
        background-color: #38bdf8;
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
    }

    .btn-pastel-primary:hover {
        background-color: #0284c7;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(2, 132, 199, 0.4);
        color: white;
    }

    .alert-pastel {
        background-color: #e0f2fe;
        border: 1px solid #7dd3fc;
        color: #0369a1;
        border-radius: 12px;
        font-size: 14px;
    }
</style>

<div class="login-wrapper">
    <div class="login-container">

        {{-- Alert Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-pastel alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-login">
            <div class="login-header text-center">
                <h3>Login cafca</h3>
                <p>Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-secondary fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-pastel-primary">Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection