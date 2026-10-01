<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile / password.
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request, ProfileService $service)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $service->changePassword(
            $request->user(),
            $validated['current_password'],
            $validated['new_password']
        );

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully.');
    }
}
