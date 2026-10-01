<div class="dropdown dropdown-end">
    <div tabindex="0" role="button" class="flex items-center cursor-pointer">
        <div class="btn btn-ghost btn-circle avatar">
            <div class="w-10 rounded-full">
                <img alt="{{ $user->name }}" class="object-cover" src="{{ $user->profile_image_url }}" />
            </div>
        </div>
        <div class="block ml-2">
            <p class="font-semibold">{{ $user->name }}</p>
            <p class="text-secondary2-200">{{ $user->phone_number }}</p>
        </div>
    </div>
    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="{{ filament()->getUrl() }}">Toko saya</a></li>
        <li>
            <form action="{{ filament()->getLogoutUrl() }}" method="POST" class="p-0">
                @csrf
                <button type="submit" class="w-full px-3 py-1 text-left">Logout</button>
            </form>
        </li>
    </ul>
</div>
