<?php

namespace Waypoint3\LaravelFirebaseGuard;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth;

class FirebaseGuard
{
    public function __construct(protected Auth $auth) {}

    public function user(Request $request): ?Authenticatable
    {
        if (!$token = $request->bearerToken()) {
            return null;
        }

        try {
            $token = $this->auth->verifyIdToken($token);
            return new User($token->claims()->all());
        } catch (\Exception $exception) {
        }
        return null;
    }
}
