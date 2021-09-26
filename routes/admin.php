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
//Auth::routes();
Route::view('dashboard','dashbord.index');
Route::group(['prefix'=>'course'],function (){
    Route::view('/','dashbord.courses.index')->name('admin.course.index');
    Route::post('/fillTableCourse',[Admin\CourseController::class,'fillTableCourses'])->name('admin.course.dataTables');
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


