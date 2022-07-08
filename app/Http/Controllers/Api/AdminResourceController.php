<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\StoreResourceRequest;
use App\Http\Requests\Resource\UpdateResourceRequest;
use App\Http\Resources\Resource\ResourceableResource;
use App\Models\File;
use App\Models\Link;
use App\Models\Resource;
use App\Models\Snippet;
use App\Services\Contracts\UploaderContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminResourceController extends Controller
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
        $items = Resource::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'items' => ResourceableResource::collection($items),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreResourceRequest  $request
     * @param  UploaderContract  $uploader
     * @return JsonResponse
     */
    public function store(StoreResourceRequest $request, UploaderContract $uploader): JsonResponse
    {
        //validate request
        $request->validated();

        //get the resource type
        $resource_type = $request->get('type');

        //prepare the main resource model
        $resource = new Resource();
        $resource->title = $request->get('title');
        $resource->description = $request->get('description');

        //create the sub resource according to the resource type
        switch ($resource_type){
            case 'File':
                $sub_resource = new File();
                //try to upload the file and in case of exception respond the error
                try {
                    $sub_resource->path = $uploader->upload($request->file('file'), $sub_resource);
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed uploading file.',
                        'exception' => $e->getMessage(),
                    ], 400);
                }
                break;

            case 'Link':
                $sub_resource = new Link();
                $sub_resource->url = $request->get('url');
                $sub_resource->open_in_new_tab = $request->boolean('open_in_new_tab');
                break;

            case 'Snippet':
                $sub_resource = new Snippet();
                $sub_resource->content = $request->get('content');
                break;
        }

        // try to save the models
        if (isset($sub_resource) && $sub_resource->save() && $sub_resource->resource()->save($resource)) {
            return response()->json(['message' => __('Data saved correctly'), 'resource' => new ResourceableResource($resource)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $file
     * @return JsonResponse
     */
    public function show(Resource $resource): JsonResponse
    {
        return response()->json(new ResourceableResource($resource));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateResourceRequest  $request
     * @param  Resource  $resource
     * @param  UploaderContract  $uploader
     * @return JsonResponse
     */
    public function update(UpdateResourceRequest $request, Resource $resource, UploaderContract $uploader): JsonResponse
    {
        //validate request
        $request->validated();

        //update the main resource model
        $resource->title = $request->get('title');
        $resource->description = $request->get('description');

        $sub_resource = $resource->resourceable;
        $resource_type = class_basename($sub_resource);

        //update sub resource according to it's type
        switch ($resource_type){
            case 'File':
                // check if we have a file to handle upload
                if ($request->hasFile('file')) {
                    //try to upload the file and in case of exception respond the error
                    try {
                        $sub_resource->path = $uploader->upload($request->file('file'), $sub_resource);
                    } catch (Exception $e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed uploading file.',
                            'exception' => $e->getMessage(),
                        ], 400);
                    }
                }
                break;
            case 'Link':
                $sub_resource->url = $request->get('url');
                $sub_resource->open_in_new_tab = $request->boolean('open_in_new_tab');
                break;

            case 'Snippet':
                $sub_resource->content = $request->get('content');
                break;
        }

        //update models in database
        if ($sub_resource->save() && $sub_resource->resource()->save($resource)) {
            return response()->json(['message' => __('Data saved correctly'), 'resource' => new ResourceableResource($resource)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Resource  $resource
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Resource $resource): JsonResponse
    {
        //delete the resource
        if ($resource->resourceable->delete() && $resource->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
