{{-- Usage: @include('admin.partials.pagination', ['items' => $paginator, 'noun' => 'bookings']) --}}
@if($items->total())
    <div class="panel-foot">
        <span class="small text-muted">
            Showing <strong class="text-2">{{ $items->firstItem() }}–{{ $items->lastItem() }}</strong> of <strong class="text-2">{{ number_format($items->total()) }}</strong> {{ $noun }}
        </span>
        @if($items->hasPages())
            <nav aria-label="Pagination">
                <ul class="pagination">
                    <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $items->previousPageUrl() ?: '#' }}" aria-label="Previous"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    @php
                        $current = $items->currentPage();
                        $last = $items->lastPage();
                        $pages = array_unique(array_filter([1, $current - 1, $current, $current + 1, $last], function ($p) use ($last) { return $p >= 1 && $p <= $last; }));
                        sort($pages);
                        $prev = 0;
                    @endphp
                    @foreach($pages as $page)
                        @if($page - $prev === 2)
                            <li class="page-item"><a class="page-link" href="{{ $items->url($prev + 1) }}">{{ $prev + 1 }}</a></li>
                        @elseif($page - $prev > 2)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                        <li class="page-item {{ $page === $current ? 'active' : '' }}">
                            <a class="page-link" href="{{ $items->url($page) }}">{{ $page }}</a>
                        </li>
                        @php $prev = $page; @endphp
                    @endforeach
                    <li class="page-item {{ $items->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $items->nextPageUrl() ?: '#' }}" aria-label="Next"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
@endif
