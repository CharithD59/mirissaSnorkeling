@extends('admin.layouts.app')

@section('title', 'Account & Appearance')
@section('subtitle', 'Your profile, password and how the admin panel looks.')

@section('content')
<div class="row g-3 g-xl-4">
    <div class="col-xl-4">
        <div class="panel mb-4 reveal reveal-1 overflow-hidden">
            <div style="height: 86px; background: var(--gradient-brand);"></div>
            <div class="panel-body pt-0" style="margin-top: -34px">
                <span class="avatar lg round {{ avatar_class($user->username) }}" style="width:68px;height:68px;font-size:1.3rem;border:4px solid var(--surface)">{{ $user->initials }}</span>
                <h3 class="mt-2 mb-0" style="font-size:1.15rem">{{ $user->name }}</h3>
                <div class="text-muted small">{{ '@' . $user->username }} · {{ $user->email }}</div>
                <div class="d-flex gap-2 mt-3 flex-wrap">
                    <span class="pill"><i class="bi bi-shield-check"></i>{{ ucfirst($user->role ?: 'admin') }}</span>
                    <span class="pill"><i class="bi bi-clock-history"></i>{{ $user->last_login_at ? 'Signed in ' . $user->last_login_at->diffForHumans() : 'First sign-in' }}</span>
                </div>
            </div>
        </div>

        <div class="panel reveal reveal-2">
            <div class="panel-head"><div><h3 class="panel-title"><span class="ic"><i class="bi bi-palette"></i></span>Appearance</h3><p class="panel-sub">Saved on this device</p></div></div>
            <div class="panel-body">
                <div class="row g-2">
                    @foreach(['light' => ['Light', 'bi-sun'], 'dark' => ['Dark', 'bi-moon-stars'], 'system' => ['System', 'bi-display']] as $key => $opt)
                        <div class="col-4">
                            <button type="button" class="theme-card w-100" data-theme-choice="{{ $key }}">
                                <span class="theme-preview {{ $key }}"><span></span><span></span><span></span></span>
                                <span class="d-flex align-items-center justify-content-center gap-1 small fw-600"><i class="bi {{ $opt[1] }}"></i>{{ $opt[0] }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="toggle-row mt-3">
                    <div><div class="t">Compact sidebar</div><div class="d">Show icons only on desktop</div></div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="compactSidebar" aria-label="Compact sidebar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <form method="POST" action="{{ route('admin.profile.update') }}" class="panel reveal reveal-2" novalidate>
            @csrf @method('PUT')
            <div class="panel-body">
                <div class="form-section">
                    <div class="form-section-head"><span class="ic"><i class="bi bi-person"></i></span><div><h3>Profile</h3><p>How your name appears to the team and in email replies</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <div class="with-icon"><i class="bi bi-envelope"></i><input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required></div>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-section-head"><span class="ic"><i class="bi bi-shield-lock"></i></span><div><h3>Change password</h3><p>Leave empty to keep your current password</p></div></div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="current_password">Current password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password">New password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm new password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="sticky-bar"><button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Save profile</button></div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var cb = document.getElementById('compactSidebar'), root = document.documentElement;
    cb.checked = root.classList.contains('sidebar-collapsed');
    cb.addEventListener('change', function () {
        if (cb.checked !== root.classList.contains('sidebar-collapsed')) { document.querySelector('[data-sidebar-collapse]').click(); }
    });
})();
</script>
@endpush
