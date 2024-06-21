<p class="text-zinc-600">
    Mostrando {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
</p>

<nav>
    <ul class="flex gap-2 bg-white">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="px-3 py-1 border border-zinc-300 rounded-md bg-zinc-100">
                &lsaquo;
            </li>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">
                <li class="px-3 py-1 border border-zinc-300 rounded-md">
                    &lsaquo;
                </li>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="px-3 py-1 border border-zinc-300 rounded-md">
                    <span>{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="px-3 py-1 border border-blue-500 text-blue-500 rounded-md" aria-current="page">
                            <span>{{ $page }}</span>
                        </li>
                    @else
                        <a href="{{ $url }}">
                            <li class="px-3 py-1 border border-zinc-300 rounded-md">
                                {{ $page }}
                            </li>
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">
                <li class="px-3 py-1 border border-zinc-300 rounded-md">
                    &rsaquo;
                </li>
            </a>
        @else
            <li class="px-3 py-1 border border-zinc-300 rounded-md bg-zinc-100">
                <span>&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>