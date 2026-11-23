<?php

use App\Support\SiteContent;
use Illuminate\Support\Str;

if (!function_exists('setting')) {
    /** Get an editable website value (see config/site_content.php). */
    function setting($key, $default = null)
    {
        return SiteContent::get($key, $default);
    }
}

if (!function_exists('setting_on')) {
    function setting_on($key)
    {
        return (string) SiteContent::get($key, '1') === '1';
    }
}

if (!function_exists('site_asset')) {
    /** URL for a file stored relative to /public (respects ASSET_PREFIX) or an absolute URL. */
    function site_asset($path)
    {
        if (empty($path)) {
            return '';
        }
        if (preg_match('#^(https?:)?//#i', $path)) {
            return $path;
        }
        return asset(env('ASSET_PREFIX', '') . ltrim($path, '/'));
    }
}

if (!function_exists('is_video_path')) {
    function is_video_path($path)
    {
        return (bool) preg_match('/\.(mp4|webm|ogg|mov)$/i', (string) $path);
    }
}

if (!function_exists('cms_html')) {
    /** Allow basic formatting only. */
    function cms_html($html)
    {
        return strip_tags((string) $html, '<strong><b><em><i><u><br><span><a>');
    }
}

if (!function_exists('cms_highlight')) {
    /** Escapes text and turns *words* into a highlighted span. */
    function cms_highlight($text, $class = 'text-primary')
    {
        $escaped = e((string) $text);
        return preg_replace('/\*(.+?)\*/u', '<span class="' . e($class) . '">$1</span>', $escaped);
    }
}

if (!function_exists('cms_lines')) {
    function cms_lines($key)
    {
        $lines = preg_split('/\r\n|\r|\n/', (string) setting($key, ''));
        return array_values(array_filter(array_map('trim', $lines), function ($line) {
            return $line !== '';
        }));
    }
}

if (!function_exists('cms_pairs')) {
    /** Lines in "icon | text" format. */
    function cms_pairs($key)
    {
        $pairs = [];
        foreach (cms_lines($key) as $line) {
            $parts = array_map('trim', explode('|', $line, 2));
            $pairs[] = count($parts) === 2 ? ['icon' => $parts[0], 'text' => $parts[1]] : ['icon' => '', 'text' => $parts[0]];
        }
        return $pairs;
    }
}

if (!function_exists('status_badge')) {
    function status_badge($status)
    {
        $map = [
            'pending' => 'warning', 'confirmed' => 'primary', 'completed' => 'success',
            'cancelled' => 'danger', 'replied' => 'info', 'closed' => 'secondary',
        ];
        $status = $status ?: 'pending';
        $color = isset($map[$status]) ? $map[$status] : 'secondary';
        return '<span class="badge-status badge-' . $color . '">' . e(Str::title($status)) . '</span>';
    }
}

if (!function_exists('wa_number')) {
    /** Digits for a wa.me link. Local Sri Lankan numbers (07x...) get the 94 country code. */
    function wa_number($phone)
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        if (strlen($digits) === 10 && strpos($digits, '0') === 0) {
            $digits = '94' . substr($digits, 1);
        }
        return $digits;
    }
}

if (!function_exists('initials')) {
    function initials($name)
    {
        $parts = preg_split('/\s+/', trim((string) $name));
        $out = '';
        foreach (array_slice(array_filter($parts), 0, 2) as $part) {
            $out .= mb_strtoupper(mb_substr($part, 0, 1));
        }
        return $out ?: '?';
    }
}

if (!function_exists('avatar_class')) {
    /** Stable gradient colour for a person's avatar. */
    function avatar_class($seed)
    {
        return 'c' . (abs(crc32(strtolower(trim((string) $seed)))) % 6);
    }
}
