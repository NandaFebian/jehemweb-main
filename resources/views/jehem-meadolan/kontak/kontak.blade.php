@extends('jehem-meadolan.kontak.master')
@section('meta_data')
<title>Kontak Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali</title>
{{-- robots meta --}}
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://www.jehem-meadolan.com/contact">

{{-- meta data --}}
<meta name="description" content="Hubungi Jehem Meadolan untuk informasi lebih lanjut tentang marketplace UMKM produk di Bangli, Bali. Temukan cara untuk bermitra dengan kami atau ajukan pertanyaan Anda.">
<meta name="keywords" content="kontak Jehem Meadolan, marketplace UMKM Bangli, produk lokal Bangli, UMKM Bali, belanja online Bangli">

{{-- open graph meta --}}
<meta property="og:title" content="Kontak Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali">
<meta property="og:description" content="Hubungi Jehem Meadolan untuk informasi lebih lanjut tentang marketplace UMKM produk di Bangli, Bali. Temukan cara untuk bermitra dengan kami atau ajukan pertanyaan Anda.">
<meta property="og:url" content="https://www.jehem-meadolan.com/contact">
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
    @include("jehem-meadolan.kontak.hero")
  @endsection