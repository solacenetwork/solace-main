<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse|JsonResponse
    {
        // Set 24-hour session parameters
        Session::put('extended_lifetime', true);
        Session::put('expires_at', now()->addMinutes(1440)->timestamp);
        Session::put('last_activity', now()->timestamp);

        // Default Jetstream redirect (to /dashboard)
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended(config('fortify.home'));
    }
}