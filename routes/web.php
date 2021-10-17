<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware'=>'auth'],function (){
    Route::group(['prefix'=>'index'],function (){
        Route::view('/','dashbord.index')->name('admin.dashbord');
        Route::get('/getdata',[Admin\DashbordController::class,'index'])->name('admin.dashbord.getdata');
    });

    Route::group(['prefix'=>'course'],function (){
        Route::view('/','dashbord.courses.index')->name('admin.course.index');
        Route::view('/create','dashbord.courses.create')->name('admin.course.create');
        Route::post('/store',[Admin\CourseController::class,'store'])->name('admin.course.store');

        Route::post('/fillTableCourse',[Admin\CourseController::class,'fillTableCourses'])->name('admin.course.dataTables');

    });

    Route::group(['prefix'=>'attach'],function (){
        Route::view('/','dashbord.attach.index')->name('admin.attach.index');
        Route::view('/create','dashbord.attach.create')->name('admin.attach.create');
        Route::post('/store',[Admin\AttchController::class,'store'])->name('admin.attach.store');
        Route::post('/fillTableAttachs',[Admin\AttchController::class,'fillTableAttachs'])->name('admin.attach.dataTables');
        Route::post('/fillAttchDropdown',[Admin\AttchController::class,'fillAttchDropdown'])->name('admin.attach.dropdown');

    });

    Route::group(['prefix'=>'teachers'],function (){
        Route::view('/','dashbord.teachers.index')->name('admin.teachers.index');
        Route::view('/create','dashbord.teachers.create')->name('admin.teachers.create');
        Route::post('/fillTableTeachers',[Admin\teachersController::class,'fillTableTeachers'])->name('admin.teachers.dataTables');
    });

    Route::group(['prefix'=>'category'],function (){
        Route::view('/','dashbord.catgory.index')->name('admin.catgory.index');
        Route::view('/create','dashbord.catgory.create')->name('admin.catgory.create');
        Route::post('/fillTableCatgory',[Admin\CatgoryController::class,'fillTableCatgory'])->name('admin.catgory.dataTables');
        Route::post('/fillCategoryDropdown',[Admin\CatgoryController::class,'fillCategoryDropdown'])->name('admin.catgory.dropdown');
        Route::post('/store',[Admin\CatgoryController::class,'store'])->name('admin.catgory.store');
    });

    Route::group(['prefix'=>'about'],function (){
        Route::view('/create','dashbord.about.create');
        Route::post('/store',[Admin\AboutusController::class,'store'])->name('admin.about.store');
    });

    Route::group(['prefix'=>'notifications'],function (){
        Route::view('/','dashbord.notifications.index')->name('admin.notifications.index');
        Route::view('/create','dashbord.notifications.create')->name('admin.notifications.create');
        Route::post('/store',[\App\Http\Controllers\NotificationController::class,'store'])->name('admin.notification.store');
    });

    Route::group(['prefix'=>'students'],function (){
        Route::view('/','dashbord.students.index')->name('admin.students.index');
        Route::post('/ajax/getuser',[Admin\usersController::class,'getUser'])->name('admin.students.ajax.getuser');
    });

    Route::group(['prefix'=>'lessons'],function (){
        Route::view('/','dashbord.lessons.index')->name('admin.lessons.index');
        Route::view('/create','dashbord.lessons.create')->name('admin.lessons.create');
        Route::post('/fillTaleCourse',[Admin\CourseController::class,'fillTableCourses'])->name('admin.lessons.dataTables');
        Route::post('/fillQrCodeDropdown',[Admin\CourseController::class,'fillCourseDropdown'])->name('admin.lessons.dropdown');

    });

    Route::group(['prefix'=>'qrcode'],function (){
        Route::view('/','dashbord.qrcode.index')->name('admin.qrcode.index');
        Route::view('/create','dashbord.qrcode.create')->name('admin.qrcode.create');
        Route::post('/store',[Admin\QrCodeController::class,'store'])->name('admin.qrcode.store');
    });
});
