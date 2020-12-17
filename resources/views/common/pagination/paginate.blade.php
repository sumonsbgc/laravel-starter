@if($paginator->hasPages())
    <ul class="kr-pagination">

        @if($paginator->onFirstPage())
            <li class="disabled"><i class="fas fa-long-arrow-alt-left"></i> Previous</li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-long-arrow-alt-left"></i> Previous</a></li>
        @endif

        @foreach ($elements as $element)
            
            @if(is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif

            @if(is_array($element))
                @foreach ($element as $page => $url)
                    @if( $page === $paginator->currentPage() )
                        <li class="active">{{ $page }}</li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif

        @endforeach

        @if($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next <i class="fas fa-long-arrow-alt-right"></i></a></li>
        @else
            <li class="disabled">Next <i class="fas fa-long-arrow-alt-right"></i></li>
        @endif
    </ul>
@endif