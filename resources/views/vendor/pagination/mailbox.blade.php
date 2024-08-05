<div class="float-right">
    {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}/{{ $paginator->total() }}
    <div class="btn-group">
        @if ($paginator->onFirstPage())
            <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
    <!-- /.btn-group -->
</div>