@props(['rating' => 0])

@php
    $rating = max(0, min(5, (float) $rating));
    $full = (int) floor($rating);
    $half = ($rating - $full) >= 0.5;
@endphp

<div {{ $attributes->merge(['class' => 'flex gap-1']) }} aria-label="{{ number_format($rating, 1) }} dari 5 bintang">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $full)
            <i class="fa-solid fa-star"></i>
        @elseif ($i === $full + 1 && $half)
            <i class="fa-solid fa-star-half-stroke"></i>
        @else
            <i class="fa-regular fa-star"></i>
        @endif
    @endfor
</div>
