<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{
    use Teacher;

    public function index()
    {
        $viewObjectToUse = DB::table('view_teacher_lesson_qrs');
        $id = $this->getTeacherId();
        $belongsTeacher = $viewObjectToUse->where('teacherid', '=', $id);
        $usedQrCount = $belongsTeacher->where('used', '=', 1)->count('user_id');
        $countStudentsBelongsTeacher = $belongsTeacher->distinct()->count('user_id');
        $countLessonsBelongsTeacher = $belongsTeacher->distinct()->count('lesson_id');
        return response()->json(['usedQrCount' => $usedQrCount,'studentCount'=>$countStudentsBelongsTeacher,'countLessons'=>$countLessonsBelongsTeacher]);
    }
}
