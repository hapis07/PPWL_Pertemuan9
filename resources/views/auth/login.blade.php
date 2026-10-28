@extends('layout.master')

@section('title', 'Login')
@section('heading', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Selamat Datang</h4>
                <p class="text-muted mb-0">
                    Masuk untuk mengakses aplikasi Data Buku.
                </p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">
                            Alamat Email
                        </label>

                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="nama@email.com"
                               autocomplete="username"
                               required
                               autofocus>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password"
                               autocomplete="current-password"
                               required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox"
                               id="remember"
                               name="remember"
                               class="form-check-input"
                               {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember" class="form-check-label">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit"
                            class="btn btn-primary w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection