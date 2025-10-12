<div class="section-padding">
    <div class="sm:flex sm:justify-between grid justify-normal" id="product">
        <div class="flex items-center gap-6">
            <div class="w-[25px] h-[44px] bg-primary2 rounded-[4px]"></div>
            <p class="sectionP font-semibold text-primary2 font-poppins">
                Produk Kami
            </p>
        </div>
    </div>

    <div class="block">
        <h1 class="sectionHeadText font-mont font-semibold mt-8 mb-4">
            Kunjungi Produk Kami
        </h1>
    </div>

    <!-- scroll -->
    <div class="flex items-center justify-end">
        @if (count($categories) > 10)
            <h5
                class="font-jakarta font-black text-[#7676763c] tracking-[3px] lg:text-[16px] md:text-[14px] text-[12px]">
                SCROLL
            </h5>
            <div class="ms-2 w-10 h-[1px] bg-[#7676763c]"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-chevron-right text-[#7676763c]" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        @endif
    </div>
    <!-- slider button -->
    <section id="thumbnail-carousel" class="mt-4 splide">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <a href="{{ route('home') }}#product"
                        class="filter-btn sm:px-8 sm:min-h-14 sm:h-14 h-10 px-4 text-[12px] sm:text-[14px] md:text-[16px] font-bold
                            {{ !request()->has('category') ? 'bg-primary2 text-white hover:bg-hover-primary' : 'bg-gray-300 hover:bg-secondary2-100 text-white' }}
                            focus:outline-none border-[1px] border-white rounded-[5px] font-poppins btn w-full">All</a>
                </li>

                @foreach ($categories as $category)
                    <li class="splide__slide">
                        @php
                            $encodedCategory = urlencode($category['id']);
                            $currentCategory = request()->input('category');
                            $isActive = $currentCategory == $category['id'] || $currentCategory == $encodedCategory;
                        @endphp
                        <a href="{{ route('home', ['category' => $encodedCategory]) }}#product"
                            class="filter-btn sm:px-8 sm:min-h-14 sm:h-14 h-10 px-4 text-[12px] sm:text-[14px] md:text-[16px] font-bold
                            {{ $isActive ? 'bg-primary2 text-white' : 'bg-gray-300 hover:bg-secondary2-100 text-white' }}
                            focus:outline-none border-[1px] border-white rounded-[5px] font-poppins btn w-full">{{ $category['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- filter --}}
    <div class="relative mt-16">
        <form id="searchForm" action="{{ route('home') }}#product" method="GET"
            class=" relative mt-16 flex items-center">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="bg-primary2 p-[0.5rem] text-white z-10 absolute w-12 h-12 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg> --}}
            {{-- <input type="text" name="query" id="searchInput" value="{{ $query ?? '' }}" placeholder="Cari produk Anda disini" class="input input-bordered w-full max-w-xs rounded-l-none ml-12 focus:outline-none focus:border-gray-400" /> --}}

            <label class="input input-bordered flex items-center gap-2 rounded-r-none w-full sm:w-[50%] md:w-[30%]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                    class="w-4 h-4 opacity-70">
                    <path fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                </svg>
                <input type="text"name="query" id="searchInput" value="{{ $query ?? '' }}" class="sm:text-sm text-xs"
                    placeholder="Cari produk Anda " />
            </label>
            <button type="submit" form="searchForm"
                class=" bg-primary2 text-white px-4 focus:outline-none pb-[0.7rem] pt-[0.8rem] rounded-r-md text-md">Cari
                </button>
        </form>
    </div>


    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 sm:grid-cols-2 gap-12 mt-6">
        @forelse ($products['data'] as $product)
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
            <div class="text-center">
                <p class="font-bold text-lg">Tidak ada produk yang ditemukan.</p>
            </div>
        @endforelse
    </div>


    <div class="grid w-full max-w-screen-sm mx-auto mt-10 overflow-x-auto place-items-center sm:overflow-x-hidden">
        <div class="flex justify-center space-x-4 join">

            <!-- Previous Page Button -->
            @if ($products['prev_page_url'])
                <a href="{{ $products['prev_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-primary2 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">&lt;</a>
            @else
                <button
                    class="px-4 py-2 text-white bg-primary2 rounded-lg cursor-not-allowed join-item btn">&lt;</button>
            @endif

            <!-- Page Number Buttons -->
            @php
                $currentPage = $products['current_page'];
                $lastPage = $products['last_page'];
                $maxPagesToShow = 3;

                $halfTotalMaxPages = floor($maxPagesToShow / 2);
                $startPage = max(1, $currentPage - $halfTotalMaxPages);
                $endPage = min($lastPage, $startPage + $maxPagesToShow - 1);
            @endphp

            @if ($startPage > 1)
                <a href="{{ $products['first_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">1</a>
                @if ($startPage > 2)
                    <span class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn">...</span>
                @endif
            @endif

            @for ($i = $startPage; $i <= $endPage; $i++)
                <a href="{{ $products['path'] }}?page={{ $i }}#product"
                    class="join-item btn px-4 py-2 rounded-lg
                    {{ $currentPage == $i ? 'bg-primary2 hover:bg-hover-primary text-white' : 'bg-gray-300 text-white hover:bg-hover-primary focus:outline-none focus:bg-primary2' }}">{{ $i }}</a>
            @endfor

            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <span class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn">...</span>
                @endif
                <a href="{{ $products['last_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">{{ $lastPage }}</a>
            @endif

            <!-- Next Page Button -->
            @if ($products['next_page_url'])
                <a href="{{ $products['next_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-primary2 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">&gt;</a>
            @else
                <button
                    class="px-4 py-2 text-white bg-primary2 rounded-lg cursor-not-allowed join-item btn">&gt;</button>
            @endif

        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('search-input');
    const products = Array.from(document.querySelectorAll('.card-compact'));

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();

        products.forEach(product => {
            const productName = product.querySelector('.card-title').textContent.toLowerCase();
            const productDescription = product.querySelector('.card-description').textContent
                .toLowerCase();
            const productUser = product.querySelector('.card-user').textContent.toLowerCase();

            if (productName.includes(query) || productDescription.includes(query) || productUser
                .includes(query)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
</script>
