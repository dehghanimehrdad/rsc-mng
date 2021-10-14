<?php

namespace App\Providers;

use App\Services\LocalUploader;
use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * We use this tp change the upload logic easily
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Contracts\UploaderContract', function ($app) {
            // bind our local uploader service, if we have any other uploader services we can add here with conditions
            return new LocalUploader();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
