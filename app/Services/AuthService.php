<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Handle user login.
     *
     * @param array $credentials
     * @return array
     * @throws ValidationException
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            // Validation response in custom keyed format as per user preference
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Handle user logout.
     *
     * @param User $user
     * @return bool
     */
    public function logout(User $user): bool
    {
        // Revoke the token that was used to authenticate the current request...
        $user->currentAccessToken()->delete();

        return true;
    }

    /**
     * Handle web-based login using sessions.
     *
     * @param array $credentials
     * @param bool $remember
     * @return bool
     * @throws ValidationException
     */
    public function webLogin(array $credentials, bool $remember = false): bool
    {
        if (\Illuminate\Support\Facades\Auth::attempt($credentials, $remember)) {
            session()->regenerate();
            return true;
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Handle web-based logout.
     *
     * @return void
     */
    public function webLogout(): void
    {
        \Illuminate\Support\Facades\Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
