<?php

use App\Enums\Platforms;
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
    Route::apiResource('payment-methods', App\Http\Controllers\Admin\PaymentMethodController::class);

    Route::apiResource('stores', App\Http\Controllers\Admin\StoreController::class);

    Route::get('settings/{setting:platform}', [App\Http\Controllers\Admin\SettingController::class, 'show'])
        ->name('settings.show')
        ->whereIn("platform", array_column(Platforms::cases(), 'value'));

    Route::put('settings/{setting:platform}', [App\Http\Controllers\Admin\SettingController::class, 'update'])
        ->name('settings.update');
});
