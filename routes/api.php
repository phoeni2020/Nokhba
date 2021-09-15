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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    Route::post('signup',[\App\Http\Controllers\Api\User\authController::class,'signUp'])->name('api.user.signup');
    Route::post('login',[\App\Http\Controllers\Api\User\authController::class,'signIn'])->name('api.user.signin');

    Route::group(['middleware' => ['auth:sanctum']],function (){
        Route::prefix('user')->group(function (){
            Route::get('/',[\App\Http\Controllers\Api\User\userController::class,'show']);
            Route::put('/completeData',[\App\Http\Controllers\Api\User\userController::class,'completeData']);
        });
        Route::prefix('teacher')->group(function (){
            Route::post('/index',[\App\Http\Controllers\Api\teachersController::class,'index']);
            //Route::put('/completeData',[\App\Http\Controllers\Api\User\userController::class,'completeData']);
        });

    });
});
