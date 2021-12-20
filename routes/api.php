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
Route::prefix('v1')->group(function (){
    Route::post('signup',[User\authController::class,'signUp'])->name('api.user.signup');
    Route::post('login',[User\authController::class,'signIn'])->name('api.user.signin');
    Route::post('forgotPassword', [User\userController::class,'getResetToken']);
    Route::get('about', [Api\AboutusController::class,'index']);
    Route::prefix('teacher')->group(function (){
        Route::post('/index',[Api\teachersController::class,'index']);
    });

    Route::prefix('category')->group(function (){
        Route::get('/{id}',[Api\CategoryController::class,'getCategories']);
    });

    Route::group(['middleware' => ['auth:sanctum']],function (){

        Route::post('enroll/{course}', [Api\ExamController::class, 'enroll']);
        Route::get('views/{course}/{vedio}', [Api\teachersController::class, 'courseViews']);
        Route::prefix('user')->group(function (){
            Route::get('/',[User\userController::class,'show']);
            Route::put('/completeData',[User\userController::class,'completeData']);
            Route::put('/update',[User\userController::class,'update']);
            Route::put('/updatePassword',[User\userController::class,'changePassword']);
            Route::delete('/destroy/{id}',[User\userController::class,'destroy']);
            Route::get('/logout', [User\userController::class, 'logOut']);
            Route::post('/firebase', [User\userController::class, 'updateFireBase']);
        });

        Route::prefix('qrcode')->group(function (){
            Route::post('/',[Api\QrController::class,'index']);
            Route::post('/show',[Api\QrController::class,'showUpdate']);
        });

        Route::prefix('links')->group(function (){
            Route::get('/',[Api\QrController::class,'index']);
            Route::post('/show',[Api\QrController::class,'showUpdate']);
        });

        Route::prefix('follow')->group(function (){
            Route::post('/',[Api\FollowingController::class,'followUnfollow']);
        });

        Route::prefix('chat')->group(function (){
            Route::post('/store/{teacher}', [Api\MassagesController::class, 'store']);
            Route::post('/get/{teacher}', [Api\MassagesController::class, 'index']);
        });

        Route::prefix('exam')->group(function () {
            Route::get('/{course}', [Api\ExamController::class, 'getExam'])->name('getExam');
            Route::post('/answer/{exam}', [Api\ExamController::class, 'answerExam']);
        });
    });

    // Verify email
    Route::get('/email/verify/{id}/{hash}', [Api\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

// Resend link to verify email
    Route::post('/email/verify/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

    Route::post('notifications/{start}/{limit}', [Api\NotificationController::class, 'index']);
});


