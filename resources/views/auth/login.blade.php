@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="d-flex flex-column justify-content-center min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Catatku</h1>
                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating mb-3 position-relative">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Username</label>
                        <span class="input-icon">
                            <i class="bi bi-person"></i>
                        </span>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <span class="input-icon">
                            <i class="bi bi-lock"></i>
                        </span>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2 rounded-pill" type="submit">Login</button>
                </form>

            </main>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #0a3d62;
    }

    .form-signin {
        background-color: #1e272e;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .form-signin .form-floating {
        margin-bottom: 20px;
    }

    .form-signin .form-floating input {
        border-radius: 30px;
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
    }

    .form-signin .form-floating label {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-signin .form-floating .input-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.7);
    }

    .form-signin .btn {
        background-color: #fff;
        color: #0a3d62;
        font-weight: bold;
    }

    .form-signin .btn:hover {
        background-color: #ddd;
    }

    .form-signin .text-center a {
        color: #fff;
        text-decoration: underline;
    }

    .form-signin .text-center a:hover {
        color: #ddd;
    }

    footer {
        background-color: #f8f9fa;
        text-align: center;
        padding: 20px 0;
        width: 100%;
    }

    .min-vh-100 {
        min-height: 100vh;
    }

    .mt-auto {
        margin-top: auto;
    }
</style>
@endsection
