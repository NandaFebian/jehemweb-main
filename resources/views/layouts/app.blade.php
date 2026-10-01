<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali')</title>
    <meta name="description" content="@yield('description', 'Jehem Meadolan adalah marketplace untuk produk UMKM di Bangli, Bali. Temukan berbagai produk lokal terbaik dari UMKM Bangli.')">
    <meta name="keywords" content="@yield('keywords', 'marketplace UMKM Bangli, produk UMKM Bangli, produk lokal Bangli, UMKM Bali, Jehem Meadolan')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('title', 'Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali')">
    <meta property="og:description" content="@yield('description', 'Jehem Meadolan adalah marketplace untuk produk UMKM di Bangli, Bali. Temukan berbagai produk lokal terbaik dari UMKM Bangli.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-meadolan.png'))">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Jehem Meadolan">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body_class')">
    @hasSection('bare')
        @yield('content')
    @else
        <x-navbar />
        <main>
            @yield('content')
        </main>
        <x-footer />
    @endif
</body>

</html>
