@extends('admin.layouts.app')

@section('title', 'Packages')
@section('subtitle', 'Tours shown on your homepage and offered in the booking form.')
@section('actions')
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add package</a>
@endsection

@section('content')
@php
    $availability = request('availability');
    $allCount = $packages->count();
@endphp
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 reveal reveal-1">
    <div class="segmented" aria-label="Availability">
        <a href="{{ route('admin.packages.index', request()->except('availability')) }}" class="{{ !$availability ? 'active' : '' }}"><i class="bi bi-grid"></i> All</a>
        <a href="{{ route('admin.packages.index', array_merge(request()->query(), ['availability' => 'available'])) }}" class="{{ $availability === 'available' ? 'active' : '' }}"><i class="bi bi-check-circle"></i> Available</a>
        <a href="{{ route('admin.packages.index', array_merge(request()->query(), ['availability' => 'unavailable'])) }}" class="{{ $availability === 'unavailable' ? 'active' : '' }}"><i class="bi bi-pause-circle"></i> Unavailable</a>
    </div>
    <form method="GET" class="with-icon" style="min-width: 260px">
        @if($availability)<input type="hidden" name="availability" value="{{ $availability }}">@endif
        <i class="bi bi-search"></i>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search packages…">
    </form>
</div>

<div class="alert-box info mb-4 reveal reveal-2">
    <i class="bi bi-lightbulb"></i>
    <div>Available packages appear in the website booking form. Turn on <strong>Show on homepage</strong> to display a card in the Services section. Capacity and blocked dates are enforced automatically.</div>
</div>

<div class="row g-3 g-xl-4">
    @forelse($packages as $i => $package)
        <div class="col-sm-6 col-xl-4 col-xxl-3 reveal reveal-{{ min(6, $i + 1) }}">
            <div class="panel hoverable pkg-card {{ $package->is_active ? '' : 'is-off' }}">
                <a href="{{ route('admin.packages.edit', $package) }}" class="pkg-media d-block" aria-label="Edit {{ $package->name }}">
                    @if($package->image)
                        <img src="{{ site_asset($package->image) }}" alt="" loading="lazy">
                    @else
                        <span class="ph"><i class="bi bi-water"></i></span>
                    @endif
                    <span class="tl">
                        <span class="glass-badge"><span class="d" style="background: {{ $package->is_active ? '#2fc874' : '#9aa3b5' }}"></span>{{ $package->is_active ? 'Available' : 'Unavailable' }}</span>
                    </span>
                    @if($package->price_tag)<span class="tr pkg-price">{{ $package->price_tag }}</span>@endif
                </a>
                <div class="pkg-body">
                    <div>
                        <h3>{{ $package->name }}</h3>
                        @if($package->duration || $package->pickup_time)
                            <div class="xsmall text-muted mt-1">
                                @if($package->duration)<i class="bi bi-clock"></i> {{ $package->duration }}@endif
                                @if($package->pickup_time)<span class="ms-2"><i class="bi bi-sunrise"></i> {{ $package->pickup_time }}</span>@endif
                            </div>
                        @endif
                    </div>
                    <div class="pkg-meta">
                        <span class="pill"><i class="bi bi-calendar2-check"></i>{{ $bookingCounts[$package->name] ?? 0 }} bookings</span>
                        @if($package->show_on_home)<span class="pill"><i class="bi bi-house"></i>Homepage</span>@endif
                        @if($package->daily_capacity)<span class="pill"><i class="bi bi-people"></i>{{ $package->daily_capacity }}/day</span>@endif
                        @if(count((array) $package->blocked_dates))<span class="pill"><i class="bi bi-calendar-x"></i>{{ count($package->blocked_dates) }} blocked</span>@endif
                    </div>
                    <div class="pkg-actions">
                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-secondary btn-sm flex-grow-1"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.packages.toggle', $package) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-ghost btn-sm btn-icon" type="submit" data-no-loading data-bs-toggle="tooltip" title="{{ $package->is_active ? 'Make unavailable' : 'Make available' }}" aria-label="Toggle availability">
                                <i class="bi {{ $package->is_active ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.packages.destroy', $package) }}" data-confirm="“{{ $package->name }}” will be removed from the website. Existing bookings keep their tour name." data-confirm-title="Delete this package?">
                            @csrf @method('DELETE')
                            <button class="btn btn-ghost btn-sm btn-icon text-danger" type="submit" data-no-loading aria-label="Delete" data-bs-toggle="tooltip" title="Delete"><i class="bi bi-trash3"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="panel"><div class="empty"><div class="art"><i class="bi bi-box-seam"></i></div><h4>No packages found</h4><p>Create your first tour package to show it on the website.</p><a href="{{ route('admin.packages.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add package</a></div></div>
        </div>
    @endforelse

    @if($packages->count())
        <div class="col-sm-6 col-xl-4 col-xxl-3">
            <a href="{{ route('admin.packages.create') }}" class="upload-zone h-100" style="min-height: 280px">
                <span class="ic"><i class="bi bi-plus-lg"></i></span>
                <strong class="text-2">Add a new package</strong>
                <span class="xsmall">Snorkeling, diving, whale watching…</span>
            </a>
        </div>
    @endif
</div>
@endsection
