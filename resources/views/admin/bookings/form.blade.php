@extends('admin.layouts.app')

@php $editing = $booking->exists; @endphp
@section('title', $editing ? 'Edit booking' : 'New booking')
@section('subtitle', $editing ? 'Update the reservation details for ' . $booking->reference . '.' : 'Add a walk-in, phone or WhatsApp reservation.')
@section('crumbs')
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('admin.bookings.index') }}">Bookings</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $editing ? $booking->reference : 'New' }}</span>
@endsection

@section('content')
@php
    $serviceNames = $packages->pluck('name')->all();
    $currentService = old('service_name', $booking->service_name);
    $tourDate = old('datetime', $booking->tour_date ? $booking->tour_date->toDateString() : $booking->datetime);
    $prices = $packages->mapWithKeys(function ($p) { return [$p->name => $p->price]; });
@endphp

<form method="POST" action="{{ $editing ? route('admin.bookings.update', $booking->getKey()) : route('admin.bookings.store') }}" novalidate>
    @csrf
    @if($editing) @method('PUT') @endif

    <div class="row g-3 g-xl-4">
        <div class="col-lg-8">
            <div class="panel reveal reveal-1">
                <div class="panel-body">
                    <div class="form-section">
                        <div class="form-section-head">
                            <span class="ic"><i class="bi bi-person"></i></span>
                            <div><h3>Customer</h3><p>Who is this booking for?</p></div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="cus_name">Full name</label>
                                <input type="text" name="cus_name" id="cus_name" class="form-control @error('cus_name') is-invalid @enderror" value="{{ old('cus_name', $booking->cus_name) }}" required maxlength="191" placeholder="e.g. Emma Wilson">
                                @error('cus_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <div class="with-icon"><i class="bi bi-envelope"></i>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $booking->email) }}" required placeholder="name@example.com">
                                </div>
                                @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="contact_no">Phone / WhatsApp</label>
                                <div class="with-icon"><i class="bi bi-telephone"></i>
                                    <input type="tel" name="contact_no" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{ old('contact_no', $booking->contact_no) }}" required placeholder="+94 7X XXX XXXX">
                                </div>
                                @error('contact_no')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-head">
                            <span class="ic"><i class="bi bi-water"></i></span>
                            <div><h3>Tour details</h3><p>Package, date and number of guests</p></div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label" for="service_name">Package</label>
                                <select name="service_name" id="service_name" class="form-select @error('service_name') is-invalid @enderror" required>
                                    <option value="">Select a package…</option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->name }}" @if($currentService === $package->name) selected @endif>
                                            {{ $package->name }}{{ $package->price_tag ? ' — ' . $package->price_tag : '' }}{{ $package->is_active ? '' : ' (unavailable)' }}
                                        </option>
                                    @endforeach
                                    @if($currentService && !in_array($currentService, $serviceNames, true))
                                        <option value="{{ $currentService }}" selected>{{ $currentService }} (not a current package)</option>
                                    @endif
                                </select>
                                @error('service_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="datetime">Tour date</label>
                                <input type="date" name="datetime" id="datetime" class="form-control @error('datetime') is-invalid @enderror" value="{{ $tourDate }}" required>
                                @error('datetime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label" for="adults">Adults</label>
                                <input type="number" min="1" max="100" name="adults" id="adults" class="form-control @error('adults') is-invalid @enderror" value="{{ old('adults', max(1, $booking->adult_count)) }}" required>
                                @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="form-label" for="kids">Kids</label>
                                <input type="number" min="0" max="100" name="kids" id="kids" class="form-control @error('kids') is-invalid @enderror" value="{{ old('kids', $booking->kid_count) }}" required>
                                @error('kids')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label d-flex justify-content-between" for="total_amount"><span>Total amount <span class="opt">(USD)</span></span><a href="#" class="xsmall fw-600" id="calcAmount" hidden>Use package price</a></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" name="total_amount" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" value="{{ old('total_amount', $booking->total_amount) }}" placeholder="0.00">
                                </div>
                                @error('total_amount')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message">Special request <span class="opt">(from customer)</span></label>
                                <textarea name="message" id="message" rows="3" class="form-control" placeholder="Hotel pickup, dietary needs, swimming ability…">{{ old('message', $booking->message) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-head">
                            <span class="ic"><i class="bi bi-lock"></i></span>
                            <div><h3>Internal notes</h3><p>Only visible to your team</p></div>
                        </div>
                        <textarea name="admin_notes" id="admin_notes" rows="3" class="form-control" placeholder="Payment received in cash, boat #2, guide Krishantha…" aria-label="Internal notes">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel mb-3 reveal reveal-2" style="position: sticky; top: calc(var(--topbar-h) + 1rem);">
                <div class="panel-head"><h3 class="panel-title">Status &amp; options</h3></div>
                <div class="panel-body">
                    <label class="form-label" for="status">Booking status</label>
                    <select name="status" id="status" class="form-select mb-3">
                        @foreach(\App\Models\Booking::STATUSES as $key => $label)
                            <option value="{{ $key }}" @if(old('status', $booking->status ?: 'pending') === $key) selected @endif>{{ $label }}</option>
                        @endforeach
                    </select>

                    <div class="toggle-row">
                        <div><div class="t">Email the customer</div><div class="d">Send a status update email</div></div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="notify_customer" value="1" @if(old('notify_customer')) checked @endif aria-label="Email the customer"></div>
                    </div>
                    <div class="toggle-row">
                        <div><div class="t">Ignore availability</div><div class="d">Save even if the date is blocked or full</div></div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="override_availability" value="1" @if(old('override_availability')) checked @endif aria-label="Ignore availability limits"></div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-check2"></i> {{ $editing ? 'Save changes' : 'Create booking' }}</button>
                        <a href="{{ $editing ? route('admin.bookings.show', $booking->getKey()) : route('admin.bookings.index') }}" class="btn btn-ghost">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    var prices = @json($prices);
    var svc = document.getElementById('service_name'), adults = document.getElementById('adults'), kids = document.getElementById('kids');
    var amount = document.getElementById('total_amount'), link = document.getElementById('calcAmount');
    function refresh() {
        var p = prices[svc.value];
        link.hidden = !p;
        if (p) { link.textContent = 'Use package price ($' + (p * ((+adults.value || 0) + (+kids.value || 0))).toFixed(2) + ')'; }
    }
    [svc, adults, kids].forEach(function (el) { el.addEventListener('input', refresh); el.addEventListener('change', refresh); });
    link.addEventListener('click', function (e) {
        e.preventDefault();
        var p = prices[svc.value]; if (!p) { return; }
        amount.value = (p * ((+adults.value || 0) + (+kids.value || 0))).toFixed(2);
        amount.focus();
    });
    refresh();
})();
</script>
@endpush
