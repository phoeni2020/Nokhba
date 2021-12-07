<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Models\QrCode;
use App\Models\Teachers;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{
    use Teacher;

    public function index()
    {
        $viewObjectToUse = DB::table('view_teacher_lesson_qrs');
        $id = $this->getTeacherId();
        $belongsTeacher = $viewObjectToUse->where('teacherid', '=', $id['teacher']);
        $usedQrCount = $belongsTeacher->where('used', '=', 1)->count('user_id');
        $countStudentsBelongsTeacher = $belongsTeacher->distinct()->count('user_id');
        $countLessonsBelongsTeacher = $belongsTeacher->distinct()->count('lesson_id');
        $platformSales = QrCode::sum('price');
        $teacherQrCodesSlaes = QrCode::where('teacher_id', '=', $id['user_id'])->sum('price');
        $totalTeachers = Teachers::sum('id');
        return response()->json(
            [
                'totalTeachers' => $totalTeachers,
                'usedQrCount' => $usedQrCount,
                'platformSales' => $platformSales,
                'studentCount' => $countStudentsBelongsTeacher,
                'countLessons' => $countLessonsBelongsTeacher,
                'qrcodeSales' => $teacherQrCodesSlaes,
            ]);
    }
}
