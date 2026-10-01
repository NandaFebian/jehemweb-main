@extends('layouts.app')

@section('title', 'Tentang Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali')
@section('description', 'Jehem Meadolan adalah marketplace yang mendukung produk UMKM di Bangli, Bali. Kami bertujuan untuk mempromosikan dan menghubungkan Anda dengan produk-produk lokal berkualitas dari pengusaha di Bangli.')
@section('keywords', 'tentang Jehem Meadolan, marketplace UMKM Bangli, produk lokal Bangli, UMKM Bali, belanja online Bangli')

@section('content')
    {{-- hero --}}
    <div class="min-h-screen w-full bg-cover bg-center" style="background-image: url('{{ asset('images/banner-meadolan-about.png') }}');">
        <div class="relative flex flex-col justify-center px-6 py-10 mx-auto text-white sm:px-16 sm:py-20 max-w-7xl">
            <div class="lg:mt-[8%] sm:mt-[15%] mt-[35%] text-center">
                <h1 class="mb-2 heroHeadText font-mont">Kenali Kami Lebih Jauh</h1>
                <p class="mb-6 md:mb-10 sm:mb-8 heroP">Selamat datang di Desa Jehem, destinasi Pusat Kerajinan yang memukau di
                    Kecamatan Tembuku, Kabupaten Bangli, Bali. Temukan keajaiban alam dan kebudayaan yang menakjubkan di sini!</p>
                <a href="#tentang"
                    class="sm:px-12 px-8 hover:bg-hover-primary hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn">Selengkapnya</a>
            </div>
        </div>
    </div>

    {{-- about --}}
    <section id="tentang">
        <div class="relative flex flex-col gap-6 px-6 py-10 mx-auto overflow-x-hidden md:flex-row sm:px-16 sm:py-20 max-w-7xl">
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('images/about-section-meadolan.png') }}" alt="Desa Jehem" class="w-full mb-5 md:mb-0 md:w-[90%]">
            </div>
            <div class="w-full mt-4 lg:w-1/2 lg:mt-10">
                <h1 class="mb-2 font-mont font-extrabold text-primary2-100 lg:text-[42px] md:text-[36px] sm:text-[30px] text-[24px]">Tentang Kami</h1>
                <p class="mb-5 font-normal sectionP font-poppins text-secondary2-200">Jehem Meadolan merupakan layanan
                    e-commerce wirausaha masyarakat Desa Jehem. Website ini dibuat bertujuan untuk mempromosikan seluruh
                    wirausaha masyarakat Desa Jehem dari berbagai kategori seperti kerajinan, hasil peternakan, hasil
                    pertanian, dan juga jasa. Diharapkan dengan adanya website ini dapat membantu promosi dari produk
                    yang dihasilkan oleh masyarakat Desa Jehem.</p>
                <a href="{{ route('home') }}#product"
                    class="sm:px-12 sm:min-h-14 sm:h-14 h-10 min-h-10 px-8 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 hover:bg-hover-primary text-white border-[1px] border-white rounded-[5px] font-poppins btn">Lihat Produk</a>
            </div>
        </div>
    </section>

    {{-- map --}}
    <section>
        <div class="px-6 pt-10 pb-8 mx-auto text-center sm:px-16 sm:pt-20 sm:pb-16 max-w-7xl">
            <h1 class="md:text-[40px] sm:text-[25px] text-[25px] font-mont font-extrabold">Lokasi Kami</h1>
        </div>
        <iframe title="Lokasi Desa Jehem"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63147.60714930419!2d115.33119365691088!3d-8.428600402230364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd21978cd9b2b8b%3A0x5030bfbca830210!2sJehem%2C%20Kec.%20Tembuku%2C%20Kabupaten%20Bangli%2C%20Bali!5e0!3m2!1sid!2sid!4v1719298716725!5m2!1sid!2sid"
            class="w-full" height="550" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <x-testimonials :reviews="$reviews" />
@endsection
