@props(['id'])

<div class="flex justify-end space-x-4">
    <button id="{{ $id }}-prev" class="btn rounded-full w-[56px] h-[56px] bg-gray-400" type="button" aria-label="Previous slide">
        <img src="{{ asset('images/arrow-left.png') }}" class="object-cover h-4" alt="">
    </button>
    <button id="{{ $id }}-next" class="btn rounded-full w-[56px] h-[56px] bg-primary2" type="button" aria-label="Next slide">
        <img src="{{ asset('images/arrow-right.png') }}" class="object-cover h-4" alt="">
    </button>
</div>
