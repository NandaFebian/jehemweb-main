<div class="section-padding">
    <div class="sm:flex sm:justify-between grid justify-normal">
        <div class="flex items-center gap-6">
            <div class="w-[25px] h-[44px] bg-primary2 rounded-[4px]"></div>
            <p class="sectionP font-semibold text-primary2 font-poppins">Sedang banyak dilihat</p>
        </div>

        <div class="flex justify-end space-x-4">
            <button id="btnPrev" class="btn rounded-full w-[56px] h-[56px]" type="button" aria-label="Previous slide"
                aria-controls="splide01-track">
                <img src="/images/arrow-left.png" class="h-4 object-cover" alt="">
            </button>
            <button id="btnNext" class="bg-secondary2-400 btn rounded-full w-[56px] h-[56px]" type="button"
                aria-label="Next slide" aria-controls="splide01-track">
                <img src="/images/arrow-right.png" class="h-4 object-cover" alt="">
            </button>
        </div>
    </div>

    <div class="block">
        <h1 class="sectionHeadText font-mont font-semibold mt-8 mb-4">Lagi Trending, nih</h1>
    </div>

    <section class="relative splide" aria-label="Splide Basic HTML Example" id="image-carousel">
        <div class="py-8 splide__track">
            <ul class="splide__list">
                @forelse ($slide_products['data'] as $product)
                    <li class="splide__slide">
                        <div class="relative h-full shadow-xl card card-compact">
                            <figure>
                                @if ($product['attachments'])
                                    @php
                                        $firstAttachment = $product['attachments'][0];
                                    @endphp
                                    <img src="{{ Storage::url($firstAttachment['path']) }}" class="h-[12rem] w-full object-cover"
                                        alt="{{ $firstAttachment['name'] }}">
                                @else
                                    <img src="/images/unknown-product.webp" class="h-[12rem] w-full object-cover" alt="">
                                @endif
                            </figure>
                            <div class="p-6">
                                <h2 class="text-xl font-extrabold text-primary1-100 card-title">{{ $product['name'] }}</h2>
                                <p class="text-[13px] xs:text-[14px] text-primary1-100 font-normal mb-6">
                                    {{ Str::limit($product['description'], 70) }}</p>
                                <div class="grid items-center justify-between">
                                    <div class="flex gap-4 items-center">
                                        @if ($product['user']['profile_image_path'])
                                            <img src="{{ Storage::url($product['user']['profile_image_path']) }}"
                                                class="h-[3rem] w-[3rem] m-auto max-w-xs rounded-full object-cover"
                                                alt="{{ $product['user']['name'] }}">
                                        @else
                                            <img src="/images/profile-meadolan.jpeg" alt=""
                                                class="h-[3rem] w-[3rem] m-auto max-w-xs rounded-full">
                                        @endif
                                        <div class="block">
                                            <p class="text-[13px] xs:text-[18px] text-primary2-100 font-bold">
                                                {{ $product['user']['name'] }}</p>
                                            <p class="text-[13px] xs:text-[14px] text-secondary2-100 font-normal">
                                                {{ $product['visitor_count'] }} Kunjungan</p>
                                        </div>
                                    </div>
            
                                </div>
            
                                <div class="flex justify-end mt-6 w-full">
                                    <a href="{{ route('detail', ['id' => $product['id']]) }}"
                                        class="btn bg-primary2 text-white w-full hover:bg-hover-primary">Lihat Produk</a>
                                </div>
            
                            </div>
                        </div>
                    </li>
                @empty
                <div class="text-center">
                    <p class="font-bold text-lg">Tidak ada produk yang ditemukan.</p>
                </div>
                @endforelse

            </ul>
        </div>
    </section>
</div>
