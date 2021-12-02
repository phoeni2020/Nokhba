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

Route::get('/restPasswords/student')->name('resetpassword.api');

Route::group(['middleware'=>'auth'],function (){
    Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

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
        Route::view('/create','dashbord.exams.create')->name('admin.exam.create');
        Route::post('/fillTableExams',[Admin\ExamController::class,'fillTableExams'])->name('admin.exam.datatable');
        Route::post('/post',[Admin\ExamController::class,'store'])->name('admin.exam.store');

        Route::group(['prefix'=>'question'],function (){
               Route::view('/','dashbord.exams.question.index')->name('admin.exam.question.index');
               Route::view('/create','dashbord.exams.question.create')->name('admin.exam.question.create');
               Route::post('/post',[Admin\ExamController::class,'storeQuestion'])->name('admin.exam.question.store');
               Route::post('/fillTableExams',[Admin\ExamController::class,'fillTableQuestion'])->name('admin.exam.question.fillTableQuestion');
               Route::get('/edit/{question}',[Admin\ExamController::class,'edit'])->name('admin.exam.question.edit');
               Route::put('/update/{question}',[Admin\ExamController::class,'update'])->name('admin.exam.question.update');
        });
    });

    /**
     * Qr Code Routes
     */
    Route::group(['prefix'=>'qrcode'],function (){
        Route::view('/','dashbord.qrcode.index')->name('admin.qrcode.index');
        Route::view('/create','dashbord.qrcode.create')->name('admin.qrcode.create');
        Route::view('/used','dashbord.qrcode.used')->name('admin.used.qrCode');
        Route::get('/pdf',[Admin\QrCodeController::class,'loadPdf'])->name('admin.qrCode.pdf');
        Route::post('/fillTableQrCode',[Admin\QrCodeController::class,'fillTableQrCode'])->name('admin.qrCode.dataTables');
        Route::post('/fillTableUsedQrCode',[Admin\QrCodeController::class,'fillTableUsedQrCode'])->name('admin.qrUsedCode.dataTables');
        Route::post('/store',[Admin\QrCodeController::class,'store'])->name('admin.qrcode.store');
    });

    /**
     *
     */
    Route::group(['prefix'=>'attach'],function (){
        Route::view('/','dashbord.attach.index')->name('admin.attach.index');
        Route::view('/create','dashbord.attach.create')->name('admin.attach.create');
        Route::post('/store',[Admin\AttchController::class,'store'])->name('admin.attach.store');
        Route::post('/fillTableAttachs',[Admin\AttchController::class,'fillTableAttachs'])->name('admin.attach.dataTables');
        Route::post('/fillAttchDropdown',[Admin\AttchController::class,'fillAttchDropdown'])->name('admin.attach.dropdown');

    });

    /**
     *
     */
    Route::group(['prefix'=>'notifications'],function (){
        Route::view('/','dashbord.notifications.index')->name('admin.notifications.index');
        Route::view('/create','dashbord.notifications.create')->name('admin.notifications.create');
        Route::post('/fillTableNotifications',[\App\Http\Controllers\NotificationController::class,'fillTableNotifications'])->name('admin.notifications.fillTableNotifications');
        Route::post('/store',[\App\Http\Controllers\NotificationController::class,'store'])->name('admin.notification.store');
    });

    /**
     *
     */
    Route::group(['prefix'=>'students'],function (){
        Route::view('/','dashbord.students.index')->name('admin.students.index');

        Route::delete('/destroy/{user}',[Admin\usersController::class,'destroy'])->name('admin.user.delete');

        Route::get('/view/{user}',[Admin\usersController::class,'viewUser'])->name('admin.user.view');
        //Route::get('/view/{user}',[Admin\usersController::class,'destroy'])->name('admin.user.view');

        Route::post('/ajax/getuser',[Admin\usersController::class,'getUser'])->name('admin.students.ajax.getuser');
        Route::post('/fillTableUsers',[Admin\usersController::class,'fillTableUser'])->name('admin.students.fillTableUser');
        Route::post('/fillTableUsersQr',[Admin\usersController::class,'userQrCodes'])->name('admin.students.fillTableExams');
    });

    /**
     *
     */
    Route::group(['prefix'=>'teachers'],function (){
        Route::view('/','dashbord.teachers.index')->name('admin.teachers.index');
        Route::delete('/ban/{teacher}',[Admin\teachersController::class,'banTeacher'])->name('admin.teachers.delete');
        Route::view('/add/assitant','dashbord.teachers.asstitant.create')->name('admin.add.assitant');
        Route::post('/store/assitant',[Admin\teachersController::class,'addAssitant'])->name('admin.store.assitant');
        Route::get('/settings',[Admin\teachersController::class,'settingPage'])->name('admin.teachers.settings');
        Route::put('/update',[Admin\teachersController::class,'teacherSettings'])->name('admin.teachers.update.settings');
        Route::post('/fillTableTeachers',[Admin\teachersController::class,'fillTableTeachers'])->name('admin.teachers.dataTables');
        Route::prefix('urls')->group(function (){
            Route::view('/','dashbord.teachers.links.index')->name('admin.teachers.links.index');
            Route::view('/create','dashbord.teachers.links.create')->name('admin.teachers.links.add');
            Route::post('/fillTableLinks',[Admin\teachersController::class,'linksPage'])->name('admin.teachers.links.dataTables');
            Route::post('/stroe',[Admin\teachersController::class,'storeLink'])->name('admin.teahcer.link.store');
            Route::put('/urls/{teacher}',[Admin\teachersController::class,'teacherSettings'])->name('admin.teachers.update');
            Route::delete('/urls/{link}',[Admin\teachersController::class,'destroyLink'])->name('admin.teachers.delete');
        });
        Route::prefix('center')->group(function (){
            Route::view('/','dashbord.teachers.center.index')->name('admin.teachers.center.index');
            Route::view('/create','dashbord.teachers.center.create')->name('admin.center.center.add');
            Route::post('/fillTableCenter',[Admin\CentersController::class,'fillTableCenter'])->name('admin.teachers.center.dataTables');
            Route::post('/store',[Admin\CentersController::class,'store'])->name('admin.teahcer.center.store');
            Route::put('/{center}',[Admin\CentersController::class,'update'])->name('admin.teachers.center.update');
            Route::delete('/{center}',[Admin\CentersController::class,'destroy'])->name('admin.teachers.center.delete');
            Route::get('/{center}',[Admin\CentersController::class,'show'])->name('admin.teachers.center.show');
            Route::post('/fillCenterDropdown',[Admin\CentersController::class,'fillCenterDropdown'])->name('admin.center.dropdown');

        });
    });

    /**
     *
     */
    Route::group(['prefix'=>'about'],function (){
        Route::view('/create','dashbord.about.create');
        Route::post('/store',[Admin\AboutusController::class,'store'])->name('admin.about.store');
    });

    Route::group(['prefix'=>'app'],function (){
        Route::get('/',[Admin\AboutusController::class,'store'])->name('admin.app.settings');
        Route::get('/developer/settings',[Admin\AppSettingsController::class,'index'])->name('admin.app.developer.settings');
        Route::post('/developer/settings',[Admin\AppSettingsController::class,'store'])->name('admin.app.developer.settings.store');
        Route::post('/store',[Admin\AboutusController::class,'store'])->name('admin.about.store');
    });
});

Route::get('/{page}',[\App\Http\Controllers\HomeController::class,'page']);
