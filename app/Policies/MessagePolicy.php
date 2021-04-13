<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can retrieve the given message.
     *
     * @param  User     $user
     * @param  Message  $message
     * @return bool
     */
    public function view(User $user, Message $message)
    {
        return $user->id === $message->user_id;
    }
}
