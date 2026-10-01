<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request, AuthService $authService)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        $authService->webLogin($credentials, $remember);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request, AuthService $authService)
    {
        $authService->webLogout();

        return redirect('/');
    }
}
