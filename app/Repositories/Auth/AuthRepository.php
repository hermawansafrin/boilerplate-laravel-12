<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
     * Get login user
     */
    public function loginUser(): ?array
    {
        $user = Auth::user();
        if ($user === null) {
            return null;
        }

        $token = $user->createToken(Str::random(120))->plainTextToken;

        return [
            'user' => $user,
            'token' => [
                'type' => 'Bearer',
                'value' => $token,
            ],
        ];
    }

    /**
     * Do logout logic
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Logout API
     */
    public function logoutApi(Request $request): void
    {
        // Get current token
        $token = $request->user()->currentAccessToken();

        if ($token) {
            // Revoke the token
            $token->delete();
        }
    }
}
