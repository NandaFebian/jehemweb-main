<div class="bg-grey mt-10">
    <div class="section-padding">
        <h3>Lihat Produk Lainnya</h3>

        
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1  mb-4 gap-6 mt-8">
          @forelse ($product_list['data'] as $product)
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
    @empty
    <div class="">
    </div>
    @endforelse
           
        </div>
    </div>
    </div>