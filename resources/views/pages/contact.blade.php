@extends('layouts.app')

@section('title', 'Kontak Jehem Meadolan - Marketplace UMKM Produk di Bangli, Bali')
@section('description', 'Hubungi Jehem Meadolan untuk informasi lebih lanjut tentang marketplace UMKM produk di Bangli, Bali. Temukan cara untuk bermitra dengan kami atau ajukan pertanyaan Anda.')
@section('keywords', 'kontak Jehem Meadolan, marketplace UMKM Bangli, produk lokal Bangli, UMKM Bali, belanja online Bangli')

@section('content')
    @php
        $field = 'input rounded-none w-full max-w-xs bg-transparent text-white border-b-white placeholder-white';
        $socials = [
            ['icon' => 'ig.svg', 'label' => 'instagram'],
            ['icon' => 'fb.svg', 'label' => 'facebook'],
            ['icon' => 'tiktok.svg', 'label' => 'tiktok'],
            ['icon' => 'wa.svg', 'label' => 'whatsapp'],
        ];
    @endphp

    <div class="min-h-screen w-full bg-cover bg-center" style="background-image: url('{{ asset('images/banner-meadolan.png') }}');">
        <div class="relative px-6 py-10 mx-auto text-white sm:px-16 sm:pb-20 max-w-7xl">
            <div class="lg:mt-[8%] sm:mt-[30%] mt-[35%] grid lg:grid-cols-2 grid-cols-1 items-center justify-between">
                {{-- TODO: this form is not wired to a backend yet. --}}
                <div class="block mb-20 lg:mb-0">
                    <h1 class="font-mont">Kontak kami</h1>
                    <p class="sectionP font-poppins w-[80%]">Jika ada masukkan atau saran, jangan ragu untuk menghubungi kami lebih lanjut</p>
                    <div class="block mt-6 space-y-6">
                        <input type="text" placeholder="Name" class="{{ $field }}" />
                        <input type="email" placeholder="Email" class="{{ $field }}" />
                        <textarea class="w-full max-w-xs bg-transparent rounded-none textarea border-b-white placeholder-white" placeholder="Message"></textarea>
                    </div>
                    <button type="button"
                        class="sm:px-12 px-8 mt-6 hover:bg-hover-primary sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn">Kirim</button>
                </div>
                <div class="p-8 rounded-lg bg-secondary1">
                    <div class="block space-y-4">
                        <h3 class="mb-8 font-mont">Social Media</h3>
                        @foreach ($socials as $social)
                            <div class="flex items-center gap-4 transition-all hover:text-secondary2-200">
                                <img src="{{ asset('images/'.$social['icon']) }}" alt="">
                                <p class="font-semibold sectionP font-poppins">{{ $social['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
