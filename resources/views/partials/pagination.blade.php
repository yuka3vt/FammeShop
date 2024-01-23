@if ($paginator->hasPages())
    <div class="flex-l-m w-full p-t-10 m-lr--7">
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
                @php
                    $start = $paginator->currentPage();
                    $end = $paginator->lastPage();
                    if ($end <= 5) {
                        for ($i = 1; $i <= $end; $i++) { 
                            if ($i==$start) {
                                echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                            }else {
                                echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                            }
                        }
                    }else {
                        if ($start==1) {
                            echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(1) . '">' . 1 . '</a></li>';
                            echo '<li><a class=" flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(2) . '">' . 2 . '</a></li>';
                            echo '<li><a class=" flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(3) . '">' . 3 . '</a></li>';
                            echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                            echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end) . '">' . $end . '</a></li>';
                        }elseif ($start==$end) {
                            echo '<li><a class=" flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(1) . '">' . 1 . '</a></li>';
                            echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                            echo '<li><a class=" flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end-2) . '">' . $end-2 . '</a></li>';
                            echo '<li><a class=" flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end-1) . '">' . $end-1 . '</a></li>';
                            echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end) . '">' . $end . '</a></li>';
                        }else {
                            if ($start-3<=0) {
                                for ($i=1; $i<=3; $i++) { 
                                    if ($start==$i) {
                                        echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                                    }else {
                                        echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                                    }
                                }
                                echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                                echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end) . '">' . $end . '</a></li>';
                            }elseif ($start+2>=$end) {
                                echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(1) . '">' . 1 . '</a></li>';
                                echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                                for ($i=$end-2; $i <=$end ; $i++) { 
                                    if ($start==$i) {
                                        echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                                    }else {
                                        echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($i) . '">' . $i . '</a></li>';
                                    }
                                }
                            }else {
                                echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url(1) . '">' . 1 . '</a></li>';
                                echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                                echo '<li><a class="active-pagination1 flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($start) . '">' . $start . '</a></li>';
                                echo '<li class="disabled flex-c-m how-pagination1 trans-04 m-all-7"><span>...</span></li>';
                                echo '<li><a class="flex-c-m how-pagination1 trans-04 m-all-7" href="' . $paginator->url($end) . '">' . $end . '</a></li>';
                            }
                            
                        }
                    }
                @endphp
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
