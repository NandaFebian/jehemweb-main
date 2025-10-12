<section class="relative text-white bg-primary2 font-poppins">
    <!-- SVG Wave -->
    <div class="mb-[-80px] md:mb-[-120px] w-full overflow-hidden leading-none">
        <img src="/images/jehemmeadolan-footer.png" alt="Wave" class="w-full bg-grey">
    </div>
    <div class="relative pt-20 section-padding-x">

        <footer class="grid grid-cols-1 gap-10 xs:grid-cols-3 lg:gap-20 lg:grid-cols-5">
            <aside
                class="grid col-span-1 text-center xs:text-start xs:col-span-3 lg:col-span-2 justify-items-center xs:justify-items-start">
                <a href="{{ route('home') }}">
                    <img id="navLogo" src="/images/logo-meadolan.png" alt="" class="w-auto h-8 mb-2 md:h-10" />
                </a>
                <p class="sectionP text-accent">Selamat datang di Desa Jehem, destinasi wisata yang memukau di Kecamatan
                    Tembuku, Kabupaten Bangli, Bali. Temukan keajaiban alam dan kebudayaan yang menakjubkan di sini!</p>
            </aside>
            <nav class="flex flex-col items-center gap-1 xs:items-start sectionP ">
                <h6 class="mb-2 font-bold font-mont">Jehem Explore</h6>
                <a href="https://jehemexplore.com/about/goa-raja"
                    class="transition-all cursor-pointer hover:text-accent-100 text-accent">Goa Raja</a>
                <a href="https://jehemexplore.com/about/grudugan"
                    class="transition-all cursor-pointer hover:text-accent-100 text-accent">Grudugan</a>
                <a href="https://jehemexplore.com/about/yeh-bulan"
                    class="transition-all cursor-pointer hover:text-accent-100 text-accent">Yeh Bulan
                </a>
            </nav>
            <nav class="flex flex-col items-center gap-1 xs:items-start sectionP ">
                <h6 class="mb-2 font-bold font-mont">Product</h6>
                @php
                    $data = 0;
                @endphp
                @forelse ($products['data'] as $product)
                    @if ($data < 5)
                        <a href="{{ route('detail', ['id' => $product['id']]) }}"
                            class="transition-all cursor-pointer hover:text-accent-100 text-accent">{{ $product['name'] }}</a>
                        @php
                            $data++;
                        @endphp
                    @else
                    @break
                @endif
            @empty
            @endforelse

        </nav>
        {{-- <nav class="flex flex-col items-center gap-1 xs:items-start sectionP ">
        <h6 class="mb-2 font-bold font-mont">Hubungi Kami</h6>
        <div class="flex gap-4">
          <a href="" class="text-3xl transition-all cursor-pointer hover:text-accent-100 text-accent">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
          <a href="" class="text-3xl transition-all cursor-pointer hover:text-accent-100 text-accent">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="" class="text-3xl transition-all cursor-pointer hover:text-accent-100 text-accent">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
        </div>
      </nav> --}}
    </footer>
    <footer class="p-10 mt-10 border-t-2 border-gray-100 footer footer-center">
        <aside>
            <p class="sectionP">Copyright © 2024 - All right reserved by Jehem Meadolan</p>
        </aside>
    </footer>
</div>
</section>
