<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminResourceController as AdminResourceController;

use App\Http\Controllers\Api\ResourceController as ResourceController;

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
    Route::apiResource('resources', AdminResourceController::class);
});
Route::apiResource('resources', ResourceController::class, ['only' => ['index', 'show']]);
