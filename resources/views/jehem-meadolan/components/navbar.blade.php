<div class="fixed z-50 bg-white navbar font-poppins shadow-lg" id="navbarTop">
    <div class="w-full px-6 mx-auto sm:px-16 max-w-7xl">
        <div class="flex-1">
            <a href="{{ route('home') }}">
                <img id="navLogo" src="/images/logo-scroll.png" alt="" class="w-auto h-6 md:h-10 " />
            </a>
        </div>
        <div class="flex-none">
            <!-- mobile -->
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="flex-none lg:hidden text-end">
                <label for="my-drawer-3" aria-label="open sidebar"
                    class="justify-center text-black btn btn-square btn-ghost">
                    <svg id="hamburger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>

            <div class="drawer-side">
                <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>

                <ul class="min-h-full p-4 space-y-3 menu w-80 bg-base-100">
                    <div class="flex justify-end">
                        <label for="my-drawer-3" aria-label="close sidebar"
                            class="cursor-pointer drawer-overlay text-end btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8 stroke-current"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </label>
                    </div>
                    <li>
                        <a id="drawer-link" class="font-semibold sectionP text-secondary1"
                            href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li>
                        <a id="drawer-link" class="font-semibold sectionP text-secondary1"
                            href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    {{-- <li>
            <a id="drawer-link" class="font-semibold sectionP text-secondary1" href="/jehem-meadolan/contact">Kontak</a>
          </li> --}}
                    <li>
                        <a href="{{ route('register') }}" id="contactBtn"
                            class="px-8 sectionP font-mont rounded-[5px] font-semibold text-white hover:bg-hover-primary bg-primary2 btn">
                            Daftar
                        </a>
                    </li>
                    <li>
                        <a href="/admin/login" id="contactBtn"
                            class="px-8 sectionP font-mont rounded-[5px] font-semibold bg-transparent hover:bg-primary2 border-primary2 text-primary2 hover:text-white btn">
                            Login
                        </a>
                    </li>
                </ul>
            </div>

            <!-- desktop -->
            <ul class="items-center hidden menu menu-horizontal lg:flex lg:space-x-10">
                <li>
                    <a class="font-semibold text-black sectionP navLink" href="{{ route('home') }}">Beranda</a>
                </li>
                <li>
                    <a class="font-semibold text-black sectionP navLink" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                {{-- <li>
          <a class="font-semibold text-black sectionP navLink" href="/jehem-meadolan/contact">Kontak</a>
        </li> --}}
                <li>
                    <a href="{{ route('register') }}" id="contactBtn"
                        class="px-8 sectionP font-mont rounded-[5px] font-semibold text-white hover:bg-hover-primary bg-primary2 btn">
                        Daftar
                    </a>
                </li>
                <li>
                    <a href="/admin/login" id="contactBtn"
                        class="px-8 sectionP font-mont rounded-[5px] font-semibold bg-transparent hover:bg-primary2 border-primary2 text-primary2 hover:text-white btn">
                        Login
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
