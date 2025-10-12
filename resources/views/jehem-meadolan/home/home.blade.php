@extends('jehem-meadolan.home.master')


@section('meta_data')
    <title>Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali</title>
    {{-- robots meta --}}
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.jehem-meadolan.com/">

    {{-- meta data --}}
    <meta name="description"
        content="Jehem Meadolan adalah marketplace untuk produk UMKM di Bangli, Bali. Temukan berbagai produk lokal terbaik dari UMKM Bangli. Dukung pengusaha lokal dan belanja di Jehem Meadolan hari ini!">
    <meta name="keywords"
        content="marketplace UMKM Bangli, produk UMKM Bangli, belanja produk lokal Bangli, Bangli UMKM, belanja online Bangli">

    {{-- open graph meta --}}
    <meta property="og:title" content="Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali">
    <meta property="og:description"
        content="Temukan dan beli produk UMKM terbaik di Bangli, Bali di Jehem Meadolan. Dukung pengusaha lokal dan nikmati berbagai pilihan produk berkualitas. Kunjungi kami sekarang!">
    <meta property="og:url" content="https://www.jehem-meadolan.com/">
    <meta property="og:image" content="/images/logo-meadolan.png">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Jehem Meadolan">
@endsection

@section('navbar')
@if(auth()->check())
        @include('jehem-meadolan.components.navbar-login')
    @else
        @include('jehem-meadolan.components.navbar')
    @endif
@endsection

@section('hero')
    @include('jehem-meadolan.home.hero')
@endsection

@section('trend')
    @include('jehem-meadolan.home.trend')
@endsection

@section('product')
    @include('jehem-meadolan.home.product', ['products' => $products])
@endsection

@section('say')
    @include('jehem-meadolan.home.say')
@endsection

@section('footer')
    @include('jehem-meadolan.components.footer')
@endsection
