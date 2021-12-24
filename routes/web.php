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
Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index']);
Route::get('/teacher/{teacher}', [\App\Http\Controllers\Front\HomeController::class, 'teacherCategories'])->name('teacher.profile');
Route::get('/lesson/{course}', [\App\Http\Controllers\Front\HomeController::class, 'lessonCourse'])->name('teacher.course');

Route::get('exam/{id}', [App\Http\Controllers\Front\HomeController::class, 'getExamPage'])->name('examPage');
Route::get('exam/result/{exam}', [App\Http\Controllers\Front\HomeController::class, 'examResults'])->name('resultExam');
Route::post('studentExams/{id}', [App\Http\Controllers\Front\HomeController::class, 'fillTableStudentExams'])->name('getExams');

Route::get('page/{page}', [\App\Http\Controllers\HomeController::class, 'page']);
//Route::view('/email/verify/success', 'front.mailDone');
