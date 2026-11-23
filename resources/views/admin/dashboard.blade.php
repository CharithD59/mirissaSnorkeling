@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page_head')
@php
    $now = now('Asia/Colombo');
    $hour = (int) $now->format('G');
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
    $firstName = explode(' ', trim(auth()->user()->name))[0];
@endphp
<section class="hero mb-4 reveal">
    <svg class="waves" viewBox="0 0 400 120" fill="none" aria-hidden="true">
        <path d="M0 60 C 60 20, 120 100, 200 60 S 340 20, 400 60" stroke="#fff" stroke-width="2"/>
        <path d="M0 80 C 60 40, 120 120, 200 80 S 340 40, 400 80" stroke="#fff" stroke-width="2" opacity=".6"/>
        <path d="M0 100 C 60 60, 120 140, 200 100 S 340 60, 400 100" stroke="#fff" stroke-width="2" opacity=".35"/>
    </svg>
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 position-relative">
        <div>
            <span class="hero-chip"><i class="bi bi-calendar3"></i> {{ $now->format('l, d F Y') }}</span>
            <h2>{{ $greeting }}, {{ $firstName }} 👋</h2>
            <p>
                @if($stats['bookings_pending'] || $stats['inquiries_pending'])
                    You have <strong>{{ $stats['bookings_pending'] }}</strong> booking{{ $stats['bookings_pending'] === 1 ? '' : 's' }} to confirm and
                    <strong>{{ $stats['inquiries_pending'] }}</strong> inquir{{ $stats['inquiries_pending'] === 1 ? 'y' : 'ies' }} waiting for a reply.
                @else
                    Everything is up to date. Enjoy the calm seas today.
                @endif
            </p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.bookings.create') }}" class="btn btn-white"><i class="bi bi-plus-lg"></i> New booking</a>
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="btn btn-glass"><i class="bi bi-lightning-charge"></i> Review pending</a>
        </div>
    </div>
    <div class="hero-stats position-relative">
        <div class="hero-stat"><div class="v tabular">{{ $stats['bookings_today'] }}</div><div class="l">New bookings today</div></div>
        <div class="hero-stat"><div class="v tabular">{{ $upcoming->count() }}</div><div class="l">Tours in next 14 days</div></div>
        <div class="hero-stat"><div class="v tabular">{{ number_format($stats['guests_upcoming']) }}</div><div class="l">Guests expected</div></div>
        <div class="hero-stat"><div class="v tabular">${{ number_format($stats['revenue_confirmed'], 0) }}</div><div class="l">Confirmed revenue</div></div>
    </div>
</section>
@endsection

@section('content')
@php
    $mbDelta = function ($now, $prev) {
        if ($prev == 0) { return $now > 0 ? ['up', 'New'] : ['flat', '0%']; }
        $p = round(($now - $prev) / $prev * 100);
        return [$p > 0 ? 'up' : ($p < 0 ? 'down' : 'flat'), ($p > 0 ? '+' : '') . $p . '%'];
    };
    $bDelta = $mbDelta($stats['bookings_this_month'], $stats['bookings_last_month']);
    $iDelta = $mbDelta($stats['inquiries_this_month'], $stats['inquiries_last_month']);
    $statusColors = ['pending' => 'var(--warning)', 'confirmed' => 'var(--primary)', 'completed' => 'var(--success)', 'cancelled' => 'var(--danger)'];
    $statusTotal = max(1, array_sum(array_column($statusChart, 'value')));
@endphp

{{-- KPI cards --}}
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-sm-6 col-xl-3 reveal reveal-1">
        <a href="{{ route('admin.bookings.index') }}" class="panel hoverable kpi">
            <div class="kpi-top"><span class="kpi-label">Total bookings</span><span class="kpi-icon tint-primary"><i class="bi bi-calendar2-week"></i></span></div>
            <div class="kpi-row">
                <span class="kpi-value" data-count="{{ $stats['bookings_total'] }}">{{ number_format($stats['bookings_total']) }}</span>
                <canvas class="kpi-spark" id="sparkBookings" aria-hidden="true"></canvas>
            </div>
            <div class="kpi-foot"><span class="delta {{ $bDelta[0] }}"><i class="bi {{ $bDelta[0] === 'down' ? 'bi-arrow-down-right' : 'bi-arrow-up-right' }}"></i>{{ $bDelta[1] }}</span> {{ $stats['bookings_this_month'] }} this month vs last</div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3 reveal reveal-2">
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="panel hoverable kpi">
            <div class="kpi-top"><span class="kpi-label">Pending bookings</span><span class="kpi-icon tint-warning"><i class="bi bi-hourglass-split"></i></span></div>
            <div class="kpi-row">
                <span class="kpi-value" data-count="{{ $stats['bookings_pending'] }}">{{ number_format($stats['bookings_pending']) }}</span>
                @if($stats['bookings_pending'])<span class="btn btn-soft btn-sm">Review <i class="bi bi-arrow-right"></i></span>@endif
            </div>
            <div class="kpi-foot">
                @if($stats['oldest_pending'])
                    <i class="bi bi-clock-history"></i> Oldest waiting {{ $stats['oldest_pending']->diffForHumans(null, true) }}
                @else
                    <i class="bi bi-check2-circle"></i> Nothing waiting
                @endif
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3 reveal reveal-3">
        <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" class="panel hoverable kpi">
            <div class="kpi-top"><span class="kpi-label">Confirmed bookings</span><span class="kpi-icon tint-success"><i class="bi bi-patch-check"></i></span></div>
            <div class="kpi-row">
                <span class="kpi-value" data-count="{{ $stats['bookings_confirmed'] }}">{{ number_format($stats['bookings_confirmed']) }}</span>
                @if($stats['confirmation_rate'] !== null)
                    <span class="text-end"><span class="d-block fw-700 text-success tabular">{{ $stats['confirmation_rate'] }}%</span><span class="xsmall text-muted">confirmation rate</span></span>
                @endif
            </div>
            <div class="kpi-foot">{{ $stats['bookings_completed'] }} completed · {{ $stats['bookings_cancelled'] }} cancelled</div>
        </a>
    </div>
    <div class="col-sm-6 col-xl-3 reveal reveal-4">
        <a href="{{ route('admin.inquiries.index') }}" class="panel hoverable kpi">
            <div class="kpi-top"><span class="kpi-label">Customer inquiries</span><span class="kpi-icon tint-accent"><i class="bi bi-chat-square-text"></i></span></div>
            <div class="kpi-row">
                <span class="kpi-value" data-count="{{ $stats['inquiries_total'] }}">{{ number_format($stats['inquiries_total']) }}</span>
                <canvas class="kpi-spark" id="sparkInquiries" aria-hidden="true"></canvas>
            </div>
            <div class="kpi-foot"><span class="delta {{ $iDelta[0] }}"><i class="bi {{ $iDelta[0] === 'down' ? 'bi-arrow-down-right' : 'bi-arrow-up-right' }}"></i>{{ $iDelta[1] }}</span> {{ $stats['response_rate'] !== null ? $stats['response_rate'] . '% answered' : 'No inquiries yet' }}</div>
        </a>
    </div>
</div>

{{-- Trend + status --}}
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-xl-8 reveal reveal-3">
        <div class="panel panel-fill h-100">
            <div class="panel-head flush">
                <div>
                    <h3 class="panel-title">Booking activity</h3>
                    <p class="panel-sub">New bookings and inquiries received</p>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="legend">
                        <span><span class="sw" style="background: var(--chart-1)"></span>Bookings</span>
                        <span style="color: var(--chart-2)"><span class="sw dashed"></span><span class="text-2">Inquiries</span></span>
                    </div>
                    <div class="segmented sm" role="tablist" aria-label="Range">
                        <button type="button" class="active" data-range="months">12 months</button>
                        <button type="button" data-range="days">30 days</button>
                    </div>
                </div>
            </div>
            <div class="panel-body pt-2">
                <div class="chart-wrap"><div class="skeleton"></div><canvas id="trendChart" role="img" aria-label="Bookings and inquiries over time"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 reveal reveal-4">
        <div class="panel h-100">
            <div class="panel-head flush">
                <div>
                    <h3 class="panel-title">Bookings by status</h3>
                    <p class="panel-sub">{{ number_format($stats['bookings_total']) }} bookings in total</p>
                </div>
            </div>
            <div class="panel-body">
                <div class="status-meter mb-3" role="img" aria-label="Status distribution">
                    @foreach($statusChart as $s)
                        @if($s['value'])<span style="flex-grow: {{ $s['value'] }}; background: {{ $statusColors[$s['key']] }}" title="{{ $s['label'] }}: {{ $s['value'] }}"></span>@endif
                    @endforeach
                </div>
                @foreach($statusChart as $s)
                    <a href="{{ route('admin.bookings.index', ['status' => $s['key']]) }}" class="status-row">
                        <span class="sq" style="background: {{ $statusColors[$s['key']] }}"></span>
                        <span class="fw-600">{{ $s['label'] }}</span>
                        <span class="n">{{ $s['value'] }}</span>
                        <span class="p">{{ round($s['value'] / $statusTotal * 100) }}%</span>
                    </a>
                @endforeach

                <div class="mt-3 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-700 small">Most booked tours</span>
                        <a href="{{ route('admin.packages.index') }}" class="xsmall fw-600">Packages <i class="bi bi-arrow-right"></i></a>
                    </div>
                    @php $maxPopular = max(1, (int) $popular->max('total')); @endphp
                    @forelse($popular->take(5) as $p)
                        <div class="mb-2">
                            <div class="d-flex justify-content-between small mb-1"><span class="text-truncate text-2 pe-2">{{ $p->service_name }}</span><span class="fw-700 tabular">{{ $p->total }}</span></div>
                            <div class="status-meter" style="height:6px"><span style="flex-grow: {{ $p->total }}; background: var(--chart-1)"></span><span style="flex-grow: {{ $maxPopular - $p->total }}; background: transparent"></span></div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No bookings yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Demand + upcoming --}}
<div class="row g-3 g-xl-4 mb-4">
    <div class="col-xl-8 reveal reveal-4">
        <div class="panel panel-fill h-100">
            <div class="panel-head flush">
                <div>
                    <h3 class="panel-title">Guest demand · next 14 days</h3>
                    <p class="panel-sub">Adults + kids on tours that are not cancelled</p>
                </div>
                <span class="pill"><i class="bi bi-people"></i>{{ array_sum($demand['guests']) }} guests</span>
            </div>
            <div class="panel-body pt-2">
                <div class="chart-wrap sm"><div class="skeleton"></div><canvas id="demandChart" role="img" aria-label="Guests per day for the next 14 days"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 reveal reveal-5">
        <div class="panel h-100">
            <div class="panel-head">
                <h3 class="panel-title">Upcoming tours</h3>
                <a href="{{ route('admin.bookings.index', ['from' => now()->toDateString(), 'sort' => 'tour_asc']) }}" class="btn btn-ghost btn-sm">View all</a>
            </div>
            @forelse($upcoming->take(5) as $u)
                <a href="{{ route('admin.bookings.show', $u->getKey()) }}" class="list-row">
                    <span class="date-tile"><span class="m">{{ $u->tour_date ? $u->tour_date->format('M') : '' }}</span><span class="d">{{ $u->tour_date ? $u->tour_date->format('d') : '–' }}</span></span>
                    <span class="min-w-0 flex-grow-1">
                        <span class="t d-block text-truncate">{{ $u->cus_name }}</span>
                        <span class="s d-block text-truncate">{{ $u->service_name }} · {{ $u->guest_count }} guest{{ $u->guest_count === 1 ? '' : 's' }}</span>
                    </span>
                    {!! status_badge($u->status) !!}
                </a>
            @empty
                <div class="empty"><div class="art"><i class="bi bi-sun"></i></div><h4>No upcoming tours</h4><p>Nothing scheduled in the next two weeks.</p></div>
            @endforelse
        </div>
    </div>
</div>

{{-- Recent bookings + inquiries --}}
<div class="row g-3 g-xl-4">
    <div class="col-xl-8 reveal reveal-5">
        <div class="panel h-100">
            <div class="panel-head">
                <div>
                    <h3 class="panel-title">Recent bookings</h3>
                    <p class="panel-sub">Latest reservations from the website and team</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">All bookings <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="table-wrap">
                <table class="data-table stack">
                    <thead><tr><th>Customer</th><th>Tour</th><th>Tour date</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($recentBookings as $b)
                        <tr data-href="{{ route('admin.bookings.show', $b->getKey()) }}">
                            <td class="cell-main">
                                <div class="cell-user">
                                    <span class="avatar sm {{ avatar_class($b->email) }}">{{ initials($b->cus_name) }}</span>
                                    <div class="who"><div class="n">{{ $b->cus_name }}</div><div class="e">{{ $b->cre_datetime ? $b->cre_datetime->diffForHumans() : '' }}</div></div>
                                </div>
                            </td>
                            <td data-label="Tour"><div class="strong text-truncate" style="max-width: 200px">{{ $b->service_name }}</div><div class="xsmall text-muted">{{ $b->guest_count }} guest{{ $b->guest_count === 1 ? '' : 's' }}</div></td>
                            <td data-label="Tour date" class="text-nowrap tabular">{{ $b->tour_date ? $b->tour_date->format('d M Y') : $b->datetime }}</td>
                            <td data-label="Status">{!! status_badge($b->status) !!}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><div class="empty"><div class="art"><i class="bi bi-calendar-x"></i></div><h4>No bookings yet</h4><p>New website bookings will appear here instantly.</p></div></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 reveal reveal-6">
        <div class="panel h-100">
            <div class="panel-head">
                <div>
                    <h3 class="panel-title">Latest inquiries</h3>
                    <p class="panel-sub">{{ $stats['inquiries_pending'] }} waiting for a reply</p>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-ghost btn-sm">Inbox</a>
            </div>
            @forelse($recentInquiries as $i)
                <a href="{{ route('admin.inquiries.show', $i->getKey()) }}" class="list-row align-items-start">
                    <span class="avatar sm round {{ avatar_class($i->email) }}">{{ initials($i->cus_name) }}</span>
                    <span class="min-w-0 flex-grow-1">
                        <span class="d-flex justify-content-between gap-2">
                            <span class="t text-truncate">{{ $i->cus_name }}</span>
                            <span class="s text-nowrap">{{ $i->cre_datetime ? $i->cre_datetime->diffForHumans(null, true) : '' }}</span>
                        </span>
                        <span class="s d-block text-truncate mb-1">{{ $i->message }}</span>
                        {!! status_badge($i->status) !!}
                    </span>
                </a>
            @empty
                <div class="empty"><div class="art"><i class="bi bi-inbox"></i></div><h4>Inbox zero</h4><p>Contact form messages will show up here.</p></div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ site_asset('admin-assets/vendor/chartjs/chart.umd.min.js') }}"></script>
<script>
(function () {
    if (!window.Chart) { return; }
    var C = window.AdminCharts;
    var data = {
        months: { labels: @json($chart['labels']), bookings: @json($chart['bookings']), inquiries: @json($chart['inquiries']) },
        days: { labels: @json($daily['labels']), bookings: @json($daily['bookings']), inquiries: @json($daily['inquiries']) },
        demand: { labels: @json($demand['labels']), guests: @json($demand['guests']) }
    };
    var range = 'months';

    function base() {
        Chart.defaults.font.family = getComputedStyle(document.body).fontFamily;
        Chart.defaults.font.size = 12;
        Chart.defaults.color = C.css('--chart-axis');
    }
    function tooltip() {
        return {
            backgroundColor: C.css('--chart-tooltip'), titleColor: '#fff', bodyColor: 'rgba(255,255,255,.85)',
            borderColor: 'rgba(255,255,255,.08)', borderWidth: 1, padding: 12, cornerRadius: 10,
            titleFont: { weight: '700' }, boxPadding: 5, usePointStyle: true
        };
    }
    function gradient(ctx, area, color) {
        var g = ctx.createLinearGradient(0, area.top, 0, area.bottom);
        g.addColorStop(0, color + '38');
        g.addColorStop(1, color + '00');
        return g;
    }
    function ready(id) { var c = document.getElementById(id); if (c) { c.parentElement.classList.add('ready'); } }

    // Crosshair line for the trend chart
    var crosshair = {
        id: 'crosshair',
        afterDatasetsDraw: function (chart) {
            var a = chart.tooltip && chart.tooltip.getActiveElements();
            if (!a || !a.length) { return; }
            var x = a[0].element.x, ctx = chart.ctx;
            ctx.save(); ctx.beginPath(); ctx.moveTo(x, chart.chartArea.top); ctx.lineTo(x, chart.chartArea.bottom);
            ctx.lineWidth = 1; ctx.strokeStyle = C.css('--border-strong'); ctx.setLineDash([4, 4]); ctx.stroke(); ctx.restore();
        }
    };

    var trend = C.register(function () {
        base();
        var c1 = C.css('--chart-1'), c2 = C.css('--chart-2'), d = data[range];
        var chart = new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                labels: d.labels,
                datasets: [
                    { label: 'Bookings', data: d.bookings, borderColor: c1, borderWidth: 2.5, tension: .4, cubicInterpolationMode: 'monotone', fill: true,
                      backgroundColor: function (ctx) { var a = ctx.chart.chartArea; return a ? gradient(ctx.chart.ctx, a, c1) : 'transparent'; },
                      pointRadius: 0, pointHoverRadius: 6, pointHoverBorderWidth: 3, pointHoverBorderColor: C.css('--surface'), pointBackgroundColor: c1 },
                    { label: 'Inquiries', data: d.inquiries, borderColor: c2, borderWidth: 2, borderDash: [6, 5], tension: .4, cubicInterpolationMode: 'monotone', fill: false,
                      pointRadius: 0, pointHoverRadius: 6, pointHoverBorderWidth: 3, pointHoverBorderColor: C.css('--surface'), pointBackgroundColor: c2 }
                ]
            },
            options: {
                maintainAspectRatio: false, animation: { duration: 700, easing: 'easeOutQuart' },
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false }, tooltip: tooltip() },
                scales: {
                    x: { grid: { display: false }, border: { display: false }, ticks: { maxRotation: 0, autoSkipPadding: 14 } },
                    y: { beginAtZero: true, grid: { color: C.css('--chart-grid'), drawTicks: false }, border: { display: false }, ticks: { precision: 0, padding: 10 } }
                }
            },
            plugins: [crosshair]
        });
        ready('trendChart');
        return chart;
    });

    document.querySelectorAll('[data-range]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            range = btn.dataset.range;
            document.querySelectorAll('[data-range]').forEach(function (b) { b.classList.toggle('active', b === btn); });
            var entry = C.charts[0];
            var d = data[range];
            entry.chart.data.labels = d.labels;
            entry.chart.data.datasets[0].data = d.bookings;
            entry.chart.data.datasets[1].data = d.inquiries;
            entry.chart.update();
        });
    });

    C.register(function () {
        base();
        var c1 = C.css('--chart-1');
        var chart = new Chart(document.getElementById('demandChart'), {
            type: 'bar',
            data: { labels: data.demand.labels, datasets: [{ label: 'Guests', data: data.demand.guests, backgroundColor: c1, hoverBackgroundColor: C.css('--primary-hover'), borderRadius: { topLeft: 6, topRight: 6 }, borderSkipped: 'start', maxBarThickness: 28 }] },
            options: {
                maintainAspectRatio: false, animation: { duration: 700 },
                plugins: { legend: { display: false }, tooltip: tooltip() },
                scales: {
                    x: { grid: { display: false }, border: { display: false }, ticks: { maxRotation: 0, autoSkipPadding: 8 } },
                    y: { beginAtZero: true, grid: { color: C.css('--chart-grid'), drawTicks: false }, border: { display: false }, ticks: { precision: 0, padding: 10 } }
                }
            }
        });
        ready('demandChart');
        return chart;
    });

    function spark(id, values, cssVar) {
        var el = document.getElementById(id);
        if (!el) { return; }
        C.register(function () {
            var color = C.css(cssVar);
            return new Chart(el, {
                type: 'line',
                data: { labels: values.map(function (_, i) { return i; }), datasets: [{ data: values, borderColor: color, borderWidth: 2, tension: .4, cubicInterpolationMode: 'monotone', pointRadius: 0, fill: true,
                    backgroundColor: function (ctx) { var a = ctx.chart.chartArea; return a ? gradient(ctx.chart.ctx, a, color) : 'transparent'; } }] },
                options: { responsive: false, animation: false, events: [], plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    scales: { x: { display: false }, y: { display: false, beginAtZero: true } }, layout: { padding: 2 } }
            });
        });
    }
    spark('sparkBookings', data.days.bookings, '--chart-1');
    spark('sparkInquiries', data.days.inquiries, '--chart-2');

    // Count-up animation for KPI values
    document.querySelectorAll('[data-count]').forEach(function (el) {
        var target = parseInt(el.dataset.count, 10) || 0, start = null;
        if (target < 2 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }
        function step(ts) {
            if (!start) { start = ts; }
            var p = Math.min((ts - start) / 900, 1), eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString();
            if (p < 1) { requestAnimationFrame(step); }
        }
        requestAnimationFrame(step);
    });
})();
</script>
@endpush
