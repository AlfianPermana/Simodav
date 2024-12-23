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
                            List Produk
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admins.products.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus icon"></i>
                                Tambah Produk
                            </a>
                            <a href="{{ route('admins.products.create') }}" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="Tambah Produk">
                                <i class="ti ti-plus icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">

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

                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td data-label="Produk">
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-3"
                                                        style="background-image: url({{ $product->image }})">
                                                        {{ $product->initial }}
                                                    </span>
                                                    <div>
                                                        <div>{{ $product->name }}</div>
                                                        <div class="text-muted">{{ $product->description }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td data-label="Harga">
                                                {{ sprintf('Rp. %s', number_format($product->price, 0, ',', '.')) }}
                                            </td>
                                            <td data-label="Tanggal Dibuat">
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td data-label="Action">

                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admins.products.edit', $product->id) }}"
                                                        class="btn btn-ghost-primary">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admins.products.destroy', $product->id) }}"
                                                        method="POST" class="d-inline-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-ghost-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4 d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        @endsection
