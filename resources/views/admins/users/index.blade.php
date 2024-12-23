@extends('admins.layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            User
                        </div>
                        <h2 class="page-title">
                            List User
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admins.users.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-plus icon"></i>
                                Tambah User
                            </a>
                            <a href="{{ route('admins.users.create') }}" class="btn btn-primary d-sm-none btn-icon"
                                aria-label="Tambah User">
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
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-user icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $total }}
                                            </div>
                                            <div class="text-muted">
                                                Total User Terdaftar
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-calendar icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $week }}
                                            </div>
                                            <div class="text-muted">
                                                User Baru Minggu Ini
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-calendar-check icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $month }}
                                            </div>
                                            <div class="text-muted">
                                                User Baru Bulan Ini
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-trash icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $archived }}
                                            </div>
                                            <div class="text-muted">
                                                User di Archive
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Outlet</th>
                                        <th>Registrasi</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td data-label="User">
                                                <div class="d-flex py-1 align-items-center">
                                                    <span class="avatar me-3">{{ $user->initial }}</span>
                                                    <div>
                                                        <div>{{ $user->name }}</div>
                                                        <div class="text-muted">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Role">
                                                <div class="font-weight-medium">{{ $user->role }}</div>
                                            </td>
                                            <td data-label="Outlet">
                                                <div class="font-weight-medium">{{ $user->outlet?->name ?? '-' }}</div>
                                            </td>
                                            <td data-label="Tanggal Registrasi">
                                                <div class="font-weight-medium">
                                                    {{ $user->created_at->diffForHumans() }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admins.users.edit', $user->id) }}"
                                                        class="btn btn-ghost-primary">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admins.users.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-ghost-danger">
                                                            Delete
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

                <div class="col-12 d-flex justify-content-end mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
