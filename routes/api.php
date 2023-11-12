<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


//___User Route___
Route::group(['prefix' =>'user', 'middleware'=>'auth:sanctum'], function(){
    Route::get('/profile', [UserController::class, 'profileUser']);
    Route::post('/profile/update', [UserController::class, 'profileUpdate']);
    Route::post('/password/update', [UserController::class, 'userPasswordUpdate']);
    Route::get('/logout', [UserController::class, 'userLogout']);
});
