<?php

use App\Enums\Platforms;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin'], function () {

    Route::apiResources([
        'payment-methods' => App\Http\Controllers\Admin\PaymentMethodController::class,
        'stores' => App\Http\Controllers\Admin\StoreController::class,
    ]);

    Route::apiResource('settings', \App\Http\Controllers\Admin\SettingController::class)->only('show', 'update');

    // Route::apiResource('media', App\Http\Controllers\Admin\MediaController::class);
});
