<section class="section-padding-x">
    <div class="divider"></div>

    @if ($own_comment === null)
    <div class="flex flex-wrap items-center gap-4 my-14">
            <form id="registrationForm" method="post" class="textarea-lg w-full max-w-xs min-w-full resize-x">
                <textarea id="message" name="message" placeholder="Tuliskan komentar anda..."
                    class="textarea textarea-bordered textarea-lg w-full max-w-xs min-w-full resize-x	"></textarea>
                <div class="block space-y-4">
                    <div class="rating w-full">
                        <input id="star1" type="radio" name="rating" value="1"
                            class="mask mask-star bg-star2-100" checked />
                        <input id="star2" type="radio" name="rating" value="2"
                            class="mask mask-star bg-star2-100" />
                        <input id="star3" type="radio" name="rating" value="3"
                            class="mask mask-star bg-star2-100" />
                        <input id="star4" type="radio" name="rating" value="4"
                            class="mask mask-star bg-star2-100" />
                        <input id="star5" type="radio" name="rating" value="5"
                            class="mask mask-star bg-star2-100" />
                    </div>
                    @guest
                    <a type="submit" href="/admin/login"
                        class="shadow-md sm:px-12 px-8 hover:bg-hover-primary hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn">Kirim</a>
                    
                        @else
                    <button type="submit"
                        class="shadow-md sm:px-12 px-8 hover:bg-hover-primary hover:border-none sm:min-h-14 sm:h-14 h-10 min-h-10 font-normal text-[12px] sm:text-[14px] md:text-[16px] bg-primary2 rounded-[5px] font-poppins border-transparent text-white btn">Kirim</button>

                        @endguest
                </div>
            </form>
            </div>
        @endif

    @forelse ($reviews['data'] as $review)
        <div class="block space-y-6 mt-6">
            <div class="flex gap-6">
                <div class="block">
                    <img src="/images/profile-meadolan.jpeg" class="w-[50px] h-[50px] object-cover max-w-xs"
                        alt="" />
                </div>
                <div class="block space-y-2">
                    <div class="flex gap-6">
                        <p class="sectionP font-semibold"> {{ $review['user']['name'] }}</p>
                        <p class="sectionP font-semibold text-secondary2-200">{{date('d-m-Y', strtotime($review['created_at']));
                        }}</p>
                    </div>
                    <div class="flex gap-1 text-star2-100">
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
                    <div class="sectionSmallText text-secondary2-200">
                        <p>
                            {{ $review['message'] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>
    @empty
    <div class="text-center">
        <p class="font-bold text-lg">Tidak ada komentar yang ditemukan.</p>
    </div>
    @endforelse

    <div class="grid w-full max-w-screen-sm mx-auto mt-10 overflow-x-auto place-items-center sm:overflow-x-hidden">
        <div class="flex justify-center space-x-4 join">

            <!-- Previous Page Button -->
            @if ($reviews['prev_page_url'])
                <a href="{{ $reviews['prev_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-primary2 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">&lt;</a>
            @else
                <button
                    class="px-4 py-2 text-white bg-primary2 rounded-lg cursor-not-allowed join-item btn">&lt;</button>
            @endif

            <!-- Page Number Buttons -->
            @php
                $currentPage = $reviews['current_page'];
                $lastPage = $reviews['last_page'];
                $maxPagesToShow = 3;

                $halfTotalMaxPages = floor($maxPagesToShow / 2);
                $startPage = max(1, $currentPage - $halfTotalMaxPages);
                $endPage = min($lastPage, $startPage + $maxPagesToShow - 1);
            @endphp

            @if ($startPage > 1)
                <a href="{{ $reviews['first_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">1</a>
                @if ($startPage > 2)
                    <span class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn">...</span>
                @endif
            @endif

            @for ($i = $startPage; $i <= $endPage; $i++)
                <a href="{{ $reviews['path'] }}?page={{ $i }}#product"
                    class="join-item btn px-4 py-2 rounded-lg
                {{ $currentPage == $i ? 'bg-primary2 hover:bg-hover-primary text-white' : 'bg-gray-300 text-white hover:bg-hover-primary focus:outline-none focus:bg-primary2' }}">{{ $i }}</a>
            @endfor

            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <span class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn">...</span>
                @endif
                <a href="{{ $reviews['last_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-gray-300 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">{{ $lastPage }}</a>
            @endif

            <!-- Next Page Button -->
            @if ($reviews['next_page_url'])
                <a href="{{ $reviews['next_page_url'] }}#product"
                    class="px-4 py-2 text-white bg-primary2 rounded-lg join-item btn hover:bg-hover-primary focus:outline-none focus:bg-primary2">&gt;</a>
            @else
                <button
                    class="px-4 py-2 text-white bg-primary2 rounded-lg cursor-not-allowed join-item btn">&gt;</button>
            @endif

        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function registerUser(event) {
        event.preventDefault();
        let message = document.getElementById('message').value;
        let rating = document.querySelector('input[name="rating"]:checked').value;
        axios.defaults.withCredentials = true;
        axios.defaults.withXSRFToken = true;
        axios.post('/api/v1/comments', {
                message: message,
                rating: rating,
                product_id: {{ $product['id'] }}
            })
            .then(function(response) {
               window.location.reload();
            })
            .catch(function(error) {
                console.error(error);
            });
    }

    document.getElementById('registrationForm').addEventListener('submit', registerUser);
</script>
