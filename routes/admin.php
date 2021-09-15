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
    Route::post('/fillTableTeachers',[Admin\teachersController::class,'fillTableTeachers'])->name('admin.teachers.dataTables');
});

Route::get('/{page}',[Admin\DashbordController::class,'index'])->name('page');

