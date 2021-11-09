<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Http\Controllers\triats\ImageUrl;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\examResource;
use App\Http\Resources\questionResource;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    use Teacher , dataFilter ,ImageUrl;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableExams(){
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        $teahcer_id = $this->getTeacherId();
        /*======================================================================= */
        $CoursesObject = Exam::query()->where('teacher','=',$teahcer_id['user_id'])->with('student');
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
        $recordsTotal = Exam::where('teacher','=',$teahcer_id['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = examResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function fillTableQuestion(){
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        $teahcer_id = $this->getTeacherId();
        /*======================================================================= */
        $CoursesObject = Question::query()->where('teacher','=',$teahcer_id['user_id']);
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
        $recordsTotal =  Question::where('teacher','=',$teahcer_id['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = questionResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeQuestion(Request $request)
    {
        $id=$this->getTeacherId();
        $validatedData = Validator::make($request->all(),[
            'questionText'=>'min:5|max:100|nullable',
            'questionImage'=>'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            //'grade'=>'required',
            'answer.img.*'=>'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            'answer.text.*'=>'min:1|max:100|nullable',
            'answer.correct.*'=>'required|nullable',
        ]);
        $validatedData->validated();
        unset($validatedData);
        $data = $request->except('_token');
        /**
         * {
        "ansewrs":{
        "answer1":{
        "answer":"test",
        "is_correct":1
        },
        "answer2":{
        "answer":"test",
        "is_correct":0
        }
        }
        }
         */
        if(isset($data['answer']['img'])){
            $answersArray = [];
            foreach ($data['answer']['img'] as $key => $answer) {
                $imgAnswer = $this->uploadImage($answer,0);
                $isCorrect = isset($data['answer']['correct'][$key]) ? true : false;
                $answersArray['answers'][$key] = [
                    'image_ansewr'=>$imgAnswer[0],
                    'text'=>'',
                    'is_correct'=>$isCorrect,];
            }
            $imgQuestion = isset($data['questionImage'])?$this->uploadImage($request->file('questionImage'),0):'';
            $object = ['question_text'=>$data['questionText']??'','teacher'=>$id['user_id'],'question_img'=>$imgQuestion[0]??'',
                'answers'=>json_encode($answersArray),
                'course'=>'6'
            ];
            Question::create($object);
            return redirect(url('/exams/question'))->with(['massage'=>'Question Created Successfully']);
        }
        else{
            $answersArray = [];
            foreach ($data['answer']['text'] as $key => $answer) {
                $isCorrect = isset($data['answer']['correct'][$key]) ? true : false;
                $answersArray['answers'][$key] = [
                    'image_ansewr'=>'',
                    'text'=>$answer,
                    'is_correct'=>$isCorrect,];
            }
            $imgQuestion = isset($data['questionImage'])?$this->uploadImage($request->file('questionImage'),0):'';
            $object = ['question_text'=>$data['questionText']??'','teacher'=>$id['user_id'],'question_img'=>$imgQuestion[0]??'',
                'answers'=>json_encode($answersArray),
                'course'=>'6'
            ];
            Question::create($object);
            return redirect(url('/exams/question'))->with(['massage'=>'Question Created Successfully']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'questionText'=>'required|min:5|max:100',
            'questionImage'=>'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            'answer.img.*'=>'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            'answer.text.*'=>'min:1|max:100|nullable',
            'answer.correct.*'=>'required|nullable',
        ]);
        $validatedData->validated();
        unset($validatedData);
        $data = $request->except('_token');
        /**
         * {
            "ansewrs":{
                "answer1":{
                "answer":"test",
                "is_correct":1
                },
                "answer2":{
                "answer":"test",
                "is_correct":0
                }
            }
        }
         */
        if(isset($data['answer']['img'])){
            $answersArray = [];
            foreach ($data['answer']['img'] as $key => $answer) {
                $imgAnswer = $this->uploadImage($answer,0);
                $isCorrect = isset($data['answer']['correct'][$key]) ? true : false;
                $answersArray['answers'][$key] = [
                                        'image_ansewr'=>$imgAnswer[0],
                                        'is_correct'=>$isCorrect,];
            }
            $imgQuestion = isset($data['questionImage'])?$this->uploadImage($request->file('questionImage'),0):'';
            $object = ['question_text'=>$data['questionText']??'','question_img'=>$imgQuestion[0],
                'answers'=>json_encode($answersArray),
                'course'=>'6'
            ];
            Question::create($object);
            return redirect()->url('/exams/question')->with(['massage'=>'Question Created Successfully']);
        }
        else{

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
