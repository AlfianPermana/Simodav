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
                            List Catatan
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admins.invetaris.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus icon"></i>
                                Tambah Catatan
                            </a>
                            <a href="{{ route('admins.invetaris.create') }}" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="Tambah Catatan">
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
                                        <th>Tanggal</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Total Pengeluaran</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inve as $invetaris)
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
