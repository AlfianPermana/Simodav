@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Product
                        </div>
                        <h2 class="page-title">
                            Update Produk
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="{{ route('admins.products.update', $product->id) }}" enctype="multipart/form-data"
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
                                            <label class="col-3 col-form-label required">Nama Produk</label>
                                            <div class="col">
                                                <input id="name" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('name') ?? $product->name }}" required
                                                    autofocus aria-describedby="nameHelp" placeholder="Nama Produk" />
                                                <small class="form-hint">
                                                    Nama produk yang akan dijual.
                                                </small>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Deskripsi Produk</label>
                                            <div class="col">
                                                <textarea id="description" name="description" type="text"
                                                    class="form-control @error('description') is-invalid @enderror" autocomplete="off"
                                                    aria-describedby="descriptionHelp" placeholder="Deskripsi Produk" autofocus required rows="5">{{ old('description') ?? $product->description }}</textarea>
                                                <small class="form-hint">
                                                    Deskripsi singkat mengenai detail produk.
                                                </small>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label required">Harga Produk</label>
                                            <div class="col">
                                                <input id="price" name="price" type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('price') ?? $product->price }}"
                                                    required autofocus aria-describedby="priceHelp"
                                                    placeholder="Harga Produk" />
                                                <small class="form-hint">
                                                    Harga produk dalam satuan IDR.
                                                </small>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-3 col-form-label">Gambar Produk</label>
                                            <div class="col">
                                                <input id="image" name="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    autocomplete="off" value="{{ old('image') }}" autofocus
                                                    aria-describedby="imageHelp" placeholder="Gambar Produk" />
                                                <small class="form-hint">
                                                    Gambar produk (optional), format: jpg, jpeg, png, webp, gif, svg, bmp,
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
