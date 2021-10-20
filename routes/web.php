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

    /**
     * DashBoard Index
     * Routes Ajax Request's
     */
    Route::group(['prefix'=>'index'],function (){
        Route::view('/','dashbord.index')->name('admin.dashbord');
        Route::get('/getdata',[Admin\DashbordController::class,'index'])->name('admin.dashbord.getdata');
    });

    /**
     * Category Routes
     * Add , Update ,Delete , View , DataTable
     */
    Route::group(['prefix'=>'category'],function (){
        Route::view('/','dashbord.catgory.index')->name('admin.catgory.index');
        Route::view('/create','dashbord.catgory.create')->name('admin.catgory.create');

        Route::post('/fillTableCatgory',[Admin\CatgoryController::class,'fillTableCatgory'])->name('admin.catgory.dataTables');
        Route::post('/fillCategoryDropdown',[Admin\CatgoryController::class,'fillCategoryDropdown'])->name('admin.catgory.dropdown');
        Route::post('/store',[Admin\CatgoryController::class,'store'])->name('admin.catgory.store');

        Route::get('/edit/{category}',[Admin\CatgoryController::class,'edit'])->name('admin.category.edit');
        Route::put('/update/{catgory}',[Admin\CatgoryController::class,'update'])->name('admin.category.update');
        Route::delete('/delete/{category}',[Admin\CatgoryController::class,'destroy'])->name('admin.category.delete');

    });

    /**
     * Course Routes
     * Add , Update ,Delete , View , DataTable
     */
    Route::group(['prefix'=>'course'],function (){
        Route::view('/','dashbord.courses.index')->name('admin.course.index');
        Route::view('create','dashbord.courses.create')->name('admin.course.create');

        Route::post('store',[Admin\CourseController::class,'store'])->name('admin.course.store');
        Route::post('fillTableCourse',[Admin\CourseController::class,'fillTableCourses'])->name('admin.course.dataTables');
        Route::post('/fillQrCodeDropdown',[Admin\CourseController::class,'fillCourseDropdown'])->name('admin.course.dropdown');

        Route::get('edit/{course}',[Admin\CourseController::class,'edit'])->name('admin.course.edit');
        Route::put('update/{course}',[Admin\CourseController::class,'update'])->name('admin.course.update');
        Route::delete('delete/{course}',[Admin\CourseController::class,'destroy'])->name('admin.course.delete');

    });

    Route::group(['prefix'=>'exams'],function (){
        Route::view('/','dashbord.exams.index')->name('admin.exam.index');
        Route::post('/fillTableExams',[Admin\ExamController::class,'fillTableExams'])->name('admin.exam.datatable');
        Route::group(['prefix'=>'question'],function (){
               Route::view('/create','dashbord.exams.question.create')->name('admin.exam.question.create');
        });
    });

    Route::group(['prefix'=>'qrcode'],function (){
        Route::view('/','dashbord.qrcode.index')->name('admin.qrcode.index');
        Route::view('/create','dashbord.qrcode.create')->name('admin.qrcode.create');
        Route::view('/used','dashbord.qrcode.used')->name('admin.used.qrCode');
        Route::post('/fillTableQrCode',[Admin\QrCodeController::class,'fillTableQrCode'])->name('admin.qrCode.dataTables');
        Route::post('/fillTableUsedQrCode',[Admin\QrCodeController::class,'fillTableUsedQrCode'])->name('admin.qrUsedCode.dataTables');
        Route::post('/store',[Admin\QrCodeController::class,'store'])->name('admin.qrcode.store');
    });

    Route::group(['prefix'=>'attach'],function (){
        Route::view('/','dashbord.attach.index')->name('admin.attach.index');
        Route::view('/create','dashbord.attach.create')->name('admin.attach.create');
        Route::post('/store',[Admin\AttchController::class,'store'])->name('admin.attach.store');
        Route::post('/fillTableAttachs',[Admin\AttchController::class,'fillTableAttachs'])->name('admin.attach.dataTables');
        Route::post('/fillAttchDropdown',[Admin\AttchController::class,'fillAttchDropdown'])->name('admin.attach.dropdown');

    });

    Route::group(['prefix'=>'notifications'],function (){
        Route::view('/','dashbord.notifications.index')->name('admin.notifications.index');
        Route::view('/create','dashbord.notifications.create')->name('admin.notifications.create');
        Route::post('/store',[\App\Http\Controllers\NotificationController::class,'store'])->name('admin.notification.store');
    });

    Route::group(['prefix'=>'students'],function (){
        Route::view('/','dashbord.students.index')->name('admin.students.index');
        Route::delete('/destroy/{user}',[Admin\usersController::class,'destroy'])->name('admin.user.delete');
        Route::post('/view/{user}',[Admin\usersController::class,'destroy'])->name('admin.user.view');
        Route::post('/ajax/getuser',[Admin\usersController::class,'getUser'])->name('admin.students.ajax.getuser');
        Route::post('/fillTableUsers',[Admin\usersController::class,'fillTableUser'])->name('admin.students.fillTableUser');
    });

    Route::group(['prefix'=>'teachers'],function (){
        Route::get('/settings',[Admin\teachersController::class,'settingPage'])->name('admin.teachers.settings');
        Route::put('/update/{teacher}',[Admin\teachersController::class,'teacherSettings'])->name('admin.teachers.update');
        Route::post('/fillTableTeachers',[Admin\teachersController::class,'fillTableTeachers'])->name('admin.teachers.dataTables');
    });

    Route::group(['prefix'=>'about'],function (){
        Route::view('/create','dashbord.about.create');
        Route::post('/store',[Admin\AboutusController::class,'store'])->name('admin.about.store');
    });
});
Route::get('/{page}',[\App\Http\Controllers\HomeController::class,'page']);
