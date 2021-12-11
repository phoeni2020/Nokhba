<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Models\Center;
use App\Models\QrCode;
use App\Models\Teachers;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{
    use Teacher;

    public function Dashbord()
    {
        $id = $this->getTeacherId();
        $topLessons = DB::table('qr_codes')
            ->select(DB::raw('count(qr_codes.id) as `count`'), 'courses.title')
            ->join('courses', 'courses.id', '=', 'qr_codes.lesson')
            ->where('teacher_id', '=', $id['user_id'])
            ->where('used', '=', 1)
            ->groupby('lesson')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
        return view('dashbord.index')->with(['topLessons' => $topLessons->toArray()]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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
