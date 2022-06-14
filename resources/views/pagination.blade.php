@if ($paginator->hasPages())
<br>
<nav aria-label="Page navigation example">
<ul class="pagination">
       
        @if ($paginator->onFirstPage())
            <!-- <li class="disabled"><span>← Previous</span></li> -->
            <li class="page-item disabled" ><a class="page-link" >← Previous</a></li>
        @else
            <li  class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif

  
    @foreach ($elements as $element)
       
        @if (is_string($element))
            <!-- <li class="disabled"><span>{{ $element }}</span></li> -->

            <li class="disabled"><a class="page-link">{{ $element }}</a></li>
        @endif


       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <!-- <li class="active my-active"><span>{{ $page }}</span></li> -->
                    <li class="active my-active"><a class="page-link">{{ $page }}</a></li>
                @else
                    <li  class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li  class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
    @else
        <!-- <li class="disabled"><span>Next →</span></li> -->
        <li class="page-item disabled"><a class="page-link">Next →</a></li>
    @endif
</ul>
</nav>
@endif 