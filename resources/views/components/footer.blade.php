<section class="relative text-white bg-primary2 font-poppins">
    <div class="mb-[-80px] md:mb-[-120px] w-full overflow-hidden leading-none">
        <img src="{{ asset('images/jehemmeadolan-footer.png') }}" alt="" class="w-full bg-grey">
    </div>
    <div class="relative pt-20 section-padding-x">
        <footer class="grid grid-cols-1 gap-10 xs:grid-cols-3 lg:gap-20 lg:grid-cols-5">
            <aside class="grid col-span-1 text-center xs:text-start xs:col-span-3 lg:col-span-2 justify-items-center xs:justify-items-start">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-meadolan.png') }}" alt="Jehem Meadolan" class="w-auto h-8 mb-2 md:h-10" />
                </a>
                <p class="sectionP text-accent">Selamat datang di Desa Jehem, destinasi wisata yang memukau di Kecamatan
                    Tembuku, Kabupaten Bangli, Bali. Temukan keajaiban alam dan kebudayaan yang menakjubkan di sini!</p>
            </aside>
            <nav class="flex flex-col items-center gap-1 xs:items-start sectionP">
                <h6 class="mb-2 font-bold font-mont">Jehem Explore</h6>
                <a href="https://jehemexplore.com/about/goa-raja" class="transition-all hover:text-accent-100 text-accent">Goa Raja</a>
                <a href="https://jehemexplore.com/about/grudugan" class="transition-all hover:text-accent-100 text-accent">Grudugan</a>
                <a href="https://jehemexplore.com/about/yeh-bulan" class="transition-all hover:text-accent-100 text-accent">Yeh Bulan</a>
            </nav>
            <nav class="flex flex-col items-center gap-1 xs:items-start sectionP">
                <h6 class="mb-2 font-bold font-mont">Product</h6>
                @foreach ($footerProducts as $product)
                    <a href="{{ route('products.show', $product->id) }}" class="transition-all hover:text-accent-100 text-accent">{{ $product->name }}</a>
                @endforeach
            </nav>
        </footer>
        <footer class="p-10 mt-10 border-t-2 border-gray-100 footer footer-center">
            <aside>
                <p class="sectionP">Copyright © {{ now()->year }} - All right reserved by Jehem Meadolan</p>
            </aside>
        </footer>
    </div>
</section>
