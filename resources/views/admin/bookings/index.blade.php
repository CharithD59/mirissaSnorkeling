@extends('admin.layouts.app')

@section('title', 'Bookings')
@section('subtitle', 'Manage every reservation from the website and your team.')
@section('actions')
    <a href="{{ route('admin.bookings.export', request()->query()) }}" class="btn btn-secondary"><i class="bi bi-download"></i> Export CSV</a>
    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New booking</a>
@endsection

@section('content')
@php
    $currentStatus = request('status');
    $activeFilters = array_filter(request()->only(['q', 'service', 'from', 'to']));
    $filterLabels = ['q' => 'Search', 'service' => 'Service', 'from' => 'From', 'to' => 'To'];
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 reveal reveal-1">
    <div class="segmented" role="tablist" aria-label="Status">
        <a href="{{ route('admin.bookings.index', request()->except(['status', 'page'])) }}" class="{{ !$currentStatus ? 'active' : '' }}">All <span class="count">{{ $counts['all'] }}</span></a>
        @foreach(\App\Models\Booking::STATUSES as $key => $label)
            <a href="{{ route('admin.bookings.index', array_merge(request()->except('page'), ['status' => $key])) }}" class="{{ $currentStatus === $key ? 'active' : '' }}">{{ $label }} <span class="count">{{ $counts[$key] }}</span></a>
        @endforeach
    </div>
</div>

<div class="panel reveal reveal-2">
    <form class="toolbar" method="GET" action="{{ route('admin.bookings.index') }}">
        @if($currentStatus)<input type="hidden" name="status" value="{{ $currentStatus }}">@endif
        <div class="with-icon grow">
            <i class="bi bi-search"></i>
            <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search name, email, phone or BK-00012">
        </div>
        <select name="service" class="form-select" style="width:auto; min-width: 190px" data-autosubmit aria-label="Service">
            <option value="">All tours</option>
            @foreach($services as $service)
                <option value="{{ $service }}" @if(request('service') === $service) selected @endif>{{ $service }}</option>
            @endforeach
        </select>
        <div class="input-group" style="width:auto">
            <span class="input-group-text">From</span>
            <input type="date" name="from" value="{{ request('from') }}" class="form-control" aria-label="Tour date from" style="max-width: 160px">
        </div>
        <div class="input-group" style="width:auto">
            <span class="input-group-text">To</span>
            <input type="date" name="to" value="{{ request('to') }}" class="form-control" aria-label="Tour date to" style="max-width: 160px">
        </div>
        <select name="sort" class="form-select" style="width:auto" data-autosubmit aria-label="Sort">
            <option value="newest" @if($sort === 'newest') selected @endif>Newest first</option>
            <option value="oldest" @if($sort === 'oldest') selected @endif>Oldest first</option>
            <option value="tour_asc" @if($sort === 'tour_asc') selected @endif>Tour date ↑</option>
            <option value="tour_desc" @if($sort === 'tour_desc') selected @endif>Tour date ↓</option>
        </select>
        <button class="btn btn-primary" type="submit"><i class="bi bi-funnel"></i> Filter</button>
    </form>

    @if($activeFilters)
        <div class="filter-chips pt-3">
            @foreach($activeFilters as $key => $value)
                <span class="chip-filter">{{ $filterLabels[$key] }}: {{ \Illuminate\Support\Str::limit($value, 28) }}
                    <a href="{{ route('admin.bookings.index', request()->except([$key, 'page'])) }}" aria-label="Remove filter"><i class="bi bi-x"></i></a>
                </span>
            @endforeach
            <a href="{{ route('admin.bookings.index', $currentStatus ? ['status' => $currentStatus] : []) }}" class="xsmall fw-600 align-self-center ms-1">Clear all</a>
        </div>
    @endif

    <div class="table-wrap">
        <table class="data-table stack">
            <thead>
            <tr>
                <th>Customer</th>
                <th>Booking</th>
                <th>Tour</th>
                <th>Tour date</th>
                <th>Guests</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($bookings as $booking)
                <tr data-href="{{ route('admin.bookings.show', $booking->getKey()) }}">
                    <td class="cell-main">
                        <div class="cell-user">
                            <span class="avatar {{ avatar_class($booking->email) }}">{{ initials($booking->cus_name) }}</span>
                            <div class="who">
                                <div class="n">{{ $booking->cus_name }}</div>
                                <div class="e">{{ $booking->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td data-label="Booking">
                        <span class="ref">{{ $booking->reference }}</span>
                        <div class="xsmall text-muted mt-1">{{ $booking->cre_datetime ? $booking->cre_datetime->format('d M Y') : '—' }}</div>
                    </td>
                    <td data-label="Tour"><span class="strong d-inline-block text-truncate" style="max-width: 210px">{{ $booking->service_name }}</span></td>
                    <td data-label="Tour date" class="text-nowrap">
                        @if($booking->tour_date)
                            <div class="strong tabular">{{ $booking->tour_date->format('d M Y') }}</div>
                            <div class="xsmall {{ $booking->tour_date->isPast() && !$booking->tour_date->isToday() ? 'text-faint' : 'text-primary' }}">{{ $booking->tour_date->isToday() ? 'Today' : $booking->tour_date->diffForHumans() }}</div>
                        @else
                            <span class="text-muted">{{ $booking->datetime ?: '—' }}</span>
                        @endif
                    </td>
                    <td data-label="Guests">
                        <span class="pill" title="{{ $booking->adult_count }} adults, {{ $booking->kid_count }} kids"><i class="bi bi-person"></i>{{ $booking->adult_count }}@if($booking->kid_count)<span class="text-faint">+</span><i class="bi bi-balloon"></i>{{ $booking->kid_count }}@endif</span>
                    </td>
                    <td data-label="Status">{!! status_badge($booking->status) !!}</td>
                    <td class="text-end cell-actions">
                        <div class="dropdown">
                            <button class="icon-btn sm plain" data-bs-toggle="dropdown" aria-label="Actions"><i class="bi bi-three-dots"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.bookings.show', $booking->getKey()) }}"><i class="bi bi-eye"></i>View details</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.bookings.edit', $booking->getKey()) }}"><i class="bi bi-pencil-square"></i>Edit booking</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-header">Change status</li>
                                @foreach(\App\Models\Booking::STATUSES as $key => $label)
                                    @if($key !== ($booking->status ?: 'pending'))
                                        <li>
                                            <form method="POST" action="{{ route('admin.bookings.status', $booking->getKey()) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $key }}">
                                                <button class="dropdown-item" type="submit" data-no-loading>
                                                    <i class="bi {{ ['pending' => 'bi-hourglass', 'confirmed' => 'bi-check2-circle', 'completed' => 'bi-flag', 'cancelled' => 'bi-x-circle'][$key] }}"></i>{{ $label }}
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->getKey()) }}" data-confirm="Booking {{ $booking->reference }} for {{ $booking->cus_name }} will be permanently deleted." data-confirm-title="Delete this booking?">
                                        @csrf @method('DELETE')
                                        <button class="dropdown-item danger" type="submit" data-no-loading><i class="bi bi-trash3"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty">
                            <div class="art"><i class="bi bi-calendar-x"></i></div>
                            <h4>No bookings found</h4>
                            <p>Try a different search or clear the filters to see all reservations.</p>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">Clear filters</a>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @include('admin.partials.pagination', ['items' => $bookings, 'noun' => 'bookings'])
</div>
@endsection
