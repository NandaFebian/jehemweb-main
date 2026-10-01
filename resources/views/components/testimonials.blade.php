@props(['reviews'])

<div class="bg-grey">
    <div class="section-padding">
        <div class="grid mb-8 sm:flex sm:justify-between justify-normal">
            <h1 class="font-black sectionHeadText font-mont">Apa kata mereka?</h1>
            @if ($reviews->isNotEmpty())
                <x-carousel-buttons id="testimonials" />
            @endif
        </div>

        @if ($reviews->isEmpty())
            <p class="text-lg font-bold text-center">Tidak ada komentar yang ditemukan.</p>
        @else
            <section class="relative splide" aria-label="Ulasan pelanggan" data-carousel="cards"
                data-prev="testimonials-prev" data-next="testimonials-next">
                <div class="py-8 splide__track">
                    <ul class="splide__list">
                        @foreach ($reviews as $review)
                            <li class="splide__slide">
                                <div class="relative h-full bg-white shadow-md p-7">
                                    <div class="flex items-center">
                                        <img src="{{ $review->user->profile_image_url }}" alt="" class="object-cover mr-4 rounded-full w-14 h-14" />
                                        <h6 class="font-bold">{{ $review->user->name }}</h6>
                                    </div>
                                    <div class="mt-3">
                                        <p class="sectionSmallText text-accent-100">{{ $review->message }}</p>
                                        <x-rating-stars :rating="$review->rating" class="mt-4 text-primary2" />
                                        <i class="fa-solid text-[60px] absolute fa-quote-right right-2 bottom-2 text-primary2"></i>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
    </div>
</div>
