<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\User;

class MessagesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => MessageResource::collection($this->collection),
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
        $author = $this->collection->flatMap(
            function ($message) {
                return $message->author;
            }
        );

        $recipient = $this->collection->flatMap(
            function ($message) {
                return $message->recipient;
            }
        );

        $included = $author->merge($recipient)->unique();

        return [
            'links' => [
                'self' => route('messages.index'),
            ],
            'included' => $this->withIncluded($included),
        ];
    }

    /**
     * Used to add meta data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function withIncluded(Collection $included)
    {
        return $included->map(
            function ($include) {
                if ($include instanceof User) {
                    return new UserResource($include);
                }
            }
        );
    }
}
