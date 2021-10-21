<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        if(empty($qrCode->all())) {
            return response()->json(['error'=>'The QrCode Is Expirad OR Already Used'],401);
        }
        $Exam = Exam::where('is_done','=',0)->where('user_id','=',$id);
        if(!empty($Exam->all())) {
            return response()->json(['error'=>'You MUST Complete previous Test','exam'=>$Exam],400);
        }
    }
}
