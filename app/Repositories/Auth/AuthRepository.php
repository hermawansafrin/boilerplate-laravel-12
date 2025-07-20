<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * Check if user is login
     */
    public function isLogin(): bool
    {
        return Auth::check();
    }

    /**
     * Do login logic
     */
    public function doLogin(Request $request): bool
    {
        $authAttempt = Auth::attempt($request->only('email', 'password'));

        return $authAttempt;
    }

    /**
     * Do logout logic
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
