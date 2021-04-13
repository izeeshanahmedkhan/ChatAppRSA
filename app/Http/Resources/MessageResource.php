<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'type' => 'message',
            'id' => (string) $this->id,
            'attributes' => [
                'content' => $this->content,
                'date' => $this->created_at,
            ],
            'relationships' => new MessageRelationshipResource($this),
            'links' => [
                'self' => route('messages.show', ['message' => $this->id]),
            ],
        ];
    }
}
