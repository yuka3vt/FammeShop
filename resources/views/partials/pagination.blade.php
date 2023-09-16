{{-- <!-- Pagination -->
<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
    <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
        1
    </a>

    <a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
        2
    </a>
</div> --}}

@if ($paginator->hasPages())
<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled flex-c-m how-pagination1 trans-04 m-all-7" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled flex-c-m how-pagination1 trans-04 m-all-7" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled flex-c-m how-pagination1 trans-04 m-all-7" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif
