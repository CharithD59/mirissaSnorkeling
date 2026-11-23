<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="noindex, nofollow">
<meta name="color-scheme" content="light dark">
<link rel="icon" href="{{ site_asset(setting('site.favicon')) }}">
<script>
    // Apply saved theme & sidebar state before first paint (prevents a flash).
    (function () {
        var d = document.documentElement, pref = 'system', side = null;
        try { pref = localStorage.getItem('mb-admin-theme') || 'system'; side = localStorage.getItem('mb-admin-sidebar'); } catch (e) {}
        var dark = pref === 'dark' || (pref === 'system' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
        d.setAttribute('data-theme', dark ? 'dark' : 'light');
        d.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
        if (side === 'collapsed') { d.classList.add('sidebar-collapsed'); }
    })();
</script>
<link rel="preload" href="{{ site_asset('admin-assets/vendor/fonts/inter-latin-wght-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ site_asset('admin-assets/vendor/fonts/plus-jakarta-sans-latin-wght-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
<link href="{{ site_asset('admin-assets/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ site_asset('admin-assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
<link href="{{ site_asset('admin-assets/admin.css') }}?v=2" rel="stylesheet">
