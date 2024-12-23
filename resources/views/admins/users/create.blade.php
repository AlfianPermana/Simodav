@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            User
                        </div>
                        <h2 class="page-title">
                            Tambah User Baru
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="{{ route('admins.users.store') }}" method="POST" class="card">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title">Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Name</label>
                                            <div class="col">
                                                <input id="name" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('name') }}" required autofocus
                                                    aria-describedby="nameHelp" placeholder="User name" />
                                                <small class="form-hint">
                                                    Nama lengkap user, gunakan huruf kapital pada awal kata.
                                                </small>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Email</label>
                                            <div class="col">
                                                <input id="email" name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('email') }}" required
                                                    aria-describedby="emailHelp" placeholder="User email" />
                                                <small class="form-hint">
                                                    Masukkan email yang valid.
                                                </small>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Password</label>
                                            <div class="col">
                                                <input id="password" name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    autocomplete="off" required aria-describedby="passwordHelp"
                                                    placeholder="User password" />
                                                <small class="form-hint">
                                                    Password sementara user, password dapat diubah setelah user
                                                    berhasil ditambahkan.
                                                </small>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Role</label>
                                            <div class="col">
                                                <select id="role" name="role"
                                                    class="form-select @error('role') is-invalid @enderror" required>
                                                    <option value="" selected disabled>Pilih role</option>
                                                    <option value="admin"
                                                        @if (old('role') == 'admin') selected @endif>
                                                        Admin
                                                    </option>
                                                    <option value="user"
                                                        @if (old('role') == 'user') selected @endif>
                                                        User
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <small class="form-hint">
                                                    Role authorisasi user.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-ghost-secondary">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
