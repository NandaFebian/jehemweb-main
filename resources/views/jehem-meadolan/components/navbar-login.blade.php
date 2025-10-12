<div class="fixed z-50 navbar font-poppins bg-white shadow-md" id="navbarTop">
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
                <label for="my-drawer-3" aria-label="open sidebar" class="justify-center text-black  btn btn-square btn-ghost">
                    <svg id="hamburger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>

            <div class="drawer-side">
                <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>

                <ul class="min-h-full p-4 space-y-3 menu w-80 bg-base-100">
                    <div class="flex justify-end">
                        <label for="my-drawer-3" aria-label="close sidebar" class="cursor-pointer drawer-overlay text-end btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8 stroke-current" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </label>
                    </div>
                    <li>
                        <a id="drawer-link" class="font-semibold sectionP text-secondary1" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li>
                        <a id="drawer-link" class="font-semibold sectionP text-secondary1" href="{{ route('about') }}">Tentang Kami</a>
                    </li>

                    <div class="divider"></div>

                    <div class="dropdown dropdown-end">
                        <div class="flex items-center">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 flex">
                                    @if (Auth::user()->profile_image_path)
                                    <img alt="profile" class="h-[12rem] w-full max-w-xs rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_image_path) }}" />
                                    @else
                                    <img alt="profile" class="h-[12rem] w-full max-w-xs rounded-full object-cover" src="/images/profile-meadolan.jpeg" />
                                    @endif
                                </div>
                            </div>
                            <div class="block ml-2">
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-secondary2-200">{{ Auth::user()->phone_number }}</p>
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <a class="justify-between" href="/admin">
                                    Toko saya
                                </a>
                            </li>
                            <li>
                                <form action="" method="POST">
                                    @csrf
                                    <a>Logout</a>
                                </form>
                            </li>
                        </ul>
                    </div>

                </ul>
            </div>

            <!-- desktop -->
            <ul class="items-center hidden menu menu-horizontal lg:flex lg:space-x-10">
                <li>
                    <a class="font-semibold text-secondary1 sectionP navLink " href="{{ route('home') }}">Beranda</a>
                </li>
                <li>
                    <a class="font-semibold text-secondary1 sectionP navLink " href="{{ route('about') }}">Tentang
                        Kami</a>
                </li>

                <div class="dropdown dropdown-end">
                    <div class="flex items-center">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 flex">
                                @if (Auth::user()->profile_image_path)
                                <img alt="profile" class="h-[12rem] w-full max-w-xs rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_image_path) }}" />
                                @else
                                <img alt="profile" class="h-[12rem] w-full max-w-xs rounded-full object-cover" src="/images/profile-meadolan.jpeg" />
                                @endif
                            </div>
                        </div>
                        <div class="block ml-2">
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-secondary2-200">{{ Auth::user()->phone_number }}</p>
                        </div>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between" href="/admin">
                                Toko saya
                            </a>
                        </li>
                        <li>
                            <button id="logout-button">Logout</button>
                        </li>
                    </ul>
                </div>
            </ul>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function logout() {
        event.preventDefault();
        axios.defaults.withCredentials = true;
        axios.defaults.withXSRFToken = true;
        axios.post('/api/v1/auth/logout')
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                console.error(error);
            });
    }
    document.getElementById('logout-button').addEventListener('click', logout);
</script>