@extends('admin.layouts.app')

@section('title', 'Website Content')
@section('subtitle', 'Edit the text, images and sections of your public website — no code needed.')
@section('actions')
    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="bi bi-box-arrow-up-right"></i> Preview site</a>
@endsection

@section('content')
@php $customCount = count(array_intersect_key($values, $group['fields'])); @endphp
<div class="row g-3 g-xl-4">
    <div class="col-lg-3">
        <div class="cms-mobile-nav">
            <label class="form-label" for="cmsJump">Section</label>
            <select id="cmsJump" class="form-select" onchange="window.location.href=this.value">
                @foreach($groups as $key => $g)
                    <option value="{{ route('admin.content.index', ['group' => $key]) }}" @if($key === $active) selected @endif>{{ $g['title'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="panel cms-nav-panel reveal reveal-1" style="position: sticky; top: calc(var(--topbar-h) + 1rem);">
            <nav class="cms-nav" aria-label="Content sections">
                @foreach($groups as $key => $g)
                    <a class="{{ $key === $active ? 'active' : '' }}" href="{{ route('admin.content.index', ['group' => $key]) }}">
                        <i class="bi {{ $g['icon'] }}"></i><span class="text-truncate">{{ $g['title'] }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="px-3 pb-3">
                <div class="alert-box info xsmall p-3"><i class="bi bi-lightning-charge"></i><div>Changes go live as soon as you save.</div></div>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        <form method="POST" action="{{ route('admin.content.update', $active) }}" enctype="multipart/form-data" class="panel reveal reveal-2" novalidate>
            @csrf @method('PUT')
            <div class="panel-head">
                <div class="d-flex align-items-center gap-3">
                    <span class="kpi-icon tint-primary" style="width:44px;height:44px;font-size:1.2rem"><i class="bi {{ $group['icon'] }}"></i></span>
                    <div>
                        <h3 class="panel-title">{{ $group['title'] }}</h3>
                        <p class="panel-sub">{{ $group['description'] }}</p>
                    </div>
                </div>
                @if($customCount)<span class="custom-tag">{{ $customCount }} customised</span>@endif
            </div>
            <div class="panel-body pt-2">
                @php $hasToggles = collect($group['fields'])->every(function ($f) { return $f['type'] === 'toggle'; }); @endphp
                @if($hasToggles)
                    <div class="row g-2 pt-2">
                        @foreach($group['fields'] as $key => $field)
                            @php $name = str_replace('.', '__', $key); $value = old($name, setting($key)); @endphp
                            <div class="col-md-6">
                                <div class="toggle-row h-100 mt-0">
                                    <div><div class="t">{{ $field['label'] }}</div><div class="d">{{ (string) $value === '1' ? 'Visible on homepage' : 'Hidden' }}</div></div>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="{{ $name }}" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="f_{{ $name }}" name="{{ $name }}" value="1" @if((string) $value === '1') checked @endif aria-label="{{ $field['label'] }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @foreach($group['fields'] as $key => $field)
                        @php
                            $name = str_replace('.', '__', $key);
                            $customised = array_key_exists($key, $values);
                            $value = old($name, setting($key));
                            $id = 'f_' . $name;
                        @endphp
                        <div class="field">
                            <div class="field-head">
                                <label class="form-label" for="{{ $id }}">{{ $field['label'] }} @if($customised)<span class="custom-tag">Edited</span>@endif</label>
                                @if($customised)
                                    <label class="reset-link"><input type="checkbox" name="reset[{{ $name }}]" value="1"> Reset to original</label>
                                @endif
                            </div>

                            @if($field['type'] === 'toggle')
                                <div class="form-check form-switch">
                                    <input type="hidden" name="{{ $name }}" value="0">
                                    <input class="form-check-input" type="checkbox" role="switch" id="{{ $id }}" name="{{ $name }}" value="1" @if((string) $value === '1') checked @endif>
                                </div>
                            @elseif(in_array($field['type'], ['textarea', 'html', 'lines']))
                                <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $field['type'] === 'lines' ? 5 : 3 }}" class="form-control @error($name) is-invalid @enderror">{{ $value }}</textarea>
                                @if($field['type'] === 'html')<div class="form-text">Basic formatting allowed: &lt;strong&gt;, &lt;em&gt;, &lt;br&gt;.</div>@endif
                                @if($field['type'] === 'lines')<div class="form-text">Each line becomes one item on the website.</div>@endif
                            @elseif(in_array($field['type'], ['image', 'video']))
                                <div class="row g-3 align-items-stretch">
                                    <div class="col-sm-5">
                                        <div class="media-thumb h-100" id="p_{{ $name }}" style="min-height: 120px">
                                            @if(is_video_path($value))
                                                <video src="{{ site_asset($value) }}" muted loop autoplay playsinline></video>
                                            @elseif($value)
                                                <img src="{{ site_asset($value) }}" alt="">
                                            @else
                                                <i class="bi bi-image"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <label class="upload-zone h-100">
                                            <input type="file" name="file_{{ $name }}" id="{{ $id }}" accept="{{ $field['type'] === 'video' ? 'video/mp4,video/webm,image/*' : 'image/*' }}" data-preview="#p_{{ $name }}">
                                            <span class="ic"><i class="bi {{ $field['type'] === 'video' ? 'bi-camera-video' : 'bi-image' }}"></i></span>
                                            <strong class="small text-2">Replace {{ $field['type'] === 'video' ? 'video or image' : 'image' }}</strong>
                                            <span class="xsmall">{{ $field['type'] === 'video' ? 'MP4 / WEBM up to 50 MB, or an image' : 'JPG, PNG, WEBP or SVG up to 5 MB' }}</span>
                                            <span class="files"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-text text-truncate">Current file: <span class="mono">{{ $value }}</span></div>
                            @else
                                @php $icon = ['email' => 'bi-envelope', 'url' => 'bi-link-45deg'][$field['type']] ?? null; @endphp
                                @if($icon)
                                    <div class="with-icon"><i class="bi {{ $icon }}"></i>
                                        <input type="{{ $field['type'] }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror">
                                    </div>
                                @else
                                    <input type="text" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror">
                                @endif
                            @endif
                            @error($name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            @error('file_' . $name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="sticky-bar">
                <span class="me-auto small text-muted align-items-center gap-1" id="dirtyNote" style="display:none"><span class="new-dot"></span> Unsaved changes</span>
                <a href="{{ route('admin.content.index', ['group' => $active]) }}" class="btn btn-ghost">Discard</a>
                <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var form = document.querySelector('form[action*="/admin/content/"]'), note = document.getElementById('dirtyNote'), dirty = false;
    function markDirty() { dirty = true; note.style.display = 'flex'; }
    form.addEventListener('input', markDirty);
    form.addEventListener('change', markDirty);
    form.addEventListener('submit', function () { dirty = false; });
    window.addEventListener('beforeunload', function (e) { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
    document.querySelectorAll('.toggle-row input[type=checkbox]').forEach(function (c) {
        c.addEventListener('change', function () {
            var d = c.closest('.toggle-row').querySelector('.d');
            if (d) { d.textContent = c.checked ? 'Visible on homepage' : 'Hidden'; }
        });
    });
})();
</script>
@endpush
