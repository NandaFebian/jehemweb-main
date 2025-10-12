@extends('jehem-meadolan.detail.master')
@section('meta_data')
<title>Detail Produk - Lihat Lebih Jauh Produk Kami | Jehem Meadolan</title>
    {{-- robots meta --}}
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.jehem-meadolan.com/products/product-slug">

    {{-- meta data --}}
    <meta name="description" content="Detail produk di Jehem Meadolan. Temukan informasi lengkap tentang produk termasuk deskripsi, fitur, dan spesifikasi.">
    <meta name="keywords" content="detail produk, produk UMKM, produk lokal, belanja online, Jehem Meadolan">

    {{-- open graph meta --}}
    <meta property="og:title" content="Detail Produk - Lihat Lebih Jauh Produk Kami | Jehem Meadolan">
    <meta property="og:description" content="Detail produk di Jehem Meadolan. Temukan informasi lengkap tentang produk termasuk deskripsi, fitur, dan spesifikasi.">
    <meta property="og:url" content="https://www.jehem-meadolan.com/products/product-slug">
    <meta property="og:image" content="/images/product-image.jpg">
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

@section('product-desc')
@include("jehem-meadolan.detail.product-desc")
@endsection

@section('review')
@include("jehem-meadolan.detail.review")
@endsection

@section('another')
@include("jehem-meadolan.detail.another")
@endsection

@section('footer')
@include("jehem-meadolan.components.footer")
@endsection