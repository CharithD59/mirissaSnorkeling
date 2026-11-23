@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('subtitle', 'Photos for the homepage gallery and the gallery page.')
@section('actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal"><i class="bi bi-cloud-arrow-up"></i> Upload photos</button>
@endsection

@section('content')
@php $show = request('show'); @endphp
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-6 col-lg-3 reveal reveal-1"><div class="panel mini-stat"><span class="kpi-icon tint-primary"><i class="bi bi-images"></i></span><div><div class="v">{{ $images->count() }}</div><div class="l">Photos in view</div></div></div></div>
    <div class="col-6 col-lg-3 reveal reveal-2"><div class="panel mini-stat"><span class="kpi-icon tint-success"><i class="bi bi-house"></i></span><div><div class="v">{{ $homeCount }} <span class="small text-muted fw-normal">/ 6</span></div><div class="l">On the homepage</div></div></div></div>
    <div class="col-6 col-lg-3 reveal reveal-3"><div class="panel mini-stat"><span class="kpi-icon tint-accent"><i class="bi bi-tags"></i></span><div><div class="v">{{ $categories->count() }}</div><div class="l">Categories</div></div></div></div>
    <div class="col-6 col-lg-3 reveal reveal-4"><div class="panel mini-stat"><span class="kpi-icon tint-neutral"><i class="bi bi-eye-slash"></i></span><div><div class="v">{{ $images->where('is_active', false)->count() }}</div><div class="l">Hidden</div></div></div></div>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 reveal reveal-3">
    <div class="segmented">
        <a href="{{ route('admin.gallery.index', request()->except('show')) }}" class="{{ !$show ? 'active' : '' }}">All</a>
        <a href="{{ route('admin.gallery.index', array_merge(request()->query(), ['show' => 'home'])) }}" class="{{ $show === 'home' ? 'active' : '' }}"><i class="bi bi-house"></i> Homepage</a>
        <a href="{{ route('admin.gallery.index', array_merge(request()->query(), ['show' => 'gallery'])) }}" class="{{ $show === 'gallery' ? 'active' : '' }}"><i class="bi bi-grid-3x3-gap"></i> Gallery page</a>
        <a href="{{ route('admin.gallery.index', array_merge(request()->query(), ['show' => 'hidden'])) }}" class="{{ $show === 'hidden' ? 'active' : '' }}"><i class="bi bi-eye-slash"></i> Hidden</a>
    </div>
    <form method="GET">
        @if($show)<input type="hidden" name="show" value="{{ $show }}">@endif
        <select name="category" class="form-select" data-autosubmit aria-label="Category" style="min-width: 200px">
            <option value="">All categories</option>
            @foreach($categories as $c)
                <option value="{{ $c }}" @if(request('category') === $c) selected @endif>{{ $c }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="row g-3">
    @forelse($images as $i => $image)
        <div class="col-6 col-md-4 col-xl-3 reveal reveal-{{ min(6, $i % 8 + 1) }}">
            <div class="panel g-card {{ $image->is_active ? '' : 'is-off' }}">
                <div class="g-media">
                    <img src="{{ site_asset($image->image) }}" alt="{{ $image->alt }}" loading="lazy">
                    <div class="g-flags">
                        @if($image->show_on_home)<span class="glass-badge"><i class="bi bi-house"></i> Home</span>@endif
                        @if($image->show_in_gallery)<span class="glass-badge"><i class="bi bi-grid-3x3-gap"></i> Gallery</span>@endif
                        @if(!$image->is_active)<span class="glass-badge"><i class="bi bi-eye-slash"></i> Hidden</span>@endif
                    </div>
                    <div class="g-hover">
                        <button class="icon-btn" data-bs-toggle="modal" data-bs-target="#edit{{ $image->id }}" aria-label="Edit photo"><i class="bi bi-pencil"></i></button>
                        <a class="icon-btn" href="{{ site_asset($image->image) }}" target="_blank" rel="noopener" aria-label="Open full size"><i class="bi bi-arrows-fullscreen"></i></a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" data-confirm="This photo will be removed from the website." data-confirm-title="Delete photo?">
                            @csrf @method('DELETE')
                            <button class="icon-btn text-danger" type="submit" data-no-loading aria-label="Delete photo"><i class="bi bi-trash3"></i></button>
                        </form>
                    </div>
                </div>
                <div class="g-body d-flex justify-content-between align-items-center gap-2">
                    <div class="min-w-0">
                        <div class="small fw-600 text-truncate" style="color: var(--text)">{{ $image->title ?: 'Untitled' }}</div>
                        <div class="xsmall text-muted text-truncate">{{ $image->category ?: 'No category' }}</div>
                    </div>
                    <span class="xsmall text-faint tabular" title="Display order">#{{ $image->sort_order }}</span>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit{{ $image->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data" class="modal-content" novalidate>
                    @csrf @method('PUT')
                    <div class="modal-header"><h5 class="modal-title">Edit photo</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-md-5">
                                <div class="media-thumb mb-3" id="gp{{ $image->id }}" style="aspect-ratio: 4/3"><img src="{{ site_asset($image->image) }}" alt=""></div>
                                <label class="upload-zone py-3">
                                    <input type="file" name="image_file" accept="image/*" data-preview="#gp{{ $image->id }}">
                                    <strong class="small text-2"><i class="bi bi-arrow-repeat"></i> Replace image</strong>
                                    <span class="files"></span>
                                </label>
                            </div>
                            <div class="col-md-7">
                                <div class="row g-3">
                                    <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ $image->title }}"></div>
                                    <div class="col-md-6"><label class="form-label">Category</label><input type="text" name="category" class="form-control" list="categoryList" value="{{ $image->category }}"></div>
                                    <div class="col-md-8"><label class="form-label">Caption / date</label><input type="text" name="caption" class="form-control" value="{{ $image->caption }}"></div>
                                    <div class="col-md-4"><label class="form-label">Order</label><input type="number" name="sort_order" min="0" class="form-control" value="{{ $image->sort_order }}"></div>
                                    <div class="col-12"><label class="form-label">Alt text <span class="opt">(SEO & accessibility)</span></label><input type="text" name="alt" class="form-control" value="{{ $image->alt }}"></div>
                                    <div class="col-12">
                                        <div class="toggle-row"><div><div class="t">Visible</div><div class="d">Show this photo on the website</div></div><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1" @if($image->is_active) checked @endif aria-label="Visible"></div></div>
                                        <div class="toggle-row"><div><div class="t">Homepage</div><div class="d">Up to 6 photos are shown</div></div><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="show_on_home" value="1" @if($image->show_on_home) checked @endif aria-label="Homepage"></div></div>
                                        <div class="toggle-row"><div><div class="t">Gallery page</div><div class="d">Filterable by category</div></div><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="show_in_gallery" value="1" @if($image->show_in_gallery) checked @endif aria-label="Gallery page"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i> Save photo</button></div>
                </form>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="panel"><div class="empty"><div class="art"><i class="bi bi-images"></i></div><h4>No photos here yet</h4><p>Upload your best underwater moments to show them on the website.</p><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal"><i class="bi bi-cloud-arrow-up"></i> Upload photos</button></div></div></div>
    @endforelse
</div>

<datalist id="categoryList">@foreach($categories as $c)<option value="{{ $c }}">@endforeach</datalist>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="modal-content" novalidate>
            @csrf
            <div class="modal-header"><h5 class="modal-title">Upload photos</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <label class="upload-zone mb-3" style="padding: 2rem 1rem">
                    <input type="file" name="images[]" multiple accept="image/*" required aria-label="Images">
                    <span class="ic"><i class="bi bi-cloud-arrow-up"></i></span>
                    <strong class="text-2">Drop photos here or click to browse</strong>
                    <span class="xsmall">Up to 20 images · 5 MB each</span>
                    <span class="files"></span>
                </label>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label" for="g_title">Title</label><input type="text" id="g_title" name="title" class="form-control" placeholder="Mirissa sri lanka" value="{{ old('title') }}"></div>
                    <div class="col-md-6"><label class="form-label" for="g_category">Category</label><input type="text" id="g_category" name="category" class="form-control" list="categoryList" placeholder="Whales Snorkeling" value="{{ old('category') }}"></div>
                    <div class="col-12"><label class="form-label" for="g_caption">Caption / date</label><input type="text" id="g_caption" name="caption" class="form-control" placeholder="12/09/2024" value="{{ old('caption') }}"></div>
                    <div class="col-12">
                        <div class="toggle-row"><div><div class="t">Show on gallery page</div></div><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="show_in_gallery" value="1" checked aria-label="Show on gallery page"></div></div>
                        <div class="toggle-row"><div><div class="t">Show on homepage</div></div><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="show_on_home" value="1" aria-label="Show on homepage"></div></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Upload</button></div>
        </form>
    </div>
</div>
@endsection

@if($errors->has('images') || $errors->has('images.*'))
    @push('scripts')
        <script>document.addEventListener('DOMContentLoaded', function () { new bootstrap.Modal(document.getElementById('uploadModal')).show(); });</script>
    @endpush
@endif
