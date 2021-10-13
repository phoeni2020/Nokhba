<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Models\Catgory;
use App\Models\QrCode;
use App\Models\view\view_teacher_lesson_qr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QrController extends Controller
{
    use dataFilter;
    private $filterData =[];
    private $data = [];
    private $index = 0;
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $validatedData = Validator::make(
            $request->all(),
            ['start'=>'required','limit'=>'required'],
            [
                'start.required'=>'start Is Must',
                'limit.required'=>'limit Is Must',
            ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->messages(),400);
        }
        $id = $request->user()->id;
        $start = $request->start;
        $limit = $request->limit;
        $start = $start * $limit;
        $filter = $request->filter;
        unset($request);
        $qrCodeObject = DB::table('view_teacher_lesson_qrs')->
                        where('student_id','=',$id);
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
            unset($dataFilter);
            $this->filterData($filterData);
            unset($filterData);
            $qrCodeObject->where($this->filterData);
            unset($this->filterData);
        }
        /*======================================================================= */
        $recordsTotal = DB::table('view_teacher_lesson_qrs')
            ->where('student_id','=',$id)
            ->count('*');
        unset($id);
        $responseObject = [];
        $responseObject['count'] = $recordsTotal;
        unset($recordsTotal);
        /*======================================================================= */
        $qrCodeObject
            ->skip($start)
            ->take($limit)
            ->orderBy($orderColumn??'qrCode_id', $orderType ?? 'ASC');
        $qrDataObject = $qrCodeObject->get()->all();
        //unset($qrCodeObject);
        array_walk($qrDataObject,function ($qrDataObject){
            $this->data[$this->index]['qr_Code']['qrcode_id'] = $qrDataObject->qrCode_id;
            $this->data[$this->index]['qr_Code']['code_text'] = $qrDataObject->code_text;
            $this->data[$this->index]['qr_Code']['code_url'] = $qrDataObject->code_url;
            $this->data[$this->index]['qr_Code']['used'] = $qrDataObject->used;
            $this->data[$this->index]['qr_Code']['student_id'] = $qrDataObject->student_id;
            $this->data[$this->index]['qr_Code']['valid_till'] = $qrDataObject->valid_till;
            $this->data[$this->index]['lesson']['lesson_id'] = $qrDataObject->lesson_id;
            $this->data[$this->index]['lesson']['title'] = $qrDataObject->title;
            $this->data[$this->index]['lesson']['lessonDescription'] = $qrDataObject->lessonDescription;
            $this->data[$this->index]['lesson']['lessonImage'] = $qrDataObject->lessonImage;
            $this->data[$this->index]['lesson']['category_id'] = $qrDataObject->category_id;
            $this->data[$this->index]['lesson']['vedio'] = $qrDataObject->vedio ?? 'ﻻ يوجد فيديو';
            $this->data[$this->index]['teacher']['id'] = intval($qrDataObject->user_id);
            $this->data[$this->index]['teacher']['user_id'] = intval($qrDataObject->user_id);
            $this->data[$this->index]['teacher']['fName'] = $qrDataObject->vedio;
            $this->data[$this->index]['teacher']['mName'] = $qrDataObject->fName;
            $this->data[$this->index]['teacher']['lName'] = $qrDataObject->lName;
            $this->data[$this->index]['teacher']['short_description'] = $qrDataObject->short_description;
            $this->data[$this->index]['teacher']['long_description'] = $qrDataObject->long_description;
            $this->data[$this->index]['teacher']['subject'] = $qrDataObject->subject;
            $this->data[$this->index]['teacher']['main_categories']=Catgory::where('user_id','=',$qrDataObject->user_id)->where('main','=',0)->select(['id','name','desc','user_id'])->get()->all();
            $this->index++;
        });
        $responseObject['QrCode']=$this->data;
        return response()->json($responseObject);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUpdate(Request $request)
    {
        $validatedData = Validator::make(
            $request->all(),
            ['qrCode'=>'required|string|exists:qr_codes,code_text'],
            [
                'qrCode.required'=>'QrCode Is Must You May Scan It Or Enter It As Text',
                'qrCode.exists'=>'QrCode Is Not Exists',
            ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors()->messages(),400);
        }
        $QrCode = QrCode::where('code_text','=',$request->qrCode)->get();
        if( $QrCode[0]->used == 0){
            $QrCode[0]->used = 1;
            $QrCode[0]->student_id = $request->user()->id;
            $QrCode[0]->valid_till = Carbon::now()->addDays(7)->format('Y-m-d');
            $QrCode[0]->save();
            return response()->json($QrCode[0]);
        }
        if($QrCode[0]->used == 1){
            return response()->json(['massage'=>'This QrCode Has Been Used Before','qrCode'=>$QrCode[0]],402);
        }
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
