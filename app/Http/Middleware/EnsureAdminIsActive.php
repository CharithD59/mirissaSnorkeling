<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAdminIsActive
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && isset($user->is_active) && !$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors(['username' => 'Your account has been disabled.']);
        }

        return $next($request);
    }
}
