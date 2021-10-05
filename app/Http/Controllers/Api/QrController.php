<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QrController extends Controller
{
    private $filterData =[];
    private $data = [];
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $id = $request->user()->id;
        $start = $request->start;
        $limit = $request->limit;
        DB::enableQueryLog();
        $CoursesObject = DB::table('view_teacher_lesson_qrs')
                        ->select('*')
                        ->where('student_id','=',$id);
        unset($id);
        $filter = request('filter');
        if (!empty($filter)) {
            $filterData = [];
            $dataFilter ='';
            foreach ($filter as $field => $value) {
                if(count($filter) > 1){
                    $dataFilter.="$field=$value&";
                }
                else{
                    $dataFilter = "$field=$value";
                }
            }
            parse_str(html_entity_decode($dataFilter), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        $recordsTotal = DB::table('view_teacher_lesson_qrs')
            ->count('*');
        /*======================================================================= */
        $CoursesObject
            ->skip($start)
            ->take($limit)
            ->orderBy($orderColumn??'qrCode_id', $orderType ?? 'ASC');
        $teachers = $CoursesObject->get();
        $teachersObject = [];
        $teachersObject['count'] = $recordsTotal;
        $index = 0;
        foreach ($teachers->all() as $element){
            $this->data[$index]['qr_Code']['qrcode_id'] = $element->qrCode_id;
            $this->data[$index]['qr_Code']['code_text'] = $element->code_text;
            $this->data[$index]['qr_Code']['code_url'] = $element->code_url;
            $this->data[$index]['qr_Code']['used'] = $element->used;
            $this->data[$index]['qr_Code']['student_id'] = $element->student_id;
            $this->data[$index]['lesson']['lesson_id'] = $element->lesson_id;
            $this->data[$index]['lesson']['title'] = $element->title;
            $this->data[$index]['lesson']['lessonDescription'] = $element->lessonDescription;
            $this->data[$index]['lesson']['lessonImage'] = $element->lessonImage;
            $this->data[$index]['lesson']['category_id'] = $element->category_id;
            $this->data[$index]['lesson']['vedio'] = $element->vedio ?? 'ﻻ يوجد فيديو';
            $this->data[$index]['teacher']['user_id'] = $element->user_id;
            $this->data[$index]['teacher']['fName'] = $element->vedio;
            $this->data[$index]['teacher']['mName'] = $element->fName;
            $this->data[$index]['teacher']['lName'] = $element->lName;
            $this->data[$index]['teacher']['short_description'] = $element->short_description;
            $this->data[$index]['teacher']['long_description'] = $element->long_description;
            $this->data[$index]['teacher']['subject'] = $element->subject;
            $index++;
        }
        $teachersObject['QrCode']=$this->data;
        return response()->json($teachersObject);

    }

    /**
     * @param $filterData
     */
    private function filterData($filterData)
    {

        foreach ($filterData as $key => $value) {
            $op='LIKE';
            if($key=='valid'){
                $op = $value == true ? '>':'<';
                $value =Carbon::now();
                $key='valid_till';
            }
                (!empty($value)) ? array_push($this->filterData, ["$key","$op", "$value"]) : '';


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
