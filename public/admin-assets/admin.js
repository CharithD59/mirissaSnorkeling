/* Mirissa Bay – Admin interactions */
(function () {
    'use strict';

    var root = document.documentElement;
    var store = {
        get: function (k) { try { return localStorage.getItem(k); } catch (e) { return null; } },
        set: function (k, v) { try { localStorage.setItem(k, v); } catch (e) { /* ignore */ } }
    };

    /* ---------------- Theme ---------------- */
    var THEME_KEY = 'mb-admin-theme';
    var media = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

    function resolvedTheme(pref) {
        if (pref === 'light' || pref === 'dark') { return pref; }
        return media && media.matches ? 'dark' : 'light';
    }
    function applyTheme(pref, animate) {
        var theme = resolvedTheme(pref);
        if (animate) {
            root.classList.add('theme-transition');
            setTimeout(function () { root.classList.remove('theme-transition'); }, 450);
        }
        root.setAttribute('data-theme', theme);
        root.setAttribute('data-bs-theme', theme);
        root.setAttribute('data-theme-pref', pref || 'system');
        document.querySelectorAll('[data-theme-choice]').forEach(function (el) {
            el.classList.toggle('active', el.getAttribute('data-theme-choice') === (pref || 'system'));
        });
        document.dispatchEvent(new CustomEvent('themechange', { detail: { theme: theme } }));
    }
    window.AdminTheme = {
        set: function (pref) { store.set(THEME_KEY, pref); applyTheme(pref, true); },
        toggle: function () { this.set(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'); },
        current: function () { return root.getAttribute('data-theme') || 'light'; }
    };
    applyTheme(store.get(THEME_KEY) || 'system', false);
    if (media && media.addEventListener) {
        media.addEventListener('change', function () {
            if ((store.get(THEME_KEY) || 'system') === 'system') { applyTheme('system', true); }
        });
    }
    document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () { window.AdminTheme.toggle(); });
    });
    document.querySelectorAll('[data-theme-choice]').forEach(function (btn) {
        btn.addEventListener('click', function (e) { e.preventDefault(); window.AdminTheme.set(btn.getAttribute('data-theme-choice')); });
    });

    /* ---------------- Sidebar ---------------- */
    var SIDEBAR_KEY = 'mb-admin-sidebar';
    document.querySelectorAll('[data-sidebar-collapse]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var collapsed = root.classList.toggle('sidebar-collapsed');
            store.set(SIDEBAR_KEY, collapsed ? 'collapsed' : 'expanded');
            initNavTooltips();
        });
    });
    document.querySelectorAll('[data-sidebar-open]').forEach(function (btn) {
        btn.addEventListener('click', function () { root.classList.add('sidebar-open'); });
    });
    document.querySelectorAll('[data-sidebar-close], .backdrop').forEach(function (el) {
        el.addEventListener('click', function () { root.classList.remove('sidebar-open'); });
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { root.classList.remove('sidebar-open'); } });

    var navTips = [];
    function initNavTooltips() {
        navTips.forEach(function (t) { t.dispose(); });
        navTips = [];
        if (!window.bootstrap || !root.classList.contains('sidebar-collapsed') || window.innerWidth < 992) { return; }
        document.querySelectorAll('.sidebar .nav-item-link, .sidebar .site-card').forEach(function (el) {
            navTips.push(new bootstrap.Tooltip(el, { title: el.getAttribute('data-title'), placement: 'right', trigger: 'hover' }));
        });
    }
    initNavTooltips();

    /* ---------------- Topbar shadow on scroll ---------------- */
    var topbar = document.querySelector('.topbar');
    if (topbar) {
        var onScroll = function () { topbar.classList.toggle('scrolled', window.scrollY > 4); };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---------------- Top progress bar ---------------- */
    var bar = document.getElementById('topProgress');
    function startProgress() {
        if (!bar) { return; }
        bar.classList.remove('done');
        void bar.offsetWidth;
        bar.classList.add('run');
    }
    window.addEventListener('pageshow', function () { if (bar) { bar.classList.remove('run'); bar.classList.add('done'); } });
    document.addEventListener('click', function (e) {
        var a = e.target.closest('a[href]');
        if (!a || e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || a.target === '_blank') { return; }
        var href = a.getAttribute('href');
        if (!href || href.charAt(0) === '#' || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0 || a.hasAttribute('download') || a.hasAttribute('data-bs-toggle')) { return; }
        if (a.host && a.host !== window.location.host) { return; }
        if (/\/export(\?|$)/.test(a.pathname)) { return; }
        startProgress();
    });

    /* ---------------- Forms: loading state + confirm ---------------- */
    var confirmEl = document.getElementById('confirmModal');
    var confirmModal = confirmEl && window.bootstrap ? new bootstrap.Modal(confirmEl) : null;
    var pendingForm = null;

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (form.matches('[data-confirm]') && form.dataset.confirmed !== '1' && confirmModal) {
            e.preventDefault();
            pendingForm = form;
            confirmEl.querySelector('[data-confirm-title]').textContent = form.dataset.confirmTitle || 'Are you sure?';
            confirmEl.querySelector('[data-confirm-text]').textContent = form.dataset.confirm;
            confirmEl.querySelector('[data-confirm-ok]').textContent = form.dataset.confirmButton || 'Delete';
            confirmModal.show();
            return;
        }
        if (form.method.toLowerCase() === 'get') { startProgress(); return; }
        var btn = form.querySelector('button[type=submit]:not([data-no-loading])');
        if (btn) {
            btn.style.width = btn.offsetWidth + 'px';
            btn.classList.add('is-loading');
        }
        form.querySelectorAll('button[type=submit]').forEach(function (b) { b.setAttribute('aria-disabled', 'true'); });
        startProgress();
    });
    if (confirmEl) {
        confirmEl.querySelector('[data-confirm-ok]').addEventListener('click', function () {
            if (!pendingForm) { return; }
            pendingForm.dataset.confirmed = '1';
            confirmModal.hide();
            if (pendingForm.requestSubmit) { pendingForm.requestSubmit(); } else { pendingForm.submit(); }
        });
    }

    document.querySelectorAll('[data-autosubmit]').forEach(function (el) {
        el.addEventListener('change', function () { startProgress(); el.form.submit(); });
    });

    /* ---------------- Clickable rows ---------------- */
    document.querySelectorAll('tr[data-href]').forEach(function (row) {
        row.addEventListener('click', function (e) {
            if (e.target.closest('a, button, form, input, select, label, .dropdown, .dropdown-menu')) { return; }
            startProgress();
            window.location.href = row.dataset.href;
        });
    });

    /* ---------------- File inputs: preview + drop zone ---------------- */
    document.querySelectorAll('input[type=file][data-preview]').forEach(function (input) {
        input.addEventListener('change', function () {
            var target = document.querySelector(input.dataset.preview);
            var file = input.files && input.files[0];
            if (!target || !file) { return; }
            var url = URL.createObjectURL(file);
            var el = file.type.indexOf('video') === 0 ? document.createElement('video') : document.createElement('img');
            el.src = url;
            if (el.tagName === 'VIDEO') { el.muted = true; el.autoplay = true; el.loop = true; el.playsInline = true; }
            target.innerHTML = '';
            target.appendChild(el);
        });
    });
    document.querySelectorAll('.upload-zone').forEach(function (zone) {
        var input = zone.querySelector('input[type=file]');
        var label = zone.querySelector('.files');
        ['dragenter', 'dragover'].forEach(function (ev) { zone.addEventListener(ev, function () { zone.classList.add('drag'); }); });
        ['dragleave', 'drop'].forEach(function (ev) { zone.addEventListener(ev, function () { zone.classList.remove('drag'); }); });
        if (input && label) {
            input.addEventListener('change', function () {
                var n = input.files ? input.files.length : 0;
                label.textContent = n === 0 ? '' : (n === 1 ? input.files[0].name : n + ' files selected');
            });
        }
    });

    /* ---------------- Toasts ---------------- */
    var stack = document.querySelector('.toast-stack');
    function dismiss(t) { t.classList.add('out'); setTimeout(function () { t.remove(); }, 300); }
    if (stack) {
        stack.querySelectorAll('.toast-item').forEach(function (t) {
            var x = t.querySelector('.x');
            if (x) { x.addEventListener('click', function () { dismiss(t); }); }
            if (t.dataset.autohide !== 'false') { setTimeout(function () { dismiss(t); }, 5000); }
        });
    }

    /* ---------------- Tooltips ---------------- */
    if (window.bootstrap) {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) { new bootstrap.Tooltip(el); });
    }

    /* ---------------- Command palette (Ctrl/⌘ + K) ---------------- */
    var cmdEl = document.getElementById('cmdk');
    if (cmdEl && window.bootstrap) {
        var cmd = new bootstrap.Modal(cmdEl);
        var input = cmdEl.querySelector('input');
        var list = cmdEl.querySelector('.cmdk-list');
        var items = Array.prototype.slice.call(list.querySelectorAll('.cmdk-item[data-static]'));
        var dynamic = list.querySelector('[data-dynamic]');
        var activeIndex = 0;

        function visible() { return Array.prototype.slice.call(list.querySelectorAll('.cmdk-item')).filter(function (i) { return i.style.display !== 'none'; }); }
        function highlight(i) {
            var v = visible();
            v.forEach(function (el) { el.classList.remove('active'); });
            if (!v.length) { return; }
            activeIndex = (i + v.length) % v.length;
            v[activeIndex].classList.add('active');
            v[activeIndex].scrollIntoView({ block: 'nearest' });
        }
        function filter() {
            var q = input.value.trim().toLowerCase();
            items.forEach(function (el) { el.style.display = !q || el.textContent.toLowerCase().indexOf(q) !== -1 ? '' : 'none'; });
            list.querySelectorAll('.cmdk-group').forEach(function (g) {
                var next = g.nextElementSibling, any = false;
                while (next && !next.classList.contains('cmdk-group')) { if (next.classList.contains('cmdk-item') && next.style.display !== 'none') { any = true; } next = next.nextElementSibling; }
                g.style.display = any ? '' : 'none';
            });
            dynamic.innerHTML = '';
            if (q) {
                var bookings = dynamic.dataset.bookings, inquiries = dynamic.dataset.inquiries;
                dynamic.innerHTML =
                    '<div class="cmdk-group">Search</div>' +
                    '<div class="cmdk-item" data-href="' + bookings + '?q=' + encodeURIComponent(q) + '"><i class="bi bi-calendar2-week"></i><span>Search bookings for “' + escapeHtml(q) + '”</span><span class="hint">Enter</span></div>' +
                    '<div class="cmdk-item" data-href="' + inquiries + '?q=' + encodeURIComponent(q) + '"><i class="bi bi-chat-square-text"></i><span>Search inquiries for “' + escapeHtml(q) + '”</span></div>';
            }
            highlight(0);
        }
        function go(el) {
            if (!el) { return; }
            if (el.dataset.action === 'theme') { window.AdminTheme.toggle(); cmd.hide(); return; }
            if (el.dataset.action === 'collapse') { document.querySelector('[data-sidebar-collapse]').click(); cmd.hide(); return; }
            startProgress();
            if (el.dataset.blank) { window.open(el.dataset.href, '_blank'); cmd.hide(); return; }
            window.location.href = el.dataset.href;
        }
        function escapeHtml(s) { return s.replace(/[&<>"']/g, function (c) { return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c]; }); }

        input.addEventListener('input', filter);
        input.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowDown') { e.preventDefault(); highlight(activeIndex + 1); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); highlight(activeIndex - 1); }
            else if (e.key === 'Enter') { e.preventDefault(); go(visible()[activeIndex]); }
        });
        list.addEventListener('click', function (e) { var it = e.target.closest('.cmdk-item'); if (it) { go(it); } });
        list.addEventListener('mousemove', function (e) {
            var it = e.target.closest('.cmdk-item'); if (!it) { return; }
            var v = visible(), i = v.indexOf(it); if (i !== activeIndex && i > -1) { highlight(i); }
        });
        cmdEl.addEventListener('shown.bs.modal', function () { input.value = ''; filter(); input.focus(); });
        document.addEventListener('keydown', function (e) {
            if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); cmd.show(); }
            else if (e.key === '/' && !/input|textarea|select/i.test(document.activeElement.tagName)) { e.preventDefault(); cmd.show(); }
        });
        document.querySelectorAll('[data-cmdk]').forEach(function (b) { b.addEventListener('click', function () { cmd.show(); }); });
    }

    /* ---------------- Chart helpers (theme-aware) ---------------- */
    window.AdminCharts = {
        charts: [],
        css: function (name) { return getComputedStyle(root).getPropertyValue(name).trim(); },
        register: function (factory) {
            var self = this;
            var entry = { factory: factory, chart: factory() };
            self.charts.push(entry);
            return entry.chart;
        }
    };
    document.addEventListener('themechange', function () {
        if (!window.Chart) { return; }
        window.AdminCharts.charts.forEach(function (entry) {
            if (entry.chart) { entry.chart.destroy(); }
            entry.chart = entry.factory();
        });
    });
})();
