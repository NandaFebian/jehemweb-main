@php
    $links = [
        ['label' => 'Beranda', 'url' => route('home')],
        ['label' => 'Tentang Kami', 'url' => route('about')],
    ];
    $user = auth()->user();
@endphp

<div class="fixed z-50 bg-white shadow-md navbar font-poppins">
    <div class="w-full px-6 mx-auto sm:px-16 max-w-7xl">
        <div class="flex-1">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo-scroll.png') }}" alt="Jehem Meadolan" class="w-auto h-6 md:h-10" />
            </a>
        </div>

        <div class="flex-none">
            {{-- mobile --}}
            <input id="nav-drawer" type="checkbox" class="drawer-toggle" />
            <div class="flex-none lg:hidden text-end">
                <label for="nav-drawer" aria-label="open sidebar" class="justify-center text-black btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>

            <div class="drawer-side">
                <label for="nav-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                <ul class="min-h-full p-4 space-y-3 menu w-80 bg-base-100">
                    <div class="flex justify-end">
                        <label for="nav-drawer" aria-label="close sidebar" class="cursor-pointer btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8 stroke-current" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </label>
                    </div>
                    @foreach ($links as $link)
                        <li><a class="font-semibold sectionP text-secondary1" href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                    @endforeach

                    @if ($user)
                        <div class="divider"></div>
                        @include('components.partials.account-menu', ['user' => $user])
                    @else
                        @include('components.partials.guest-buttons')
                    @endif
                </ul>
            </div>

            {{-- desktop --}}
            <ul class="items-center hidden menu menu-horizontal lg:flex lg:space-x-10">
                @foreach ($links as $link)
                    <li><a class="font-semibold text-black sectionP" href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach

                @if ($user)
                    @include('components.partials.account-menu', ['user' => $user])
                @else
                    @include('components.partials.guest-buttons')
                @endif
            </ul>
        </div>
    </div>
</div>
