@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Catatan Pembelian Bahan Baku
                        </div>
                        <h2 class="page-title">
                            Tambah Catatan
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="{{ route('admins.invetaris.store') }}" enctype="multipart/form-data" method="POST"
                            class="card">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title">Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Nama Penanggung Jawab</label>
                                            <div class="col">
                                                <input id="name" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('name') }}" required autofocus
                                                    aria-describedby="nameHelp" placeholder="Nama Penanggung Jawab" />
                                                <small class="form-hint">
                                                    Nama Karyawan yang membeli bahan baku.
                                                </small>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Total Pengeluaran</label>
                                            <div class="col">
                                                <input id="price" name="price" type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('price') }}" required autofocus
                                                    aria-describedby="priceHelp" placeholder="Total Pengeluaran" />
                                                <small class="form-hint">
                                                    Harga produk dalam satuan Rupiah.
                                                </small>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label">Nota Pembelian</label>
                                            <div class="col">
                                                <input id="image" name="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('image') }}" autofocus
                                                    aria-describedby="imageHelp" placeholder="Nota Pembelian" />
                                                <small class="form-hint">
                                                    Masukkan Nota Pembelian, format: jpg, jpeg, png, webp, gif, svg, bmp,
                                                    max: 2MB.
                                                </small>
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
