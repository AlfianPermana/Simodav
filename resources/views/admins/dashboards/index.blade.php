@extends('admins.layouts.app')

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
                            Admin
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="col-12 mb-4">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Penjualan</div>
                                    </div>
                                    <div class="h1 mb-3">
                                        {{ sprintf('Rp. %s', number_format($total['sales'], 0, ',', '.')) }}
                                    </div>
                                </div>
                                <div id="chart-sales" class="chart-sm"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Penjualan Hari Ini</div>
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
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Product</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $total['products'] }}
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-products" class="chart-sm"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Outlet</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $total['outlets'] }}
                                        </div>
                                    </div>
                                    <div id="chart-outlets" class="chart-sm"></div>
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
                    new ApexCharts(document.getElementById('chart-products'), {
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
                            name: 'Produk Baru',
                            data: Object.values(@json($products2)),
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
                        labels: Object.keys(@json($products2)),
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
                    new ApexCharts(document.getElementById('chart-outlets'), {
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
                            name: 'Outlet Baru',
                            data: Object.values(@json($outlets)),
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
                        labels: Object.keys(@json($outlets)),
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
                    new ApexCharts(document.getElementById('chart-new-clients'), {
                        chart: {
                            type: 'line',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        stroke: {
                            width: [2, 1],
                            dashArray: [0, 3],
                            lineCap: 'round',
                            curve: 'smooth',
                        },
                        series: [{
                                name: 'May',
                                data: [
                                    37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53,
                                    61, 27, 54,
                                    43, 4, 46, 39, 62, 51, 35, 41, 67,
                                ],
                            },
                            {
                                name: 'April',
                                data: [
                                    93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41,
                                    27, 35, 51,
                                    46, 62, 37, 44, 53, 41, 65, 39, 37,
                                ],
                            },
                        ],
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
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: [
                            '2020-06-20',
                            '2020-06-21',
                            '2020-06-22',
                            '2020-06-23',
                            '2020-06-24',
                            '2020-06-25',
                            '2020-06-26',
                            '2020-06-27',
                            '2020-06-28',
                            '2020-06-29',
                            '2020-06-30',
                            '2020-07-01',
                            '2020-07-02',
                            '2020-07-03',
                            '2020-07-04',
                            '2020-07-05',
                            '2020-07-06',
                            '2020-07-07',
                            '2020-07-08',
                            '2020-07-09',
                            '2020-07-10',
                            '2020-07-11',
                            '2020-07-12',
                            '2020-07-13',
                            '2020-07-14',
                            '2020-07-15',
                            '2020-07-16',
                            '2020-07-17',
                            '2020-07-18',
                            '2020-07-19',
                        ],
                        colors: [tabler.getColor('primary'), tabler.getColor('gray-600')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
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
