<?php

namespace App\Repositories;

use App\User;
use App\Message;
use Illuminate\Support\Facades\DB;

class MessageRepository
{   
    /**
     * Insert a message.
     *
     * @param  User  $user
     * @return Collection
     */
    public function insert(Message $message)
    {
        return $message->save();
    }

    /**
     * Displays all messages
     *
     * @param  User  $user
     * @return Collection
     */
    public function all()
    {
        return Message::all();
    }

    /**
     * Get all of the messages sent by a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function byUser(User $user)
    {
        return Message::where('author_id', $user->id)
                    ->join('users','recipient_id','=','users.id')
                    ->select('messages.*', DB::raw('users.username as recipient'))
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the messages received by a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Message::where('recipient_id', $user->id)
                    ->join('users','author_id','=','users.id')
                    ->select('messages.*', DB::raw('users.username as author'))
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the messages between two given users.
     *
     * @param  User  $user1
     * @param  User  $user2
     * @return Collection
     */
    public function betweenUsers(User $user1, User $user2)
    {
        return Message::where(function($query) use ($user1, $user2) {
                        $query->where('author_id', $user1->id)
                            ->where('recipient_id', $user2->id);
                    })
                    ->orWhere(function($query) use ($user1, $user2) {
                        $query->where('author_id', $user2->id)
                            ->where('recipient_id', $user1->id);
                    })
                    ->join('users', 'author_id', '=', 'users.id')
                    ->select('messages.*', 'users.username')
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get the latest messages for a given users.
     *
     * @param  User  $user
     * @return Collection
     */
    public function latestForUser(User $user)
    {
        $latest_sent = Message::where('author_id', $user->id)
                            ->join('users as author','author_id','=', 'author.id')
                            ->join('users as recipient','recipient_id','=', 'recipient.id')
                            ->select('content', 'messages.created_at', 
                                DB::raw('recipient_id as connected_user_id'), 
                                DB::raw('recipient.username as connected_user'), 
                                DB::raw('author.username as author'), 
                                DB::raw('recipient.username as recipient')
                            );

        $latest_received = Message::where('recipient_id', $user->id)
                            ->join('users as author','author_id','=', 'author.id')
                            ->join('users as recipient','recipient_id','=', 'recipient.id')
                            ->select('content', 'messages.created_at', 
                                DB::raw('author_id as connected_user_id'), 
                                DB::raw('author.username as connected_user'), 
                                DB::raw('author.username as author'), 
                                DB::raw('recipient.username as recipient')
                            );

        return $latest_sent->union($latest_received)
                        ->orderBy('created_at', 'asc')
                        ->get()
                        ->keyBy('connected_user_id');
    }
}