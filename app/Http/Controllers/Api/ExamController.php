<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\view\view_teacher_lesson_qr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function enroll($course){
        $id = request()->user()->id;
        $qrCode = view_teacher_lesson_qr::where('student_id','=',$id)
            ->where('lesson_id','=',$course)->where('valid_till','>',Carbon::now())
            ->where('used','=',1)->get();
        if(empty($qrCode[0]->all())) {
            return response()->json(['error'=>'The QrCode Is Expirad OR Already Used'],401);
        }
        $exam = Exam::where('is_done','=',0)->where('user_id','=',$id)->get();
        if(!empty($exam[0]->all())) {
            $boolResponse = $exam[0]->course == $course ? true : false;
            return response()->json(['error'=>'You MUST Complete previous Test','course'=>Course::find($exam[0]->course),'is_same_lesson'=>$boolResponse],400);
        }

    }
}
