<?php

namespace App\Services;

use App\Models\File;
use App\Services\Contracts\UploaderContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class LocalUploader implements UploaderContract
{

    /**
     * uploads the given file to local storage
     * @param UploadedFile $uploadedFile file to be uploaded
     * @param File $file file to be uploaded
     * @return string returns the path saved to
     * @throws \Exception when failed to save file
     */
    public function upload(UploadedFile $uploadedFile, File $file)
    {
        $result = $uploadedFile->store('/uploads', ['disk' => 'public']);
        $file->disk = 'public';
        //check if saved successful to get a url
        if ($result){
            return URL::asset(Storage::url($result));
        }

        throw new \Exception("Failed to upload file on server");
    }
}
