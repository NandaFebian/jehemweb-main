<section class="section-padding pt-[8rem]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 ">
        <div class="block">
          <div class="">
            @if (isset($product['attachments']) && count($product['attachments']) > 0)
                @php
                    $firstAttachment = $product['attachments'][0];
                @endphp
                <img src="{{ Storage::url($firstAttachment['path']) }}" class="w-full h-[24rem] object-cover rounded-md" id="main-preview" alt="{{ $firstAttachment['name'] }}">
            @else
                <img src="/images/unknown-product.webp" class="w-full h-[24rem] object-cover rounded-md" id="main-preview" alt="">
            @endif
        </div>
        
         <section
            class="relative splide lg:mt-4 mt-8"
            aria-label="Splide Basic HTML Example"
            id="image-carousel"
              
          >
            <div class="sm:py-6 splide__track">
              <ul class="splide__list">
                @if (isset($product['attachments']) && is_array($product['attachments']) && count($product['attachments']) > 0)
                    @foreach($product['attachments'] as $attachment)
                        <li class="splide__slide">
                            <img src="{{ Storage::url($attachment['path']) }}"
                                alt="{{ $attachment['name'] }}"
                                class="sm:h-[4rem] md:h-[8rem] sm:w-full object-cover rounded-lg sm:max-w-xs"
                                onclick="updatePreview(this)">
                        </li>
                    @endforeach
                @endif
            </ul>
            
            </div>
        </section>
        </div>

        <div class="block">
          @if (isset($product['name'])) 
          <h1>{{ $product['name'] }}</h1>
      @else
          <h1>Nama Produk Tidak Tersedia</h1>
      @endif
                <div class="block my-4">
                    <div class="flex flex-wrap lg:flex-nowrap items-center gap-2">
                        <div class="block">
                            @if (isset($product['user']['profile_image_path']))
                            <img src={{ Storage::url($product['user']['profile_image_path']) }} class="w-[50px] h-[50px] max-w-xs rounded-full object-cover" alt="">
                            @else
                            <img src="/images/profile-meadolan.jpeg" class="w-[50px] h-[50px] max-w-xs rounded-full object-cover" alt="">
                        @endif
                        </div>
                        <div class="block">
                            <h6>{{$product['user']['name']}}</h6>
                            <div class="flex items-center gap-4">
                                @if ($product['avg_rating'] > 0)
                                    <h6 class="underline text-star2-100">{{ number_format($product['avg_rating'], 1) }}</h6>
                                    <div class="flex gap-1 text-star2-100">
                                        @php
                                            $full_stars = floor($product['avg_rating']);
                                            $half_star = $product['avg_rating'] - $full_stars >= 1.5;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $full_stars)
                                                <i class="fa-solid fa-star mask-half-1"></i>
                                            @elseif ($i == $full_stars - 1 && $half_star)
                                                <i class="fa-solid fa-star-half mask-half-1"></i>
                                            @else
                                                <i class="fa-regular fa-star mask-half-1"></i>
                                            @endif
                                        @endfor
                                    </div>
                                @else
                                    <h6 class="underline text-star2-100">0.0</h6>
                                    <div class="flex gap-1 text-star2-100">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-regular fa-star"></i>
                                        @endfor
                                    </div>
                                @endif
                            </div>
                            
                            
                            </div>
                            <div class="block ml-16 lg:ml-6">
                              <a onclick="my_modal_1.showModal()" class="sm:px-12 px-8 hover:bg-primary2 hover:text-white hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-transparent rounded-[5px] font-poppins border-primary2 text-primary2 btn"  >Chat Sekarang</a>
                          </div>
                    </div>
                </div>

                <div role="tablist" class="tabs tabs-bordered mt-10">
                    <input type="radio" name="my_tabs_1" role="tab" class="tab font-black text-primary2 w-[100px]" aria-label="Deskripsi" checked />
                    <div role="tabpanel" class="tab-content py-6">{{$product['description']}}</div>
                  
                    <input type="radio" name="my_tabs_1" role="tab" class="tab font-black text-secondary2-100 w-[100px]" aria-label="Info Penting" />
                    <div role="tabpanel" class="tab-content py-6">{{$product['important_information']}}</div>
                  
                  </div>
        </div>
    </div>
</section>

<script>
  function updatePreview(element) {
      var newImageSrc = element.src;
      document.getElementById('main-preview').src = newImageSrc;
  }
</script>


<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <h6>{{$product['user']['name']}}</h6>

    <div class="block space-y-4">
        <p class="pt-2 text-secondary2-100">Ikuti Media Social Pemilik Toko</p>
        @if(isset($product['contacts']))
            @foreach($product['contacts'] as $socialMedia)
                <a target="_blank" href="{{ $socialMedia['platform'] === 'WA' ? 'https://wa.me/' . preg_replace('/\D/', '', $socialMedia['url']) : $socialMedia['url'] }}" class="flex items-center space-x-4 hover:text-secondary2-100">
                    @if($socialMedia['platform'] == 'Instagram')
                        <i class="bg-secondary2-100 px-2 py-2 rounded-[5px] text-white fa-brands fa-instagram text-[1.3rem]"></i>
                    @elseif($socialMedia['platform'] == 'Tiktok')
                        <i class="bg-secondary2-100 px-2 py-2 rounded-[5px] text-white fa-brands fa-tiktok text-[1.3rem]"></i>
                    @elseif($socialMedia['platform'] == 'Facebook')
                        <i class="bg-secondary2-100 px-2 py-2 rounded-[5px] text-white fa-brands fa-facebook text-[1.3rem]"></i>
                    @elseif($socialMedia['platform'] == 'WA')
                        <i class="bg-secondary2-100 px-2 py-2 rounded-[5px] text-white fa-brands fa-whatsapp text-[1.3rem]"></i>
                    @endif
                    <span class="font-semibold">{{ $socialMedia['platform'] }}</span>
                </a>
            @endforeach
        @endif
    </div>
    

    <div class="modal-action">
      <form method="dialog">

        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>