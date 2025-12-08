@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center mt-6">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-500 cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 rounded-md bg-white border border-gray-200 text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-[#00b894] transition">
                &laquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 rounded-md text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="px-3 py-1 rounded-md bg-[#00b894] text-white font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-1 rounded-md bg-white border border-gray-200 text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-[#00b894] transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 rounded-md bg-white border border-gray-200 text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-[#00b894] transition">
                &raquo;
            </a>
        @else
            <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-500 cursor-not-allowed">&raquo;</span>
        @endif
    </nav>
@endif
