<?php

namespace App\Http\Resources\Link;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Link $link */
        $link = $this;
        return [
            'id' => $link->id,
            'title' => $link->title,
            'url' => $link->url,
            'open_in_new_tab' => $link->open_in_new_tab,
            'created_at' => $link->created_at->toISOString(),
            'updated_at' => $link->updated_at->toISOString(),
        ];
    }
}
