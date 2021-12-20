<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Log;
use App\Models\Question;
use App\Models\view\view_teacher_lesson_qr;
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * @param $course
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function enroll(Course $course)
    {
        try {
            if ($course->isfree == 1) {

                $course->vedio = json_decode($course->vedio, true);
                return response()->json(['course' => $course]);

            }
            $id = request()->user()->id;
            $userMac = request()->user()->mac;
            $qrCode = view_teacher_lesson_qr::where('student_id', '=', $id)
                ->where('lesson_id', '=', $course->id)->where('valid_till', '>', Carbon::now());
            /*$mac = $qrCode->where('used', '=', 1)->get()->all();
            if ($mac->mac != $userMac) {
                return response()->json(['error' => 'عفوا يجب مشاهده الدرس من نفس الجهاز الذي تم تفعيله عليه'], 403);

            }*/
            if (empty($qrCode->where('used', '=', 1)->get()->all())) {
                $data = [
                    'user' => request()->user()->fullname(),
                    'course' => $course->id,
                ];
                Log::create(['Log' => 'The QrCode Is Expirad OR You Never Enorlled In That Lesson', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
                return response()->json(['error' => 'The QrCode Is Expirad OR You Never Enorlled In That Lesson'], 402);
            }

            $exam = Exam::where('is_done', '=', 0)->where('course', '>', $course->id)->where('user_id', '=', $id)->get();

            if (!empty($exam->all())) {
                $data = [
                    'user' => request()->user()->fullname(),
                ];
                Log::create(['log' => 'You MUST Complete previous Test', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
                $boolResponse = $exam[0]->course == $course ? true : false;
                return response()->json(['error' => 'You MUST Complete previous Test', 'course' => Course::find($exam[0]->course), 'is_same_lesson' => $boolResponse], 403);
            }
            $data = [
                'user' => request()->user()->fullname(),
            ];
            Log::create(['log' => 'Good To Start', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
            $course->vedio = json_decode($course->vedio, true);
            return response()->json(['course' => $course]);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExam($course){
        $exam = Exam::where('course','=',$course)->where('user_id','=',request()->user()->id)->where('is_done','=',0)->get()->all();
        if(empty($exam)) {
            $id = request()->user()->id;
            $data = ['course' => $course];
            Log::create(['Log' => 'Sorry Your Exam Not Exists', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
            $lesson = Course::find($course);
            $questions = Question::where('course', '=', $lesson->id)->get()->random($lesson->question_no)->pluck('id');
            $exam = Exam::create([
                'questions' => json_encode($questions->toArray()),
                'user_id' => $id,
                'course' => $course,
                'teacher' => $lesson->user_id,
            ]);
        }
        $questions = Question::whereIn('id', json_decode($exam[0]->questions))->get()->all();
        $response = ['exam_id' => $exam[0]->id];
        $questions_decoded = [];
        foreach ($questions as $question) {
            $exam = $question->toArray();
            unset($exam['answers']);
            $answer = json_decode($question->answers);
            $exam['answers'] = $answer;

            $questions_decoded[] = $exam;
        }
        $response['questions'] = $questions_decoded;
        //$data = ['course' => $course];
        //Log::create(['Log' => 'Sorry Your Exam Not Exists', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
        return response()->json($response);
    }

    /**
     * @param Exam $exam
     * @return \Illuminate\Http\JsonResponse
     */
    public function answerExam(Exam $exam)
    {
        $request = request()->all();
        $exam->is_done = 0;
        //$questions = Question::whereIn('id',json_decode($exam[0]->questions))->get()->all();
        $exam->grade=$request['grade'];
        $exam->save();
        $questions = $request['answers'];
        foreach ($questions as $question) {
            Answer::create([
                'answers' => json_encode($question['answer']),
                'Exam' => $request['exam_id'],
                'Course' => $request['course_id'],
                'question' => $question['question'],
                'student' => request()->user()->id
            ]);
        }
        return response()->json(['massage'=>'Answer Saved',]);
    }

    public function getAnswers($course)
    {

    }
}
