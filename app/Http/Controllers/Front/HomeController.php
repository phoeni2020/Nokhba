<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Controller;
use App\Http\Resources\studentExamResource;
use App\Models\Answer;
use App\Models\Attch;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Link;
use App\Models\Log;
use App\Models\Question;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /*    public function index()
    {
        return view('front.index');
    }

    public function teacherCategories(Teachers $teacher)
    {
        $mostRecent = Course::where('user_id', '=', $teacher->user_id)->get();
        $urls = Link::where('teacher', '=', $teacher->user_id)->get();
        return view('front.teacher.profile')->with(['teacherData' => $teacher, 'mostRecentCourses' => $mostRecent, 'urls' => $urls]);
    }

    public function lessonCourse(Course $course)
    {
        $id = 41;
        $time = Carbon::now();
        $qr = DB::table('qr_student_lesson')->select('valid_till')
            ->where('student_id', '=', $id)
            ->where('valid_till', '>=', $time)
            ->get();
        if (empty($qr->toArray())) {
            return view('front.teacher.course.course');
        }
        $attchments = Attch::where('lesson_id', '=', $course->id)->get();
        $vediosData = json_decode($course->vedio, true);
        return view('front.course.course')->with(['course' => $course, 'vediosData' => $vediosData, 'attchs' => $attchments]);
    }*/
    public function fillTableStudentExams()
    {
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Exam::where('user_id', request('id'));
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = Exam::where('user_id', request('id'))->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy('id', $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = studentExamResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    public function getExamPage()
    {
        return view('front.index');
    }

    public function examResults(Exam $exam)
    {
        $questions = json_decode($exam->questions);
        $questionsAnsewrs = [];
        foreach ($questions as $question) {
            $answers = Answer::where('question', $question)->where('Exam', '=', $exam->id)->get();
            foreach ($answers as $answer) {
                $question = Question::find($answer->question);
                $question->answers = json_decode($question->answers, true);
                $answer->answers = json_decode($answer->answers, true);
                $questionsAnsewrs[] = ['question' => $question->toArray(), 'answer' => $answer->toArray()];
            }
        }
        return view('front.examAnsewrs')->with(['questionsAnsewrs' => $questionsAnsewrs]);
    }

    /*    public function getExam($course, $id)
    {
        $exam = Exam::where('course', '=', $course)->where('user_id', '=', $id)->where('is_done', '=', 0)->get()->all();

        if(empty($exam)){
            $data = ['course' => $course];
            return response()->json(['error' =>'Sorry Your Exam Not Exists'],404);
        }
        else{
            $questions = Question::whereIn('id',json_decode($exam[0]->questions))->get()->all();
            $response = ['exam_id'=>$exam[0]->id];
            $questions_decoded = [];
            foreach ($questions as $question){
                $exam = $question->toArray();
                unset($exam['answers']);
                $answer = json_decode($question->answers);
                $exam['answers']=$answer;

                $questions_decoded[]=$exam;
            }
            $response['questions'] = $questions_decoded;
            //$data = ['course' => $course];
            //Log::create(['Log' => 'Sorry Your Exam Not Exists', 'user' => request()->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
            return response()->json($response);
        }
    }*/
}
