@extends('layouts.app')

@section('title', $product->name.' | Jehem Meadolan')
@section('description', Str::limit($product->description ?: 'Detail produk UMKM di Jehem Meadolan.', 155))
@section('keywords', 'detail produk, produk UMKM, produk lokal, belanja online, Jehem Meadolan')
@section('og_image', $product->cover_url)

@section('content')
    @php
        $contactIcons = ['Instagram' => 'fa-instagram', 'Tiktok' => 'fa-tiktok', 'Facebook' => 'fa-facebook', 'WA' => 'fa-whatsapp'];
        $contactUrl = fn (array $contact) => $contact['platform'] === 'WA'
            ? 'https://wa.me/'.preg_replace('/\D/', '', $contact['url'])
            : $contact['url'];
        $mainMedia = $product->attachments->first();
    @endphp

    {{-- description --}}
    <section class="section-padding pt-[8rem]">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="block">
                <div id="main-preview">
                    @if ($mainMedia?->isVideo())
                        <video src="{{ $mainMedia->url }}" class="w-full h-[24rem] object-cover rounded-md" controls></video>
                    @else
                        <img src="{{ $product->cover_url }}" class="w-full h-[24rem] object-cover rounded-md" alt="{{ $product->name }}">
                    @endif
                </div>

                @if ($product->attachments->count() > 1)
                    <section class="relative mt-8 splide lg:mt-4" aria-label="Galeri produk" data-carousel="gallery">
                        <div class="sm:py-6 splide__track">
                            <ul class="splide__list">
                                @foreach ($product->attachments as $attachment)
                                    <li class="splide__slide">
                                        <button type="button" class="w-full" data-preview-src="{{ $attachment->url }}"
                                            data-preview-type="{{ $attachment->isVideo() ? 'video' : 'image' }}" data-preview-alt="{{ $attachment->name }}">
                                            @if ($attachment->isVideo())
                                                <video src="{{ $attachment->url }}" class="h-[6rem] md:h-[8rem] w-full object-cover rounded-lg" muted></video>
                                            @else
                                                <img src="{{ $attachment->url }}" alt="{{ $attachment->name }}" class="h-[6rem] md:h-[8rem] w-full object-cover rounded-lg">
                                            @endif
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
            </div>

            <div class="block">
                <h1>{{ $product->name }}</h1>
                <div class="flex flex-wrap items-center gap-2 my-4 lg:flex-nowrap">
                    <img src="{{ $product->user->profile_image_url }}" class="w-[50px] h-[50px] rounded-full object-cover" alt="{{ $product->user->name }}">
                    <div class="block">
                        <h6>{{ $product->user->name }}</h6>
                        <div class="flex items-center gap-4 text-star2-100">
                            <h6 class="underline">{{ number_format($product->avg_rating, 1) }}</h6>
                            <x-rating-stars :rating="$product->avg_rating" />
                        </div>
                    </div>
                    <div class="block ml-16 lg:ml-6">
                        <button type="button" onclick="contact_modal.showModal()"
                            class="sm:px-12 px-8 hover:bg-primary2 hover:text-white hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-transparent rounded-[5px] font-poppins border-primary2 text-primary2 btn">Chat Sekarang</button>
                    </div>
                </div>

                <div role="tablist" class="mt-10 tabs tabs-bordered">
                    <input type="radio" name="product_tabs" role="tab" class="tab font-black text-primary2 w-[100px]" aria-label="Deskripsi" checked />
                    <div role="tabpanel" class="py-6 tab-content whitespace-pre-line">{{ $product->description }}</div>

                    <input type="radio" name="product_tabs" role="tab" class="tab font-black text-secondary2-100 w-[100px]" aria-label="Info Penting" />
                    <div role="tabpanel" class="py-6 tab-content whitespace-pre-line">{{ $product->important_information }}</div>
                </div>
            </div>
        </div>
    </section>

    <dialog id="contact_modal" class="modal">
        <div class="modal-box">
            <h6>{{ $product->user->name }}</h6>
            <div class="block space-y-4">
                <p class="pt-2 text-secondary2-100">Ikuti Media Social Pemilik Toko</p>
                @foreach ($product->contacts ?? [] as $contact)
                    <a target="_blank" rel="noopener" href="{{ $contactUrl($contact) }}" class="flex items-center space-x-4 hover:text-secondary2-100">
                        <i class="bg-secondary2-100 px-2 py-2 rounded-[5px] text-white fa-brands {{ $contactIcons[$contact['platform']] ?? 'fa-link' }} text-[1.3rem]"></i>
                        <span class="font-semibold">{{ $contact['platform'] }}</span>
                    </a>
                @endforeach
            </div>
            <div class="modal-action">
                <form method="dialog"><button class="btn">Close</button></form>
            </div>
        </div>
    </dialog>

    {{-- reviews --}}
    <section class="section-padding-x" id="reviews">
        <div class="divider"></div>

        @if (session('status'))
            <div role="alert" class="my-6 alert alert-success">{{ session('status') }}</div>
        @endif

        @unless ($hasCommented)
            <form action="{{ route('products.comments.store', $product->id) }}" method="POST" class="w-full my-14">
                @csrf
                <textarea name="message" placeholder="Tuliskan komentar anda..." maxlength="250" required
                    class="w-full textarea textarea-bordered textarea-lg">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="block mt-4 space-y-4">
                    <div class="w-full rating">
                        @for ($star = 1; $star <= 5; $star++)
                            <input type="radio" name="rating" value="{{ $star }}" aria-label="{{ $star }} bintang"
                                class="mask mask-star bg-star2-100" @checked((int) old('rating', 5) === $star) />
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @php
                        $submit = 'shadow-md sm:px-12 px-8 hover:bg-hover-primary hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn';
                    @endphp
                    @auth
                        <button type="submit" class="{{ $submit }}">Kirim</button>
                    @else
                        <a href="{{ filament()->getLoginUrl() }}" class="{{ $submit }}">Login untuk memberi ulasan</a>
                    @endauth
                </div>
            </form>
        @endunless

        @forelse ($reviews as $review)
            <div class="block mt-6 space-y-6">
                <div class="flex gap-6">
                    <img src="{{ $review->user->profile_image_url }}" class="w-[50px] h-[50px] object-cover rounded-full" alt="" />
                    <div class="block space-y-2">
                        <div class="flex gap-6">
                            <p class="font-semibold sectionP">{{ $review->user->name }}</p>
                            <p class="font-semibold sectionP text-secondary2-200">{{ $review->created_at->format('d-m-Y') }}</p>
                        </div>
                        <x-rating-stars :rating="$review->rating" class="text-star2-100" />
                        <p class="sectionSmallText text-secondary2-200">{{ $review->message }}</p>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
        @empty
            <p class="mt-6 text-lg font-bold text-center">Tidak ada komentar yang ditemukan.</p>
        @endforelse

        {{ $reviews->links('partials.pagination') }}
    </section>

    {{-- related --}}
    @if ($relatedProducts->isNotEmpty())
        <div class="mt-10 bg-grey">
            <div class="section-padding">
                <h3>Lihat Produk Lainnya</h3>
                <div class="grid grid-cols-1 gap-6 mt-8 mb-4 lg:grid-cols-3 sm:grid-cols-2">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
