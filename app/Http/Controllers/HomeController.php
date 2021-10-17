<?php

namespace App\Http\Controllers;

use App\Http\Controllers\triats\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use Teacher;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $viewObjectToUse = DB::table('view_teacher_lesson_qrs');
       // $id = $this->getTeacherId();
        $usedQrBelongsTeacher = $viewObjectToUse->where('teacher','=',$id)->where('used','=',1);
        $countQr = $usedQrBelongsTeacher->select('count(`id`)');
        //$timesEnrollesToLessons = $timesEnrollesToLessons->select('DISTINCT student_id');
    }
}
