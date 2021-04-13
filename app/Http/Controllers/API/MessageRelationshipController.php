<?php

namespace App\Http\Controllers;


use App\Message;
use App\Http\Resources\UserResource;

class MessageRelationshipController extends Controller
{
    public function author(Message $message)
    {
        return new UserResource($message->author);
    }

    public function recipient(Message $article)
    {
        return new UserResource($article->recipient);
    }
}
