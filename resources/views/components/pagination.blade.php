

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="mr-2 px-3 py-2 bg-gray-300 text-gray-600 cursor-not-allowed">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="mr-2 px-3 py-2 bg-blue-500 text-white hover:bg-blue-700 rounded-md">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="mr-2 px-3 py-2 bg-gray-300 text-gray-600">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="mr-2 px-3 py-2 bg-red-700 text-white rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="mr-2 px-3 py-2 bg-gray-300 text-gray-600 hover:bg-blue-500 rounded-md hover:text-white">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-2 bg-blue-500 rounded-md text-white hover:bg-blue-700">Next</a>
        @else
            <span class="px-3 py-2 bg-gray-300 text-gray-600 cursor-not-allowed rounded-md">Next</span>
        @endif
    </nav>
@endif
