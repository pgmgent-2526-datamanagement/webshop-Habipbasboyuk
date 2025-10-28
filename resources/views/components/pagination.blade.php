@if ($paginator->hasPages())
    <nav class="">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="arrow-back"><-</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class='arrow-back'><-</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="non-active-page">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="arrow-next">-></a>
        @else
            <span class="arrow-next">-></span>
        @endif
    </nav>
@endif
