<!DOCTYPE html>
<html lang="en" data-theme="light" data-bs-theme="light">
<head>
    @include('admin.partials.head')
    <title>Sign in · {{ setting('site.name') }} Admin</title>
</head>
<body class="admin">
<div id="topProgress"></div>
<div class="auth">
    <section class="auth-art">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ site_asset(setting('site.logo')) }}" alt="" class="brand-logo" style="width:46px;height:46px">
            <div class="lh-sm">
                <strong class="d-block" style="font-family: var(--font-display); font-size: 1.05rem">Mirissa Bay</strong>
                <span style="opacity:.7; font-size:.8rem">Admin workspace</span>
            </div>
        </div>

        <div>
            <h1>Run every tour<br>from <span class="grad">one calm place.</span></h1>
            <p style="opacity:.78; max-width: 460px; margin-top: 1rem;">Bookings, customer conversations, packages and your website content — beautifully organised for {{ setting('site.name') }}.</p>
            <div class="auth-feats">
                <div class="auth-feat"><i class="bi bi-calendar2-check"></i><span>Confirm reservations and email guests in seconds</span></div>
                <div class="auth-feat"><i class="bi bi-chat-square-heart"></i><span>Reply to inquiries without leaving the dashboard</span></div>
                <div class="auth-feat"><i class="bi bi-magic"></i><span>Edit your website text, photos and prices live</span></div>
            </div>
        </div>

        <small style="opacity:.6">&copy; {{ date('Y') }} {{ setting('site.name') }}</small>
    </section>

    <section class="auth-form-wrap">
        <div class="auth-top">
            <button type="button" class="icon-btn theme-toggle" data-theme-toggle aria-label="Toggle dark mode">
                <i class="bi bi-sun-fill"></i>
                <i class="bi bi-moon-stars-fill"></i>
            </button>
        </div>

        <div class="auth-card reveal">
            <div class="d-lg-none text-center mb-4">
                <img src="{{ site_asset(setting('site.logo')) }}" alt="" class="brand-logo" style="width:60px;height:60px">
            </div>
            <span class="badge-status badge-primary mb-3">Admin access</span>
            <h2>Welcome back</h2>
            <p class="text-muted mb-4">Sign in with your username or email to continue.</p>

            @if(session('success'))
                <div class="alert-box info mb-3"><i class="bi bi-check-circle-fill"></i><div>{{ session('success') }}</div></div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="username">Username or email</label>
                    <div class="with-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="e.g. admin"
                               class="form-control @error('username') is-invalid @enderror" autocomplete="username" autofocus required>
                    </div>
                    @error('username')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <div class="with-icon position-relative">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                               class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required style="padding-right: 2.8rem">
                        <button type="button" class="icon-btn sm plain position-absolute top-50 end-0 translate-middle-y me-1" id="togglePw" aria-label="Show password"><i class="bi bi-eye"></i></button>
                    </div>
                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1">
                        <label class="form-check-label small" for="remember">Keep me signed in</label>
                    </div>
                    <a href="{{ url('/') }}" class="small fw-600"><i class="bi bi-arrow-left"></i> Website</a>
                </div>
                <button class="btn btn-gradient btn-lg w-100" type="submit">Sign in <i class="bi bi-arrow-right"></i></button>
            </form>
            <p class="text-faint xsmall text-center mt-4 mb-0"><i class="bi bi-shield-lock"></i> Protected area · attempts are rate-limited</p>
        </div>
    </section>
</div>

<script src="{{ site_asset('admin-assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ site_asset('admin-assets/admin.js') }}?v=2"></script>
<script>
document.getElementById('togglePw').addEventListener('click', function () {
    var pw = document.getElementById('password');
    var show = pw.type === 'password';
    pw.type = show ? 'text' : 'password';
    this.innerHTML = show ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
});
</script>
</body>
</html>
