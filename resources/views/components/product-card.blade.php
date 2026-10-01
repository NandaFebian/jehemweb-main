@props(['product'])

<div {{ $attributes->merge(['class' => 'relative h-full shadow-xl card card-compact']) }}>
    <figure>
        <img src="{{ $product->cover_url }}" class="h-[12rem] w-full object-cover" alt="{{ $product->name }}" loading="lazy">
    </figure>
    <div class="flex flex-col p-6 grow">
        <h2 class="text-xl font-extrabold card-title">{{ $product->name }}</h2>
        <p class="text-[13px] xs:text-[14px] font-normal mb-6">{{ Str::limit($product->description, 70) }}</p>
        <div class="flex items-center gap-4 mt-auto">
            <img src="{{ $product->user->profile_image_url }}" alt="{{ $product->user->name }}"
                class="h-[3rem] w-[3rem] rounded-full object-cover">
            <div class="block">
                <p class="text-[13px] xs:text-[18px] text-primary2-100 font-bold">{{ $product->user->name }}</p>
                <p class="text-[13px] xs:text-[14px] text-secondary2-100 font-normal">{{ number_format($product->visitor_count) }} Kunjungan</p>
            </div>
        </div>
        <a href="{{ route('products.show', $product->id) }}" class="w-full mt-6 text-white btn bg-primary2 hover:bg-hover-primary">Lihat Produk</a>
    </div>
</div>
