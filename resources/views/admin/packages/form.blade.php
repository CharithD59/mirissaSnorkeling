@extends('admin.layouts.app')

@php $editing = $package->exists; @endphp
@section('title', $editing ? 'Edit package' : 'Add package')
@section('subtitle', $editing ? 'Changes appear on the website immediately after saving.' : 'Create a new tour for the website and booking form.')
@section('crumbs')
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('admin.packages.index') }}">Packages</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $editing ? $package->name : 'New' }}</span>
@endsection

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ $editing ? route('admin.packages.update', $package) : route('admin.packages.store') }}" novalidate>
    @csrf
    @if($editing) @method('PUT') @endif

    <div class="row g-3 g-xl-4">
        <div class="col-lg-8">
            <div class="panel reveal reveal-1">
                <div class="panel-body">
                    <div class="form-section">
                        <div class="form-section-head"><span class="ic"><i class="bi bi-card-text"></i></span><div><h3>Details</h3><p>Name and description shown to customers</p></div></div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Package name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $package->name) }}" required maxlength="150" placeholder="e.g. Blue Whale Snorkeling">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            @if($editing)<div class="form-text">Renaming also updates existing bookings for this package.</div>@endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="short_description">Short description <span class="opt">(optional)</span></label>
                            <input type="text" name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" value="{{ old('short_description', $package->short_description) }}" maxlength="500" placeholder="One line that sells the experience">
                            @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Full description <span class="opt">(optional)</span></label>
                            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $package->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label" for="features">What's included <span class="opt">(one per line)</span></label>
                            <textarea name="features" id="features" rows="6" class="form-control @error('features') is-invalid @enderror" placeholder="Pickup 6 am&#10;Breakfast&#10;Swimming equipment">{{ old('features', implode("\n", (array) $package->features)) }}</textarea>
                            @error('features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Shown as a check-list on the service card.</div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-head"><span class="ic"><i class="bi bi-tag"></i></span><div><h3>Pricing &amp; schedule</h3><p>Leave price empty to hide the price badge</p></div></div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="price">Price per person</label>
                                <div class="input-group"><span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $package->price) }}" placeholder="0.00">
                                </div>
                                @error('price')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="price_label">Custom badge text <span class="opt">(optional)</span></label>
                                <input type="text" name="price_label" id="price_label" class="form-control" value="{{ old('price_label', $package->price_label) }}" placeholder="From $150" maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="sort_order">Display order</label>
                                <input type="number" min="0" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $package->sort_order) }}">
                                <div class="form-text">Lower numbers appear first.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="duration">Duration</label>
                                <div class="with-icon"><i class="bi bi-clock"></i><input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration', $package->duration) }}" placeholder="3 to 5 Hrs" maxlength="100"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="pickup_time">Pickup time</label>
                                <div class="with-icon"><i class="bi bi-sunrise"></i><input type="text" name="pickup_time" id="pickup_time" class="form-control" value="{{ old('pickup_time', $package->pickup_time) }}" placeholder="6:00 AM" maxlength="100"></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="detail_url">“Read More” link <span class="opt">(optional)</span></label>
                                <div class="with-icon"><i class="bi bi-link-45deg"></i><input type="text" name="detail_url" id="detail_url" class="form-control" value="{{ old('detail_url', $package->detail_url) }}" placeholder="view_blue_whale_snorkeling" maxlength="191"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-head"><span class="ic"><i class="bi bi-calendar2-range"></i></span><div><h3>Availability</h3><p>Limit how many guests can book and block specific dates</p></div></div>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label" for="daily_capacity">Max guests per day</label>
                                <div class="with-icon"><i class="bi bi-people"></i>
                                    <input type="number" min="1" name="daily_capacity" id="daily_capacity" class="form-control @error('daily_capacity') is-invalid @enderror" value="{{ old('daily_capacity', $package->daily_capacity) }}" placeholder="Unlimited">
                                </div>
                                @error('daily_capacity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <div class="form-text">Adults + kids from non-cancelled bookings.</div>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label" for="blockedPicker">Unavailable dates</label>
                                <div class="d-flex gap-2">
                                    <input type="date" class="form-control" id="blockedPicker" aria-label="Pick a date to block">
                                    <button type="button" class="btn btn-soft" id="addBlocked"><i class="bi bi-plus-lg"></i> Block</button>
                                </div>
                                <div class="d-flex flex-wrap gap-1 mt-2" id="blockedChips"></div>
                                <input type="hidden" name="blocked_dates" id="blocked_dates" value="{{ old('blocked_dates', implode(', ', (array) $package->blocked_dates)) }}">
                                @error('blocked_dates')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div style="position: sticky; top: calc(var(--topbar-h) + 1rem);">
                <div class="panel mb-3 reveal reveal-2">
                    <div class="panel-head"><h3 class="panel-title">Cover image</h3></div>
                    <div class="panel-body">
                        <div class="media-thumb mb-3" id="pkgPreview">
                            @if($package->image)<img src="{{ site_asset($package->image) }}" alt="">@else<i class="bi bi-image"></i>@endif
                        </div>
                        <label class="upload-zone">
                            <input type="file" name="image_file" accept="image/*" data-preview="#pkgPreview" aria-label="Upload image">
                            <span class="ic"><i class="bi bi-cloud-arrow-up"></i></span>
                            <strong class="small text-2">Click or drop an image</strong>
                            <span class="xsmall">JPG, PNG or WEBP · max 5 MB</span>
                            <span class="files"></span>
                        </label>
                        @error('image_file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        @if($package->image)
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                                <label class="form-check-label small" for="remove_image">Remove current image</label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="panel reveal reveal-3">
                    <div class="panel-head"><h3 class="panel-title">Visibility</h3></div>
                    <div class="panel-body">
                        <div class="toggle-row">
                            <div><div class="t">Available for booking</div><div class="d">Listed in the booking form</div></div>
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1" @if(old('is_active', $package->is_active)) checked @endif aria-label="Available for booking"></div>
                        </div>
                        <div class="toggle-row">
                            <div><div class="t">Show on homepage</div><div class="d">Card in the Services section</div></div>
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="show_on_home" value="1" @if(old('show_on_home', $package->show_on_home)) checked @endif aria-label="Show on homepage"></div>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-check2"></i> {{ $editing ? 'Save changes' : 'Create package' }}</button>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-ghost">Cancel</a>
                        </div>
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
    var hidden = document.getElementById('blocked_dates'), chips = document.getElementById('blockedChips'), picker = document.getElementById('blockedPicker');
    function dates() { return hidden.value.split(/[\s,]+/).filter(Boolean); }
    function render() {
        var list = dates().sort();
        hidden.value = list.join(', ');
        chips.innerHTML = list.length ? '' : '<span class="xsmall text-muted">No blocked dates — bookable every day.</span>';
        list.forEach(function (d) {
            var label = new Date(d + 'T00:00:00');
            var text = isNaN(label) ? d : label.toLocaleDateString(undefined, { day: '2-digit', month: 'short', year: 'numeric' });
            var chip = document.createElement('span');
            chip.className = 'chip-filter';
            chip.innerHTML = '<i class="bi bi-calendar-x"></i> ' + text + ' <a href="#" aria-label="Remove date"><i class="bi bi-x"></i></a>';
            chip.querySelector('a').addEventListener('click', function (e) { e.preventDefault(); hidden.value = dates().filter(function (x) { return x !== d; }).join(', '); render(); });
            chips.appendChild(chip);
        });
    }
    document.getElementById('addBlocked').addEventListener('click', function () {
        if (!picker.value) { picker.focus(); return; }
        var list = dates(); if (list.indexOf(picker.value) === -1) { list.push(picker.value); }
        hidden.value = list.join(', '); picker.value = ''; render();
    });
    render();
})();
</script>
@endpush
