<div class="bg-grey">
<div class="section-padding">
    <div class="sm:flex sm:justify-between grid justify-normal mb-8">
        <div class="flex items-center gap-6">
            <h1 class="sectionHeadText font-mont font-black">Apa kata mereka?</h1>
        </div>  

        <div class="flex justify-end space-x-4">
        <button id="btnPrev-say" class="btn rounded-full w-[56px] h-[56px]" type="button" aria-label="Previous slide" aria-controls="splide01-track">
          <img src="/images/arrow-left.png" class="h-4 object-cover" alt="">
        </button>
        <button id="btnNext-say" class="bg-secondary2-400 btn rounded-full w-[56px] h-[56px]" type="button" aria-label="Next slide" aria-controls="splide01-track">
          <img src="/images/arrow-right.png" class="h-4 object-cover" alt="">
        </button>
      </div>
    </div>

    
    <section
      class="relative splide"
      aria-label="Splide Basic HTML Example"
      id="say-carousel"
        
    >
      <div class="py-8 splide__track">
        <ul class="splide__list">
  @forelse ($reviews['data'] as $review)
  <li class="splide__slide">
    <div class="relative bg-white shadow-md p-7">
      <div class="flex items-center card-head">
        <img
          src="/images/profile-meadolan.jpeg"
          alt=""
          class="mr-4 w-14 h-14 rounded-[50%]"
        />
        <h6 class="font-bold">{{$review['user']['name']}}</h6>
      </div>
      <div class="mt-3 card-content">
        <p class="sectionSmallText text-accent-100">
          {{$review['message']}}
        </p>
        <!-- star -->
        <div class="flex gap-1 mt-4 text-primary2">
          @php
          $fullStars = $review['rating'];
          $emptyStars = 5 - $fullStars;
          @endphp
  
          @for ($i = 0; $i < $fullStars; $i++)
          <i class="fa-solid fa-star"></i>
          @endfor
  
          @for ($i = 0; $i < $emptyStars; $i++)
          <i class="fa-regular fa-star"></i>
          @endfor
        </div>
        <i
          class="fa-solid text-[60px] absolute fa-quote-right right-2 text-primary2"
        ></i>
      </div>
    </div>
  </li>
  
  @empty
  <div class="text-center">
    <p class="font-bold text-lg">Tidak ada komentar yang ditemukan.</p>
</div>
  @endforelse
      
        </ul>
      </div>
    </section>

</div>
</div>