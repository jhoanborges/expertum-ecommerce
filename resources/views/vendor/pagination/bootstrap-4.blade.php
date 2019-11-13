@if ($paginator->hasPages())
<div class="shop_page_nav d-flex text-center justify-content-center">
 <ul class="page_nav d-flex flex-row" class="pagination" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())

    <div class="page_prev d-flex flex-column align-items-center justify-content-center"
   rel="prev" aria-label="@lang('pagination.previous')">
        <i class="fas fa-chevron-left"></i>
    </div>
{{--}}
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
            --}}
            @else
            {{--}}
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
            --}}
            <a class="page_prev d-flex flex-column align-items-center justify-content-center"
             href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="fas fa-chevron-left"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())

            <li class="active"><span>{{ $page }}</span></li>

            {{--<li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
            @else
            <li class=""><a href="{{ $url }}">{{ $page }}</a></li>

            {{--<li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            {{--<li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>--}}
            <a class="page_next d-flex flex-column align-items-center justify-content-center" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <i class="fas fa-chevron-right"></i>
            </a>
            @else
            <div class="page_next d-flex flex-column align-items-center justify-content-center"
           rel="next" aria-label="@lang('pagination.next')">
                <i class="fas fa-chevron-right"></i>
            </div>
            {{--<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
            --}}
            @endif
        </ul>
    </div>
    @endif


{{--

            <div class="shop_page_nav d-flex text-center">
                <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                <ul class="page_nav d-flex flex-row">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">21</a></li>
                </ul>

                <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
            </div>
            --}}
