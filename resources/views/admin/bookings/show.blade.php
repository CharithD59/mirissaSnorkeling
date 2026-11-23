@extends('admin.layouts.app')

@section('title', 'Booking ' . $booking->reference)
@section('crumbs')
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('admin.bookings.index') }}">Bookings</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $booking->reference }}</span>
@endsection

@section('page_head')
<div class="page-head reveal">
    <div class="d-flex align-items-center gap-3 min-w-0">
        <a href="{{ route('admin.bookings.index') }}" class="icon-btn" aria-label="Back to bookings"><i class="bi bi-arrow-left"></i></a>
        <div class="min-w-0">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h1 class="mb-0">{{ $booking->cus_name }}</h1>
                {!! status_badge($booking->status) !!}
            </div>
            <p><span class="ref">{{ $booking->reference }}</span> · Booked {{ $booking->cre_datetime ? $booking->cre_datetime->format('d M Y, H:i') : '' }} via {{ $booking->source === 'admin' ? 'admin panel' : 'website' }}</p>
        </div>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.bookings.edit', $booking->getKey()) }}" class="btn btn-secondary"><i class="bi bi-pencil-square"></i> Edit</a>
        <form method="POST" action="{{ route('admin.bookings.destroy', $booking->getKey()) }}" data-confirm="Booking {{ $booking->reference }} will be permanently deleted." data-confirm-title="Delete this booking?">
            @csrf @method('DELETE')
            <button class="btn btn-danger-soft" type="submit"><i class="bi bi-trash3"></i> Delete</button>
        </form>
    </div>
</div>
@endsection

@section('content')
@php $phone = wa_number($booking->contact_no); @endphp
<div class="row g-3 g-xl-4">
    <div class="col-lg-8">
        <div class="panel mb-4 reveal reveal-1">
            <div class="panel-head">
                <h3 class="panel-title"><span class="ic"><i class="bi bi-water"></i></span>{{ $booking->service_name }}</h3>
                @if($booking->package && $booking->package->price_tag)<span class="pill"><i class="bi bi-tag"></i>{{ $booking->package->price_tag }} per person</span>@endif
            </div>
            <div class="panel-body">
                <div class="kv mb-4">
                    <div class="kv-item">
                        <div class="k"><i class="bi bi-calendar-event"></i>Tour date</div>
                        <div class="v">{{ $booking->tour_date ? $booking->tour_date->format('D, d M Y') : ($booking->datetime ?: '—') }}</div>
                        @if($booking->tour_date)<div class="h">{{ $booking->tour_date->isToday() ? 'Today' : $booking->tour_date->diffForHumans() }}</div>@endif
                    </div>
                    <div class="kv-item">
                        <div class="k"><i class="bi bi-people"></i>Guests</div>
                        <div class="v">{{ $booking->adult_count }} adult{{ $booking->adult_count === 1 ? '' : 's' }} · {{ $booking->kid_count }} kid{{ $booking->kid_count === 1 ? '' : 's' }}</div>
                        <div class="h">{{ $booking->guest_count }} in total</div>
                    </div>
                    <div class="kv-item">
                        <div class="k"><i class="bi bi-cash-stack"></i>Amount</div>
                        <div class="v">{{ $booking->total_amount !== null ? '$' . number_format($booking->total_amount, 2) : 'Not set' }}</div>
                        <div class="h">{{ $booking->total_amount !== null ? 'Recorded by team' : 'Add it via Edit' }}</div>
                    </div>
                </div>

                <h4 class="small fw-700 text-muted text-uppercase mb-2" style="letter-spacing:.06em">Special request</h4>
                <div class="note-box mb-4">{{ $booking->message ?: 'No special request from the customer.' }}</div>

                <h4 class="small fw-700 text-muted text-uppercase mb-2" style="letter-spacing:.06em"><i class="bi bi-lock"></i> Internal notes</h4>
                <div class="note-box warm">{{ $booking->admin_notes ?: 'No internal notes yet — add them from Edit. Customers never see these.' }}</div>
            </div>
        </div>

        <div class="panel reveal reveal-2">
            <div class="panel-head">
                <div>
                    <h3 class="panel-title"><span class="ic"><i class="bi bi-arrow-repeat"></i></span>Update status</h3>
                    <p class="panel-sub">Optionally notify the customer by email</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.bookings.status', $booking->getKey()) }}" class="panel-body">
                @csrf @method('PATCH')
                @php
                    $opts = ['pending' => ['bi-hourglass-split', 'tint-warning'], 'confirmed' => ['bi-check2-circle', 'tint-primary'], 'completed' => ['bi-flag', 'tint-success'], 'cancelled' => ['bi-x-circle', 'tint-danger']];
                    $currentStatus = $booking->status ?: 'pending';
                @endphp
                <div class="row g-2 mb-3" role="radiogroup" aria-label="Status">
                    @foreach(\App\Models\Booking::STATUSES as $key => $label)
                        <div class="col-6 col-md-3">
                            <input type="radio" class="btn-check" name="status" id="st_{{ $key }}" value="{{ $key }}" @if($currentStatus === $key) checked @endif>
                            <label class="status-option" for="st_{{ $key }}">
                                <span class="kpi-icon {{ $opts[$key][1] }}"><i class="bi {{ $opts[$key][0] }}"></i></span>
                                <span class="fw-600">{{ $label }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="toggle-row mb-3">
                    <div>
                        <div class="t">Email the customer</div>
                        <div class="d">Sends a branded status update to {{ $booking->email }}</div>
                    </div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="notify_customer" value="1" @if($booking->email) checked @endif aria-label="Email the customer"></div>
                </div>
                <label class="form-label" for="notify_message">Message to include <span class="opt">(optional)</span></label>
                <textarea name="notify_message" id="notify_message" rows="2" class="form-control mb-3" placeholder="e.g. Our driver will pick you up from your hotel at 6:00 AM."></textarea>
                <div class="d-flex justify-content-end"><button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Save status</button></div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel mb-4 reveal reveal-2">
            <div class="panel-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="avatar lg {{ avatar_class($booking->email) }}">{{ initials($booking->cus_name) }}</span>
                    <div class="min-w-0">
                        <div class="fw-700 text-truncate" style="font-size:1.05rem">{{ $booking->cus_name }}</div>
                        <div class="small text-muted">{{ $otherBookings->count() ? ($otherBookings->count() + 1) . ' bookings with us' : 'First-time guest' }}</div>
                    </div>
                </div>
                <div class="info-list mb-3">
                    <div class="r"><i class="bi bi-envelope"></i><div class="min-w-0"><div class="k">Email</div><div class="v"><a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a></div></div></div>
                    <div class="r"><i class="bi bi-telephone"></i><div class="min-w-0"><div class="k">Phone</div><div class="v">{{ $booking->contact_no ?: '—' }}</div></div></div>
                </div>
                <div class="d-grid gap-2">
                    @if($phone)
                        <a class="btn btn-whatsapp" target="_blank" rel="noopener" href="https://wa.me/{{ $phone }}"><i class="bi bi-whatsapp"></i> Message on WhatsApp</a>
                    @endif
                    <div class="d-flex gap-2">
                        <a class="btn btn-secondary flex-fill" href="mailto:{{ $booking->email }}?subject={{ rawurlencode('Your booking ' . $booking->reference) }}"><i class="bi bi-envelope"></i> Email</a>
                        @if($phone)<a class="btn btn-secondary flex-fill" href="tel:{{ $booking->contact_no }}"><i class="bi bi-telephone"></i> Call</a>@endif
                    </div>
                </div>
            </div>
        </div>

        @if($otherBookings->count())
            <div class="panel reveal reveal-3">
                <div class="panel-head"><h3 class="panel-title">Booking history</h3></div>
                @foreach($otherBookings as $other)
                    <a href="{{ route('admin.bookings.show', $other->getKey()) }}" class="list-row">
                        <span class="min-w-0 flex-grow-1">
                            <span class="t d-block text-truncate">{{ $other->service_name }}</span>
                            <span class="s">{{ $other->reference }} · {{ $other->tour_date ? $other->tour_date->format('d M Y') : $other->datetime }}</span>
                        </span>
                        {!! status_badge($other->status) !!}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
