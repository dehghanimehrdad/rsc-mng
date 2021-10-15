<?php

namespace App\Http\Resources\Snippet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Snippet extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \App\Models\Snippet $snippet */
        $snippet = $this;
        return [
            'id' => $snippet->id,
            'title' => $snippet->title,
            'description' => $snippet->description,
            'content' => $snippet->content,
            'type' => $snippet->type,
            'created_at' => $snippet->created_at->toISOString(),
            'updated_at' => $snippet->updated_at->toISOString(),
        ];
    }
}
