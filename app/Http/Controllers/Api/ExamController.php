<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
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
            $exam = Exam::where('is_done','=',0)->where('course','>',$course)->where('user_id','=',$id)->get();
            if(!empty($exam->all())) {
                $boolResponse = $exam[0]->course == $course ? true : false;
                return response()->json(['error'=>'You MUST Complete previous Test','course'=>Course::find($exam[0]->course),'is_same_lesson'=>$boolResponse],403);
            }
            return  response()->json(['massage'=>'Good To Start']);
        }
        catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExam($course){
        $exam = Exam::where('course','=',$course)->where('user_id','=',request()->user()->id)->where('is_done','=',0)->get()->all();
        if(empty($exam)){
            return response()->json(['error' =>'Sorry Your Exam Not Exists'],404);
        }
        else{
            $questions = Question::whereIn('id',json_decode($exam[0]->questions))->get()->all();
            $response = ['exam_id'=>$exam[0]->id];
            $questions_decoded = [];
            foreach ($questions as $question){
                $question->exam_answers = json_decode($question->answers);
                unset($question->answers);
                $questions_decoded[]=$question;
            }
            $response['questions'] = $questions_decoded;
            return response()->json($response);
        }
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\JsonResponse
     */
    public function answerExam(Exam $exam)
    {
        $request=request()->all();
        $exam->is_done=1;
        $exam->grade=$request['grade'];
        $exam->save();
        $questions=$request['questions'];
        foreach ($questions as $question) {
            Answer::create([
                'answers'=>json_encode($question['answers']),
                'Exam'=>$request['exam_id'],
                'Course'=>$request['course_id'],
                'question'=>$question['id'],
                'student'=>request()->user()->id
            ]);
        }
        return response()->json(['massage'=>'Answer Saved',]);
    }

    public function getAnswers($course)
    {

    }
}
