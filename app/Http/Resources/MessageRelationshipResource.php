<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'author' => [
                'links' => [
                    'self' => route('messages.relationships.author', ['message' => $this->id]),
                    'related' => route('messages.author', ['message' => $this->id]),
                ],
                'data' => new UserIdentifierResource($this->author),
            ],
            'recipient' => [
                'links' => [
                    'self' => route('messages.relationships.recipient', ['message' => $this->id]),
                    'related' => route('messages.recipient', ['message' => $this->id]),
                ],
                'data' => new UserIdentifierResource($this->recipient),
            ],
        ];
    }

    /**
     * Used to add meta data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('messages.index'),
            ],
        ];
    }
}
