<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileService
{
    /**
     * Change the user's password.
     * 
     * @throws ValidationException
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.']
            ]);
        }

        $user->update([
            'password' => bcrypt($newPassword)
        ]);

        return true;
    }
}
