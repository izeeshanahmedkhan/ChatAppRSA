<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * Get the username.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getUsernameByID($id)
    {
        return User::where('id', '=', $id)
                    ->select('username')
                    ->get();
    }

    /**
     * Get all other users except the given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function allExceptUser(User $user)
    {
        return User::where('id', '!=', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}