<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\Link\LinkResource;
use App\Http\Resources\Snippet\SnippetResource;
use App\Models\File;
use App\Models\Link;
use App\Models\Snippet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        //fetch resources sorted by newly added
        $files = File::orderBy('created_at', 'DESC')->get();
        $links = Link::orderBy('created_at', 'DESC')->get();
        $snippets = Snippet::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'files' => FileResource::collection($files),
            'links' => LinkResource::collection($links),
            'snippets' => SnippetResource::collection($snippets),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return JsonResponse
     */
    public function getSnippet($id): JsonResponse
    {
        //fetch snippet from database
        $snippet = Snippet::findOrFail($id);
        return response()->json(new SnippetResource($snippet));
    }
}
