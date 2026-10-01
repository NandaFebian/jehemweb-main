@extends('layouts.app')

@section('description', 'Jehem Meadolan adalah marketplace untuk produk UMKM di Bangli, Bali. Temukan berbagai produk lokal terbaik dari UMKM Bangli. Dukung pengusaha lokal dan belanja di Jehem Meadolan hari ini!')

@section('content')
    {{-- hero --}}
    <div class="min-h-screen w-full bg-cover bg-center" style="background-image: url('{{ asset('images/banner-meadolan.png') }}');">
        <div class="relative flex px-6 py-10 mx-auto text-white sm:px-16 sm:py-20 max-w-7xl">
            <div class="lg:mt-[8%] sm:mt-[15%] mt-[35%] text-left max-w-3xl">
                <h1 class="mb-2 heroHeadText font-mont">Jehem Meadolan</h1>
                <p class="mb-6 md:mb-10 sm:mb-8 heroP">Selamat datang di Desa Jehem, destinasi Pusat Kerajinan yang
                    memukau di Kecamatan Tembuku, Kabupaten Bangli, Bali. Temukan keajaiban alam dan kebudayaan yang
                    menakjubkan di sini!</p>
                <a href="{{ route('about') }}"
                    class="sm:px-12 px-8 hover:bg-hover-primary hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn">Selengkapnya</a>
            </div>
        </div>
    </div>

    {{-- trending --}}
    <div class="section-padding">
        <div class="grid sm:flex sm:justify-between justify-normal">
            <div class="flex items-center gap-6">
                <div class="w-[25px] h-[44px] bg-primary2 rounded-[4px]"></div>
                <p class="font-semibold sectionP text-primary2 font-poppins">Sedang banyak dilihat</p>
            </div>
            @if ($trendingProducts->isNotEmpty())
                <x-carousel-buttons id="trending" />
            @endif
        </div>

        <h1 class="mt-8 mb-4 font-semibold sectionHeadText font-mont">Lagi Trending, nih</h1>

        @if ($trendingProducts->isEmpty())
            <p class="text-lg font-bold text-center">Tidak ada produk yang ditemukan.</p>
        @else
            <section class="relative splide" aria-label="Produk trending" data-carousel="cards" data-prev="trending-prev" data-next="trending-next">
                <div class="py-8 splide__track">
                    <ul class="splide__list">
                        @foreach ($trendingProducts as $product)
                            <li class="splide__slide"><x-product-card :product="$product" /></li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
    </div>

    {{-- products --}}
    <div class="section-padding" id="product">
        <div class="flex items-center gap-6">
            <div class="w-[25px] h-[44px] bg-primary2 rounded-[4px]"></div>
            <p class="font-semibold sectionP text-primary2 font-poppins">Produk Kami</p>
        </div>

        <h1 class="mt-8 mb-4 font-semibold sectionHeadText font-mont">Kunjungi Produk Kami</h1>

        @php
            $chip = 'sm:px-8 sm:min-h-14 sm:h-14 h-10 px-4 text-[12px] sm:text-[14px] md:text-[16px] font-bold border-[1px] border-white rounded-[5px] font-poppins btn w-full text-white';
            $chipActive = "$chip bg-primary2 hover:bg-hover-primary";
            $chipIdle = "$chip bg-gray-300 hover:bg-secondary2-100";
        @endphp
        <section class="mt-4 splide" aria-label="Kategori" data-carousel="chips">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <a href="{{ route('home', array_filter(['query' => $search])) }}#product" class="{{ $activeCategory ? $chipIdle : $chipActive }}">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="splide__slide">
                            <a href="{{ route('home', array_filter(['category' => $category->id, 'query' => $search])) }}#product"
                                class="{{ (string) $activeCategory === (string) $category->id ? $chipActive : $chipIdle }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <form action="{{ route('home') }}#product" method="GET" class="relative flex items-center mt-16">
            @if ($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <label class="input input-bordered flex items-center gap-2 rounded-r-none w-full sm:w-[50%] md:w-[30%]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                </svg>
                <input type="text" name="query" value="{{ $search }}" class="text-xs sm:text-sm grow" placeholder="Cari produk Anda" />
            </label>
            <button type="submit" class="bg-primary2 text-white px-4 pb-[0.7rem] pt-[0.8rem] rounded-r-md text-md">Cari</button>
        </form>

        <div class="grid grid-cols-1 gap-12 mt-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <p class="text-lg font-bold text-center col-span-full">Tidak ada produk yang ditemukan.</p>
            @endforelse
        </div>

        {{ $products->links('partials.pagination') }}
    </div>

    <x-testimonials :reviews="$reviews" />
@endsection
