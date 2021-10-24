<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\view\view_teacher_lesson_qr;
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * @param $course
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function enroll($course){
        try {
            $id = request()->user()->id;
            $qrCode = view_teacher_lesson_qr::where('student_id','=',$id)
                ->where('lesson_id','=',$course)->where('valid_till','>',Carbon::now());
            if(empty($qrCode->where('used','=',1)->get()->all())) {
                return response()->json(['error'=>'The QrCode Is Expirad OR You Never Enorlled In That Lesson'],402);
            }
            $exam = Exam::where('is_done','=',0)->where('user_id','=',$id)->get();
            if(!empty($exam[0]->all())) {
                $boolResponse = $exam[0]->course == $course ? true : false;
                return response()->json(['error'=>'You MUST Complete previous Test','course'=>Course::find($exam[0]->course),'is_same_lesson'=>$boolResponse],403);
            }
            return  response()->json(['massage'=>'Good To Start']);
        }
        catch (\Exception $e) {
        }
    }
}
