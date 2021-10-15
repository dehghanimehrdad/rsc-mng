<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\FileController as AdminFileController;
use App\Http\Controllers\Api\Admin\SnippetController as AdminSnippetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'admin'], static function () {
    Route::apiResource('files', AdminFileController::class);
    Route::apiResource('snippets', AdminSnippetController::class);
});


