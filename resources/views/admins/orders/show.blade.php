@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Order
                        </div>
                        <h2 class="page-title">
                            Show Orders
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ url()->previous() }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-arrow-left icon"></i>
                                Back
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

                <!-- Page body -->
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="h3">Outlet</p>
                                <address>
                                    {{ $order->outlet->name }} <br />
                                    {{ $order->outlet->address }} <br />
                                    {{ $order->outlet->phone }} <br />
                                    {{ $order->outlet->owner->email }}
                                </address>
                            </div>
                            <div class="col-12 my-5">
                                <h1>Invoice {{ sprintf('#%05d', $order->id) }}</h1>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%">No</th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 5%">Jumlah</th>
                                    <th class="text-end" style="width: 15%">Harga</th>
                                    <th class="text-end" style="width: 15%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="strong mb-1">{{ $item->product->name }}</p>
                                            <div class="text-muted">{{ $item->product->description }}</div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">
                                            {{ sprintf('Rp. %s', number_format($item->product->price, 0, ',', '.')) }}
                                        </td>
                                        <td class="text-end">
                                            {{ sprintf('Rp. %s', number_format($item->product->price * $item->quantity, 0, ',', '.')) }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" class="strong text-end">Subtotal</td>
                                    <td class="text-end">
                                        {{ sprintf('Rp. %s', number_format($order->total, 0, ',', '.')) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="text-muted text-center mt-5">
                            Terima kasih telah berbelanja di {{ config('app.name') }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
