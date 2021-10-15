<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Snippet\StoreSnippetRequest;
use App\Http\Requests\Snippet\UpdateSnippetRequest;
use App\Http\Resources\Snippet\SnippetResource;
use App\Models\Snippet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SnippetController extends Controller
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
        //fetch files sorted by newly added
        $items = Snippet::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'items' => SnippetResource::collection($items),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSnippetRequest  $request
     * @return JsonResponse
     */
    public function store(StoreSnippetRequest $request): JsonResponse
    {
        //validate request
        $request->validated();

        $snippet = new Snippet();
        $snippet->title = $request->get('title');
        $snippet->description = $request->get('description');
        $snippet->content = $request->get('content');
        $snippet->type = Snippet::TYPE_HTML;


        if ($snippet->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new SnippetResource($snippet)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Snippet  $snippet
     * @return JsonResponse
     */
    public function show(Snippet $snippet): JsonResponse
    {
        return response()->json(new SnippetResource($snippet));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSnippetRequest  $request
     * @param  Snippet  $snippet
     * @return JsonResponse
     */
    public function update(UpdateSnippetRequest $request, Snippet $snippet): JsonResponse
    {
        //validate request
        $request->validated();

        //update resource
        $snippet->title = $request->get('title');
        $snippet->description = $request->get('description');
        $snippet->content = $request->get('content');

        //send response
        if ($snippet->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new SnippetResource($snippet)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Snippet  $snippet
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Snippet $snippet): JsonResponse
    {
        //delete the resource
        if ($snippet->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
