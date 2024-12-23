@extends('outlets.layouts.app')

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
                
                <form method="GET" action="{{ route('products.index', ['search' => request('search')]) }}"
                    class="d-flex justify-content-center gap-2">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Cari Barang Apa?"
                        aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    @if (request('search'))
                        <a href="{{ route('products.index') }}" class="btn btn-outline-danger">Reset</a>
                    @endif
                </form>

                @if ($products->isEmpty())
                    <p class="text-center mt-3">Barang yang dicari tidak ada.</p>
                @endif

                <a href="{{ route('orders.current') }}" class="mb-4 btn btn-dark">Selesai</a>
                
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah Pembelian</th>
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
                                                        {{ $product->image ? '' : $product->initial }}
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
                                            <td data-label="Jumlah Pembelian">
                                                @if (session()->has('order'))
                                                    @if (array_key_exists($product->id, session()->get('order')))
                                                        {{ session()->get('order')[$product->id] }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td data-label="Action">
                                                <div class="btn-list flex-nowrap">
                                                    <form action="{{ route('products.add', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn w-100 btn-icon btn-ghost-primary" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-plus" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 5l0 14" />
                                                                <path d="M5 12l14 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('products.remove', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn w-100 btn-icon btn-ghost-danger" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-minus" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M5 12l14 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
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
        </div>
    </div>
@endsection
