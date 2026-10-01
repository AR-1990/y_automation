<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * Get paginated users with sorting.
     */
    public function getPaginatedUsers($request): LengthAwarePaginator
    {
        return User::query()
            ->orderBy($request->sort_by ?? 'id', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 10);
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        
        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function updateUser(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        
        return $user;
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
