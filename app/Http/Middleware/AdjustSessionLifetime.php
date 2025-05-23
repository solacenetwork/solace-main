<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdjustSessionLifetime
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $request->session()->put('extended_lifetime', true);
            $request->session()->put('expires_at', now()->addMinutes(1440)->timestamp);
            $request->session()->put('last_activity', now()->timestamp);
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (Auth::check() && Session::has('expires_at')) {
            $expiresAt = Session::get('expires_at');
            if (now()->timestamp > $expiresAt) {
                Auth::logout();
                Session::flush();
                $request->session()->invalidate();
            }
        }
    }
}