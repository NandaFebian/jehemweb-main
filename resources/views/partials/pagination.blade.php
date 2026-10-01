{{-- Compact pagination: prev, first, a window of 3 pages, last, next. Used via $paginator->links('partials.pagination'). --}}
@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(1, $current - 1);
        $end = min($last, $start + 2);
        $start = max(1, $end - 2);
        $base = 'px-4 py-2 text-white rounded-lg join-item btn';
        $idle = "$base bg-gray-300 hover:bg-hover-primary";
        $active = "$base bg-primary2 hover:bg-hover-primary";
    @endphp

    <nav class="grid w-full max-w-screen-sm mx-auto mt-10 overflow-x-auto place-items-center sm:overflow-x-hidden" aria-label="Pagination">
        <div class="flex justify-center space-x-4 join">
            @if ($paginator->onFirstPage())
                <span class="{{ $base }} bg-primary2 btn-disabled" aria-disabled="true">&lt;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="{{ $active }}" rel="prev">&lt;</a>
            @endif

            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}" class="{{ $idle }}">1</a>
                @if ($start > 2)
                    <span class="{{ $base }} bg-gray-300">...</span>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                <a href="{{ $paginator->url($page) }}" class="{{ $page === $current ? $active : $idle }}"
                    @if ($page === $current) aria-current="page" @endif>{{ $page }}</a>
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <span class="{{ $base }} bg-gray-300">...</span>
                @endif
                <a href="{{ $paginator->url($last) }}" class="{{ $idle }}">{{ $last }}</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="{{ $active }}" rel="next">&gt;</a>
            @else
                <span class="{{ $base }} bg-primary2 btn-disabled" aria-disabled="true">&gt;</span>
            @endif
        </div>
    </nav>
@endif
