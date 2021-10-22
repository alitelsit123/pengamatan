@if ($paginator->hasPages())
<div class="pagination">
    @if (!$paginator->onFirstPage())
        <a class="first" href="{{ url('/pengamatan') }}">First</a>
        <a class="prev" href="{{ $paginator->previousPageUrl() }}">Prev</a>
    @endif
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="disabled active" aria-disabled="true"><span>{{ $element }}</span></a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active" aria-current="page"><span>{{ $page }}</span></a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <a class="next" href="{{ $paginator->nextPageUrl() }}">Next</a>
        <a class="last" href="{{ url('/pengamatan'.'?page='.$paginator->lastPage()) }}">Last</a>
    @endif
</div>
@endif