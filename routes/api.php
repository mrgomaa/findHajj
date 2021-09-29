<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('omra_requests', App\Http\Controllers\API\omra_requestAPIController::class);
});


Route::post('/auth/register',[App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/login',[App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');




Route::resource('nations', App\Http\Controllers\API\NationAPIController::class);
