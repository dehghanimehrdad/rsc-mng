<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;
use App\Http\Resources\File\FileResource;
use App\Models\File;
use App\Services\Contracts\UploaderContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
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
        $items = File::orderBy('created_at', 'DESC')->get();

        // return json response using resource
        return response()->json([
            'items' => FileResource::collection($items),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFileRequest  $request
     * @param  UploaderContract  $uploader
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request, UploaderContract $uploader): JsonResponse
    {
        //validate request
        $request->validated();

        $file = new File();
        $file->title = $request->get('title');

        // check if we have a file to handle upload
        if ($request->hasFile('file')) {

            //try to upload the file and in case of exception respond the error
            try {
                $file->path = $uploader->upload($request->file('file'), $file);
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed uploading file.',
                    'exception' => $e->getMessage(),
                ], 400);
            }
        }

        if ($file->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new FileResource($file)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  File  $file
     * @return JsonResponse
     */
    public function show(File $file): JsonResponse
    {
        return response()->json(new FileResource($file));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFileRequest  $request
     * @param  File  $file
     * @param  UploaderContract  $uploader
     * @return JsonResponse
     */
    public function update(UpdateFileRequest $request, File $file, UploaderContract $uploader): JsonResponse
    {
        //validate request
        $request->validated();

        $file->title = $request->get('title');

        // check if we have a file to handle upload
        if ($request->hasFile('file')) {
            //try to upload the file and in case of exception respond the error
            try {
                $file->path = $uploader->upload($request->file('file'), $file);
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed uploading file.',
                    'exception' => $e->getMessage(),
                ], 400);
            }
        }

        if ($file->save()) {
            return response()->json(['message' => __('Data saved correctly'), 'file' => new FileResource($file)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  File  $file
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(File $file): JsonResponse
    {
        //delete the resource
        if ($file->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
