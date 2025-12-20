@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">

                {{-- ＜ 前へ --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true">
                        <span>&lt;</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
                @endif

                {{-- ページ番号 --}}
                @foreach ($elements as $element)
                    {{-- "..." --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span>{{ $element }}</span>
                        </span>
                    @endif

                    {{-- 数字 --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span>{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- 次へ ＞ --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
                @else
                    <span aria-disabled="true">
                        <span>&gt;</span>
                    </span>
                @endif

            </span>
        </div>
    </nav>
@endif
