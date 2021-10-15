<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreLinkRequest;
use App\Http\Requests\Link\UpdateLinkRequest;
use App\Http\Resources\Link\LinkResource;
use App\Models\Link;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
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
        //fetch links sorted by newly added
        $items = Link::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'items' => LinkResource::collection($items),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLinkRequest  $request
     * @return JsonResponse
     */
    public function store(StoreLinkRequest $request): JsonResponse
    {
        //validate request
        $request->validated();

        $link = new Link();
        $link->title = $request->get('title');
        $link->url = $request->get('url');
        $link->open_in_new_tab = $request->boolean('open_in_new_tab');

        if ($link->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new LinkResource($link)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  Link  $link
     * @return JsonResponse
     */
    public function show(Link $link): JsonResponse
    {
        return response()->json(new LinkResource($link));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLinkRequest  $request
     * @param  Link  $link
     * @return JsonResponse
     */
    public function update(UpdateLinkRequest $request, Link $link): JsonResponse
    {
        //validate request
        $request->validated();

        //update resource
        $link->title = $request->get('title');
        $link->url = $request->get('url');
        $link->open_in_new_tab = $request->boolean('open_in_new_tab');

        //send response
        if ($link->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new LinkResource($link)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Link  $link
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Link $link): JsonResponse
    {
        //delete the resource
        if ($link->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
