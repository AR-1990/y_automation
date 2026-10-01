<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserService $service)
    {
        return view('settings.users.index', [
            'users' => $service->getPaginatedUsers($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserService $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $service->createUser($validated);

        return redirect()->route('settings.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('settings.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, UserService $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $service->updateUser($user, $validated);

        return redirect()->route('settings.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserService $service)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('settings.users.index')->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $service->deleteUser($user);

        return redirect()->route('settings.users.index')->with('success', 'User deleted successfully.');
    }
}
