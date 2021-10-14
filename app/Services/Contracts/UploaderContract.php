<?php

namespace App\Services\Contracts;

use App\Models\File;
use Illuminate\Http\UploadedFile;

/**
 *
 * to abstract the uploader so we can change the uploading service
 * Interface UploaderContract
 * @package App\Services\Contracts
 */
interface UploaderContract {
    /**
     * uploading the file to server or third party storage
     * @param UploadedFile $uploadedFile file to be uploaded
     * @param File $file file model so we can set the disk according to uploader service
     * @return mixed
     */
    public function upload(UploadedFile $uploadedFile, File $file);
}
