<?php

namespace App\Http\Resources\Resource;

use App\Models\File;
use App\Models\Link;
use App\Models\Resource;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Resource $resource */
        $resource = $this;
        return [
            'id' => $resource->id,
            'title' => $resource->title,
            'description' => $resource->description,
            'content' => $this->when(get_class($resource->resourceable) == Snippet::class, $resource->resourceable->content),
            'file_url' => $this->when(get_class($resource->resourceable) == File::class, $resource->resourceable->path),
            'url' => $this->when(get_class($resource->resourceable) == Link::class, $resource->resourceable->url),
            'open_in_new_tab' => $this->when(get_class($resource->resourceable) == Link::class, $resource->resourceable->open_in_new_tab),
            'type' => class_basename($resource->resourceable),
            'created_at' => $resource->created_at->toISOString(),
            'updated_at' => $resource->updated_at->toISOString(),
        ];
    }
}
