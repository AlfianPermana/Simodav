@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Outlets
                        </div>
                        <h2 class="page-title">
                            List Outlets
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admins.outlets.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus icon"></i>
                                Tambah Outlets
                            </a>
                            <a href="{{ route('admins.outlets.create') }}" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="Tambah Outlets">
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
                    <div class="row row-cards">
                        @foreach ($outlets as $outlet)
                            <div class="col-sm-6 col-md-4 col-xl-3">
                                <div class="card card-sm">
                                    <a href="#" class="d-block">
                                        <img src="{{ $outlet->image }}" alt="{{ $outlet->name }}"
                                            class="card-img-top square">
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <span class="avatar me-3 rounded flex-shrink-0">
                                                {{ $outlet->initial }}
                                            </span>
                                            <div>
                                                <div class="text-truncate" style="max-width: 150px;">
                                                    {{ $outlet->name }}
                                                </div>
                                                <div class="text-truncate text-muted" style="max-width: 150px;">
                                                    {{ $outlet->address }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted">{{ $outlet->created_at->diffForHumans() }}</span>
                                            <a href="{{ route('admins.outlets.edit', $outlet->id) }}"
                                                class="btn btn-ghost-primary">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mb-4 d-flex justify-content-end">
                    {{ $outlets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
