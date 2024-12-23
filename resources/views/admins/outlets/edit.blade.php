@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Outlet
                        </div>
                        <h2 class="page-title">
                            Update Outlet
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="{{ route('admins.outlets.update', $outlet->id) }}" enctype="multipart/form-data"
                            method="POST" class="card">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4 class="card-title">Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Nama Outlet</label>
                                            <div class="col">
                                                <input id="name" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('name') ?? $outlet->name }}" required
                                                    autofocus aria-describedby="nameHelp" placeholder="Nama Outlet" />
                                                <small class="form-hint">
                                                    Nama Lengkap outlet.
                                                </small>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Alamat Outlet</label>
                                            <div class="col">
                                                <textarea id="address" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                                    autocomplete="off" aria-describedby="addressHelp" placeholder="Alamat Outlet" autofocus required rows="5">{{ old('address') ?? $outlet->address }}</textarea>
                                                <small class="form-hint">
                                                    Alamat lengkap dimana outlet berada.
                                                </small>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">No. Telepon</label>
                                            <div class="col">
                                                <input id="phone" name="phone" type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('phone') ?? $outlet->phone }}" required
                                                    autofocus aria-describedby="phoneHelp" placeholder="No. Telepon" />
                                                <small class="form-hint">
                                                    Nomor telepon outlet.
                                                </small>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label">Gambar Outlet</label>
                                            <div class="col">
                                                <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    aria-describedby="imageHelp" placeholder="Gambar Produk">
                                                <small class="form-hint">
                                                    Gambar outlet yang akan ditampilkan.
                                                </small>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">User</label>
                                            <div class="col">
                                                <input id="user_id" name="user_id" type="text"
                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                    value="{{ $outlet->owner?->name }}" disabled
                                                    aria-describedby="user_idHelp" placeholder="User" />
                                                <small class="form-hint">
                                                    User yang memiliki akses ke outlet.
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
