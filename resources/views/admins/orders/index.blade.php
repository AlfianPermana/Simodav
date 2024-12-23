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
                            List Orders
                        </h2>
                    </div>

                    <div class="col-auto ms-auto">
                        <select class="form-select w-auto">
                            <option value="all">All</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                    </div>

                    @push('scripts')
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const select = document.querySelector('select');
                                select.addEventListener('change', function() {
                                    window.location.href = '/admins/orders?filter=' + select.value;
                                });
                            });
                        </script>
                    @endpush
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
                                        <th>Order ID</th>
                                        <th>Tanggal</th>
                                        <th>Outlet</th>
                                        <th>Jumlah Item</th>
                                        <th>Total</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td data-label="Produk">
                                                <span>{{ sprintf('#%05d', $order->id) }}</span>
                                            </td>
                                            <td data-label="Tanggal">
                                                <span> {{ $order->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td data-label="Outlet">
                                                <span> {{ $order->outlet->name }}</span>
                                            </td>
                                            <td data-label="Jumlah Item">
                                                <span> {{ $order->items_count }}</span>
                                            </td>
                                            <td data-label="Harga">
                                                <span>
                                                    {{ sprintf('Rp. %s', number_format($order->total, 0, ',', '.')) }}
                                                </span>
                                            </td>
                                            <td data-label="Action">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admins.orders.show', $order->id) }}"
                                                        class="btn btn-ghost-primary">
                                                        Open
                                                    </a>
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
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
