<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Models\QrCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QrController extends Controller
{
    use dataFilter;
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
        unset($request);
        $qrCodeObject = DB::table('view_teacher_lesson_qrs')
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
            unset($dataFilter);
            $this->filterData($filterData);
            unset($filterData);
            $qrCodeObject->where($this->filterData);
            unset($this->filterData);
        }
        /*======================================================================= */
        $recordsTotal = DB::table('view_teacher_lesson_qrs')
            ->count('*');
        $responseObject = [];
        $responseObject['count'] = $recordsTotal;
        unset($recordsTotal);
        /*======================================================================= */
        $qrCodeObject
            ->skip($start)
            ->take($limit)
            ->orderBy($orderColumn??'qrCode_id', $orderType ?? 'ASC');
        $qrDataObject = $qrCodeObject->get()->all();
        unset($qrCodeObject);
        $index = 0;
        foreach ($qrDataObject as $element){
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
            return response()->json($validatedData->errors()->messages());
        }
        $QrCode = QrCode::where('code_text','=',$request->qrCode)->get();
        if( $QrCode[0]->used == 0){
            $QrCode[0]->used = 1;
            $QrCode[0]->student_id = $request->user()->id;
            $QrCode[0]->valid_till = Carbon::now()->addDays(7)->format('Y-m-d');
            $QrCode[0]->save();
            return response()->json($QrCode[0]);
        }
        return response()->json($QrCode[0]);
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
