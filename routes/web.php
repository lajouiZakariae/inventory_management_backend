<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard/{path?}', function () {
    return view('app');
})->where('path', '.*');

// Route::post('/login', function () {
//     if (Auth::attempt(['email' => request()->email, 'password' => request()->password])) {
//         session()->regenerate();
//     }
// });
