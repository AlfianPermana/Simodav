@extends('auth.layouts.app')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">

            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                    <span class="ms-2 fs-1 fw-bold">Selamat Datang di Sistem Dava Kebab</span>
                </a>
            </div>

            @if (session('success'))
                <div class="col-12 mb-4">
                    <div class="alert alert-success" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-check icon alert-icon"></i></div>
                            <div>
                                <h4 class="alert-title">Success</h4>
                                <div class="text-secondary">{{ session('success') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="col-12 mb-4">
                    <div class="alert alert-danger" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-x icon alert-icon"></i></div>
                            <div>
                                <h4 class="alert-title">Error</h4>
                                <div class="text-secondary">{{ session('error') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">
                        Silahkan Login Terlebih Dahulu
                    </h2>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="your@email.com" autocomplete="off" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                <span class="input-group-text">
                                    <div class="cursor-pointer link-secondary" title="Show password"
                                        data-bs-toggle="tooltip" id="showPassword">
                                        <i class="ti ti-eye icon"></i>
                                    </div>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('showPassword').addEventListener('click', function() {
                const password = document.getElementById('password');
                if (password.type === 'password') password.type = 'text';
                else password.type = 'password';
            });
        </script>
    @endpush
@endsection
