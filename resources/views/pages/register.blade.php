@extends('layouts.app')

@section('title', 'Daftar - Jehem Meadolan')
@section('description', 'Daftarkan usaha Anda di Jehem Meadolan, marketplace produk UMKM di Bangli, Bali.')
@section('robots', 'noindex, nofollow')
@section('body_class', 'sm:bg-gray-50 min-h-screen')
@section('bare', true)

@section('content')
    @php
        $field = 'w-full py-2 pl-2 rounded-md focus:outline-none';
        $inputs = [
            ['name' => 'name', 'type' => 'text', 'placeholder' => 'Masukkan Nama Usaha Anda', 'icon' => 'fa-store', 'autocomplete' => 'organization'],
            ['name' => 'phone_number', 'type' => 'tel', 'placeholder' => 'Masukkan Nomor Telepon Anda', 'icon' => 'fa-phone', 'autocomplete' => 'tel'],
            ['name' => 'password', 'type' => 'password', 'placeholder' => 'Masukkan Password Anda', 'icon' => 'fa-key', 'autocomplete' => 'new-password'],
            ['name' => 'password_confirmation', 'type' => 'password', 'placeholder' => 'Konfirmasi Password', 'icon' => 'fa-key', 'autocomplete' => 'new-password'],
        ];
    @endphp

    <section class="sm:py-16">
        <div class="container max-w-xl mx-auto">
            <div class="p-10 rounded-lg sm:bg-white sm:shadow-md">
                <a href="{{ route('home') }}" aria-label="Kembali ke beranda"><i class="text-xl fa-solid fa-arrow-left sectionP"></i></a>

                <h3 class="mt-10 text-2xl capitalize md:text-3xl">Selamat Datang di Jehem</h3>
                <p class="mt-2 capitalize sectionP text-secondary2-100 md:text-lg">Yuk registrasi akunmu dulu!</p>

                <form action="{{ route('register.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @foreach ($inputs as $input)
                        <div>
                            <label class="flex items-center gap-2 input input-bordered @error($input['name']) input-error @enderror">
                                <i class="w-4 opacity-70 fa-solid {{ $input['icon'] }}"></i>
                                <input name="{{ $input['name'] }}" type="{{ $input['type'] }}" class="{{ $field }}"
                                    placeholder="{{ $input['placeholder'] }}" autocomplete="{{ $input['autocomplete'] }}" required
                                    @unless ($input['type'] === 'password') value="{{ old($input['name']) }}" @endunless />
                            </label>
                            @error($input['name'])
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <button type="submit" class="w-full py-2 text-center text-white rounded-md bg-primary2 hover:bg-hover-primary">Registrasi</button>
                </form>

                <p class="mt-8 text-center sectionP">
                    Sudah Memiliki Akun?
                    <a href="{{ filament()->getLoginUrl() }}" class="underline sectionP text-neutral-500">Login Sekarang</a>
                </p>
            </div>
        </div>
    </section>

    @if (session('registered'))
        <dialog class="modal" data-open-on-load>
            <div class="text-center modal-box">
                <i class="text-5xl text-green-500 fa-solid fa-circle-check"></i>
                <h3 class="mt-4 text-lg font-bold">Registrasi Anda telah berhasil.</h3>
                <p class="py-4">Tunggu sebentar, admin akan memverifikasi permintaan Anda.</p>
                <div class="justify-center modal-action">
                    <a href="{{ filament()->getLoginUrl() }}" class="text-white btn bg-primary2 hover:bg-hover-primary">OK</a>
                </div>
            </div>
        </dialog>
    @endif
@endsection
