<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dava Kebab</title>

    <!-- CSS -->
    <link rel="stylesheet" href={{ asset('css/tabler.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/tabler-icons.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/tabler-vendors.min.css') }}>

    <!-- Nunito Font All options -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    @stack('css')
</head>

<body class=" d-flex flex-column">
    @yield('content')

    @stack('scripts')
    <script src="{{ asset('js/tabler.min.js') }}" defer></script>
</body>

</html>
