<?php

namespace Waypoint3\LaravelFirebaseGuard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

/**
 * @codeCoverageIgnore
 */
final class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        Auth::viaRequest('firebase', function (Request $request) {
            $guard = new FirebaseGuard(Firebase::auth());
            return $guard->user($request);
        });
    }
}