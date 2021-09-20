<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\User as User;
use \App\Http\Controllers\Api as Api;


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
    Route::post('signup',[User\authController::class,'signUp'])->name('api.user.signup');
    Route::post('login',[User\authController::class,'signIn'])->name('api.user.signin');
    Route::post('forgotPassword', [User\userController::class,'getResetToken']);
    Route::prefix('teacher')->group(function (){
        Route::post('/index',[Api\teachersController::class,'index']);
        //Route::put('/completeData',[User\userController::class,'completeData']);
    });
    Route::group(['middleware' => ['auth:sanctum']],function (){
        Route::prefix('user')->group(function (){
            Route::get('/',[User\userController::class,'show']);
            Route::put('/completeData',[User\userController::class,'completeData']);
            Route::put('/update',[User\userController::class,'update']);
            Route::put('/updatePassword',[User\userController::class,'changePassword']);
            Route::delete('/destroy/{id}',[User\userController::class,'destroy']);
        });
    });
});

