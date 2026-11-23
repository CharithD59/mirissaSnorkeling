<!DOCTYPE html>
<html lang="en" data-theme="light" data-bs-theme="light">
<head>
    @include('admin.partials.head')
    <title>@yield('title', 'Dashboard') · {{ setting('site.name') }} Admin</title>
    @stack('styles')
</head>
<body class="admin">
<div id="topProgress"></div>
@php
    $user = auth()->user();
    $nav = [
        ['section' => 'Overview'],
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'bi-grid-1x2', 'label' => 'Dashboard'],
        ['section' => 'Reservations'],
        ['route' => 'admin.bookings.index', 'match' => 'admin.bookings.*', 'icon' => 'bi-calendar2-week', 'label' => 'Bookings', 'badge' => $pendingBookings],
        ['route' => 'admin.inquiries.index', 'match' => 'admin.inquiries.*', 'icon' => 'bi-chat-square-text', 'label' => 'Inquiries', 'badge' => $pendingInquiries],
        ['section' => 'Website'],
        ['route' => 'admin.packages.index', 'match' => 'admin.packages.*', 'icon' => 'bi-box-seam', 'label' => 'Packages'],
        ['route' => 'admin.content.index', 'match' => 'admin.content.*', 'icon' => 'bi-layout-text-window-reverse', 'label' => 'Website Content'],
        ['route' => 'admin.gallery.index', 'match' => 'admin.gallery.*', 'icon' => 'bi-images', 'label' => 'Gallery'],
        ['section' => 'Settings'],
        ['route' => 'admin.users.index', 'match' => 'admin.users.*', 'icon' => 'bi-people', 'label' => 'Team'],
        ['route' => 'admin.profile', 'match' => 'admin.profile', 'icon' => 'bi-sliders2', 'label' => 'Account & Appearance'],
    ];
@endphp

<div class="app">
    <aside class="sidebar" aria-label="Main navigation">
        <div class="sidebar-brand">
            <img class="brand-logo" src="{{ site_asset(setting('site.logo')) }}" alt="">
            <div class="brand-text">
                <strong>Mirissa Bay</strong>
                <span>Admin workspace</span>
            </div>
            <button type="button" class="icon-btn sm plain sidebar-collapse-btn d-none d-lg-inline-flex" data-sidebar-collapse aria-label="Collapse sidebar">
                <i class="bi bi-chevron-double-left"></i>
            </button>
            <button type="button" class="icon-btn sm plain ms-auto d-lg-none" data-sidebar-close aria-label="Close menu">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            @foreach($nav as $item)
                @if(isset($item['section']))
                    <div class="nav-section">{{ $item['section'] }}</div>
                @else
                    <a href="{{ route($item['route']) }}" data-title="{{ $item['label'] }}"
                       class="nav-item-link {{ request()->routeIs($item['match']) ? 'active' : '' }}"
                       @if(request()->routeIs($item['match'])) aria-current="page" @endif>
                        <span class="nav-icon"><i class="bi {{ $item['icon'] }}"></i></span>
                        <span class="nav-label">{{ $item['label'] }}</span>
                        @if(!empty($item['badge']))<span class="nav-badge">{{ $item['badge'] > 99 ? '99+' : $item['badge'] }}</span>@endif
                    </a>
                @endif
            @endforeach
        </nav>

        <div class="sidebar-foot">
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="site-card" data-title="Open live website">
                <i class="bi bi-globe2"></i>
                <span class="site-text">
                    <span class="t d-block">View live website</span>
                    <span class="s d-block">See your changes in action</span>
                </span>
            </a>
        </div>
    </aside>
    <div class="backdrop"></div>

    <div class="main">
        <header class="topbar">
            <button type="button" class="icon-btn d-lg-none" data-sidebar-open aria-label="Open menu"><i class="bi bi-list"></i></button>

            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="d-none d-sm-inline"><i class="bi bi-house-door"></i></a>
                @hasSection('crumbs')
                    @yield('crumbs')
                @else
                    <span class="sep d-none d-sm-inline"><i class="bi bi-chevron-right"></i></span>
                    <span class="current">@yield('title', 'Dashboard')</span>
                @endif
            </nav>

            <div class="ms-auto d-flex align-items-center gap-2">
                <button type="button" class="search-trigger" data-cmdk aria-label="Search">
                    <i class="bi bi-search"></i>
                    <span class="label">Search or jump to…</span>
                    <span class="kbd">Ctrl K</span>
                </button>

                <button type="button" class="icon-btn theme-toggle" data-theme-toggle aria-label="Toggle dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle theme">
                    <i class="bi bi-sun-fill"></i>
                    <i class="bi bi-moon-stars-fill"></i>
                </button>

                <div class="dropdown">
                    <button type="button" class="icon-btn" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Notifications">
                        <i class="bi bi-bell"></i>
                        @if($pendingInquiries || $pendingBookings)<span class="dot"></span>@endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-0" style="width: 340px; max-width: calc(100vw - 2rem);">
                        <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
                            <strong class="small">Notifications</strong>
                            @if($pendingInquiries + $pendingBookings)
                                <span class="badge-status badge-primary">{{ $pendingInquiries + $pendingBookings }} new</span>
                            @endif
                        </div>
                        <div style="max-height: 360px; overflow-y: auto;">
                            @if($pendingBookings)
                                <a class="list-row" href="{{ route('admin.bookings.index', ['status' => 'pending']) }}">
                                    <span class="kpi-icon tint-warning"><i class="bi bi-hourglass-split"></i></span>
                                    <span class="min-w-0">
                                        <span class="t d-block">{{ $pendingBookings }} booking{{ $pendingBookings === 1 ? '' : 's' }} awaiting confirmation</span>
                                        <span class="s">Review and confirm reservations</span>
                                    </span>
                                </a>
                            @endif
                            @foreach($newInquiries as $n)
                                <a class="list-row" href="{{ route('admin.inquiries.show', $n->getKey()) }}">
                                    <span class="avatar sm {{ avatar_class($n->email) }}">{{ initials($n->cus_name) }}</span>
                                    <span class="min-w-0">
                                        <span class="t d-block text-truncate">{{ $n->cus_name }} <span class="s">· {{ $n->cre_datetime ? $n->cre_datetime->diffForHumans(null, true) : '' }}</span></span>
                                        <span class="s d-block text-truncate">{{ \Illuminate\Support\Str::limit($n->message, 70) }}</span>
                                    </span>
                                </a>
                            @endforeach
                            @if(!$pendingBookings && $newInquiries->isEmpty())
                                <div class="empty py-4">
                                    <div class="art" style="width:56px;height:56px;font-size:1.4rem"><i class="bi bi-check2-all"></i></div>
                                    <p class="mb-0">You're all caught up.</p>
                                </div>
                            @endif
                        </div>
                        @if($pendingInquiries)
                            <div class="p-2 border-top"><a href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}" class="btn btn-ghost btn-sm w-100">View all pending inquiries</a></div>
                        @endif
                    </div>
                </div>

                <div class="dropdown">
                    <button type="button" class="user-chip" data-bs-toggle="dropdown" aria-label="Account menu">
                        <span class="avatar sm round {{ avatar_class($user->username) }}">{{ $user->initials }}</span>
                        <span class="meta d-none d-md-block">
                            <strong>{{ $user->name }}</strong>
                            <span>{{ '@' . $user->username }}</span>
                        </span>
                        <i class="bi bi-chevron-down small text-muted d-none d-md-inline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">Signed in as {{ $user->username }}</li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person-circle"></i>Account settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i>Team</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="dropdown-header">Theme</li>
                        <li class="px-2 pb-1">
                            <div class="segmented sm w-100">
                                <button type="button" class="flex-fill justify-content-center" data-theme-choice="light"><i class="bi bi-sun"></i> Light</button>
                                <button type="button" class="flex-fill justify-content-center" data-theme-choice="dark"><i class="bi bi-moon-stars"></i> Dark</button>
                                <button type="button" class="flex-fill justify-content-center" data-theme-choice="system"><i class="bi bi-display"></i> Auto</button>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button class="dropdown-item danger" type="submit" data-no-loading><i class="bi bi-box-arrow-right"></i>Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="content">
            @hasSection('page_head')
                @yield('page_head')
            @else
                <div class="page-head reveal">
                    <div class="min-w-0">
                        <h1>@yield('heading', $__env->yieldContent('title'))</h1>
                        @hasSection('subtitle')<p>@yield('subtitle')</p>@endif
                    </div>
                    @hasSection('actions')
                        <div class="page-actions">@yield('actions')</div>
                    @endif
                </div>
            @endif

            @if($errors->any())
                <div class="alert-box danger mb-4 reveal" role="alert">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                    <div>
                        <strong>Please check the highlighted fields.</strong>
                        <ul>
                            @foreach(array_slice($errors->all(), 0, 6) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="app-foot">
            <span>&copy; {{ date('Y') }} {{ setting('site.name') }}</span>
            <span>Press <span class="kbd">Ctrl K</span> to search · <span class="kbd">/</span> quick open</span>
        </footer>
    </div>
</div>

{{-- Flash messages as toasts --}}
<div class="toast-stack" aria-live="polite">
    @php
        $toasts = [
            'success' => ['Success', 'bi-check-circle-fill', 'tint-success', 'var(--success)'],
            'error'   => ['Something went wrong', 'bi-x-octagon-fill', 'tint-danger', 'var(--danger)'],
            'warning' => ['Heads up', 'bi-exclamation-triangle-fill', 'tint-warning', 'var(--warning)'],
            'info'    => ['Info', 'bi-info-circle-fill', 'tint-info', 'var(--info)'],
        ];
    @endphp
    @foreach($toasts as $key => $t)
        @if(session($key))
            <div class="toast-item" role="status" style="color: {{ $t[3] }}" @if($key !== 'success') data-autohide="false" @endif>
                <span class="ic {{ $t[2] }}"><i class="bi {{ $t[1] }}"></i></span>
                <div class="min-w-0">
                    <div class="tt">{{ $t[0] }}</div>
                    <div class="tm">{{ session($key) }}</div>
                </div>
                <button type="button" class="x" aria-label="Dismiss">&times;</button>
                @if($key === 'success')<span class="bar"></span>@endif
            </div>
        @endif
    @endforeach
</div>

{{-- Confirm dialog --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 420px">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="d-flex gap-3">
                    <span class="kpi-icon tint-danger flex-shrink-0" style="width:44px;height:44px"><i class="bi bi-trash3"></i></span>
                    <div>
                        <h5 class="mb-1" data-confirm-title>Are you sure?</h5>
                        <p class="text-muted small mb-0" data-confirm-text></p>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-confirm-ok>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Command palette --}}
<div class="modal fade cmdk" id="cmdk" tabindex="-1" aria-hidden="true" aria-label="Command palette">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="cmdk-input">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search pages, bookings, inquiries…" autocomplete="off" aria-label="Search">
                <span class="kbd">Esc</span>
            </div>
            <div class="cmdk-list">
                <div data-dynamic data-bookings="{{ route('admin.bookings.index') }}" data-inquiries="{{ route('admin.inquiries.index') }}"></div>
                <div class="cmdk-group">Navigate</div>
                @foreach($nav as $item)
                    @if(!isset($item['section']))
                        <div class="cmdk-item" data-static data-href="{{ route($item['route']) }}"><i class="bi {{ $item['icon'] }}"></i><span>{{ $item['label'] }}</span></div>
                    @endif
                @endforeach
                <div class="cmdk-group">Actions</div>
                <div class="cmdk-item" data-static data-href="{{ route('admin.bookings.create') }}"><i class="bi bi-plus-lg"></i><span>Create a new booking</span></div>
                <div class="cmdk-item" data-static data-href="{{ route('admin.packages.create') }}"><i class="bi bi-box-seam"></i><span>Add a package</span></div>
                <div class="cmdk-item" data-static data-href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"><i class="bi bi-hourglass-split"></i><span>Review pending bookings</span></div>
                <div class="cmdk-item" data-static data-href="{{ route('admin.inquiries.index', ['status' => 'pending']) }}"><i class="bi bi-reply"></i><span>Answer pending inquiries</span></div>
                <div class="cmdk-item" data-static data-href="{{ route('admin.bookings.export') }}"><i class="bi bi-download"></i><span>Export bookings (CSV)</span></div>
                <div class="cmdk-item" data-static data-action="theme" data-href="#"><i class="bi bi-circle-half"></i><span>Toggle dark / light mode</span></div>
                <div class="cmdk-item d-none d-lg-flex" data-static data-action="collapse" data-href="#"><i class="bi bi-layout-sidebar"></i><span>Collapse / expand sidebar</span></div>
                <div class="cmdk-item" data-static data-blank="1" data-href="{{ url('/') }}"><i class="bi bi-globe2"></i><span>Open live website</span></div>
            </div>
            <div class="cmdk-foot">
                <span><span class="kbd">↑</span> <span class="kbd">↓</span> navigate</span>
                <span><span class="kbd">Enter</span> open</span>
                <span><span class="kbd">Esc</span> close</span>
            </div>
        </div>
    </div>
</div>

<script src="{{ site_asset('admin-assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ site_asset('admin-assets/admin.js') }}?v=2"></script>
@stack('scripts')
</body>
</html>
