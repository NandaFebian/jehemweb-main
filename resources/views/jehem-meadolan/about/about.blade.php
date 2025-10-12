@extends('jehem-meadolan.about.master')
@section('meta_data')
<title>Tentang Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali</title>
{{-- robots meta --}}
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://www.jehem-meadolan.com/about">

{{-- meta data --}}
<meta name="description" content="Jehem Meadolan adalah marketplace yang mendukung produk UMKM di Bangli, Bali. Kami bertujuan untuk mempromosikan dan menghubungkan Anda dengan produk-produk lokal berkualitas dari pengusaha di Bangli. Temukan keunikan dan keaslian produk kami di Jehem Meadolan.">
<meta name="keywords" content="tentang Jehem Meadolan, marketplace UMKM Bangli, produk lokal Bangli, UMKM Bali, belanja online Bangli">

{{-- open graph meta --}}
<meta property="og:title" content="tentang Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali">
<meta property="og:description" content="Jehem Meadolan adalah marketplace yang mendukung produk UMKM di Bangli, Bali. Temukan keunikan dan keaslian produk kami. Kunjungi kami sekarang!">
<meta property="og:url" content="https://www.jehem-meadolan.com/about">
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
    @include("jehem-meadolan.about.hero")
  @endsection

  @section('section-one')
    @include("jehem-meadolan.about.section-one")
  @endsection

  @section('maps')
    @include("jehem-meadolan.about.maps")
  @endsection

  @section('say')
    @include("jehem-meadolan.about.say")
  @endsection

  @section('footer')
    @include("jehem-meadolan.components.footer")
  @endsection