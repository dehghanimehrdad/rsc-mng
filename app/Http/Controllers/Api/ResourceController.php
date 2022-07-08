<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Resource\ResourceableResource;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $resources = Resource::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'resources' => ResourceableResource::collection($resources),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $resource
     * @return JsonResponse
     */
    public function show(Resource $resource): JsonResponse
    {
        return response()->json(new ResourceableResource($resource));
    }
}
