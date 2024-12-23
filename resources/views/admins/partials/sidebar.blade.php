<aside class="navbar navbar-vertical navbar-expand-lg navbar-transparent">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('img/logo.png') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
                <span class="navbar-brand-title">Dava Kebab</span>
            </a>
        </h1>


        <div class="navbar-nav flex-row d-lg-none">
            {{-- empty --}}
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ request()->routeIs('admins.dashboard.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-home icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                @php
                    $user_routes = [
                        [
                            'name' => 'All Users',
                            'route' => 'admins.users.index',
                        ],
                        [
                            'name' => 'Create User',
                            'route' => 'admins.users.create',
                        ],
                    ];

                    $product_routes = [
                        [
                            'name' => 'All Produk',
                            'route' => 'admins.products.index',
                        ],
                        [
                            'name' => 'Create Produk',
                            'route' => 'admins.products.create',
                        ],
                    ];

                    $outlet_routes = [
                        [
                            'name' => 'All Outlet',
                            'route' => 'admins.outlets.index',
                        ],
                        [
                            'name' => 'Create Outlet',
                            'route' => 'admins.outlets.create',
                        ],
                    ];

                    $invetaris_routes = [
                        [
                            'name' => 'All Invetaris',
                            'route' => 'admins.invetaris.index',
                        ],
                        [
                            'name' => 'Create Catatan',
                            'route' => 'admins.invetaris.create',
                        ],
                    ];

                    $order_routes = [
                        [
                            'name' => 'All Order',
                            'route' => 'admins.orders.index',
                        ],
                    ];

                @endphp
                <li class="nav-item dropdown {{ request()->routeIs('admins.users.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-user-square-rounded icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Users
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('admins.users.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            @foreach ($user_routes as $item)
                                <div class="dropdown-menu-column">
                                    <a href="{{ route($item['route']) }}"
                                        class="dropdown-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown {{ request()->routeIs('admins.products.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-package icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Produk
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('admins.products.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            @foreach ($product_routes as $item)
                                <div class="dropdown-menu-column">
                                    <a href="{{ route($item['route']) }}"
                                        class="dropdown-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown {{ request()->routeIs('admins.outlets.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-building-store icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Outlet
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('admins.outlets.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            @foreach ($outlet_routes as $item)
                                <div class="dropdown-menu-column">
                                    <a href="{{ route($item['route']) }}"
                                        class="dropdown-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-archive icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Catatan Bahan Baku
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            @foreach ($invetaris_routes as $item)
                                <div class="dropdown-menu-column">
                                    <a href="{{ route($item['route']) }}"
                                        class="dropdown-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown {{ request()->routeIs('admins.orders.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-shopping-cart icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Order
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->routeIs('admins.orders.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            @foreach ($order_routes as $item)
                                <div class="dropdown-menu-column">
                                    <a href="{{ route($item['route']) }}"
                                        class="dropdown-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-user icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Other
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item w-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
