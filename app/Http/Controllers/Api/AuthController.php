<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Handle the login request.
     */
    public function login(Request $request, AuthService $authService): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = $authService->login($credentials);

        return response()->json([
            'message' => 'Login successful',
            'data' => $result,
        ]);
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request->user());

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get the authenticated user.
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }
}
