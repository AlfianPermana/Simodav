@extends('outlets.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Dashboard
                        </div>
                        <h2 class="page-title">
                            Karyawan Outlet
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="col-12 mb-4">
                    <div class="row row-cards">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Penjualan Hari Ini</div>
                                    </div>
                                    <div class="h1 mb-3">
                                        {{ sprintf('Rp. %s', number_format($penjualanhari, 0, ',', '.')) }}
                                    </div>
                                </div>
                                <div id="chart-sales" class="chart-sm"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Penjualan</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $total['orders'] }}
                                        </div>
                                    </div>
                                    <div id="chart-sales-count" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card" style="height: 28rem">
                                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                            <div class="divide-y">
                                                @foreach ($products as $product)
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar">{{ $product->initial }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <strong>{{ $product->name }}</strong>
                                                                <div class="text-muted">{{ $product->description }}</div>
                                                            </div>
                                                            <div class="text-muted">
                                                                Dibeli Sebanyak {{ $product->items_count }} kali
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary">
                                                                {{ sprintf('Rp. %s', number_format($product->price, 0, ',', '.')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card" style="height: 28rem">
                                        <div class="card-header border-0">
                                            <div class="card-title">Total Orders</div>
                                        </div>
                                        <div class="p-5">
                                            <div id="chart-orders"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('chart-sales'), {
                        chart: {
                            type: 'area',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 0.16,
                            type: 'solid',
                        },
                        stroke: {
                            width: 2,
                            lineCap: 'round',
                            curve: 'smooth',
                        },
                        series: [{
                            name: 'Sales',
                            data: Object.values(@json($orders)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($orders)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('chart-sales-count'), {
                        chart: {
                            type: 'bar',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: 'Jumlah Order',
                            data: Object.values(@json($orders2)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($orders2)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
            // @formatter:on
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('chart-orders'), {
                        chart: {
                            type: "line",
                            fontFamily: 'inherit',
                            height: 320,
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: "Total Penjualan",
                            data: Object.values(@json($orders)),
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            padding: {
                                top: -20,
                                right: 0,
                                left: -4,
                                bottom: -4
                            },
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        labels: Object.keys(@json($orders)),
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>
    @endpush
@endsection
