<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Models\QrCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $qrCodeObject =  QrCode::where('student_id','=',$id)->with('lessons','teacher','teacher.mainCategories');

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

        unset($id);
        $responseObject = [];
        $responseObject['count'] = $qrCodeObject->count();
        unset($recordsTotal);
        /*======================================================================= */
        $qrCodeObject
            ->skip($start)
            ->take($limit)
            ->orderBy($orderColumn??'id', $orderType ?? 'ASC');

        $qrDataObject = $qrCodeObject->get()->all();
        /*$object = ;
        $response['QrCode']=[$object];
        return response()->json($response);*/

        array_walk($qrDataObject,function ($qrDataObject){
           $this->data[$this->index] = ['qr_Code'=>[
                'qrcode_id'=>$qrDataObject->id,'code_text'=>$qrDataObject->code_text,
                'code_url'=>$qrDataObject->code_url,'used'=>$qrDataObject->used,
                'student_id'=>$qrDataObject->student_id,'valid_till'=>$qrDataObject->valid_till,
            ],'lessons'=>$qrDataObject['lessons'],'teacher'=>$qrDataObject['teacher']];

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
        if(empty($request->qrCode)||is_null($request->qrCode)){
            return response()->json(['error'=>'QrCode Is Required Field'],400);
        }

       $QrCode = QrCode::where('code_text','=',$request->qrCode)->with('lessons','teacher','teacher.mainCategories')->get();
       $result = empty($QrCode->toArray());
       switch ($result){
           case true:
               return response()->json(['error'=>'QrCode Not Exists'],404);
               break;
           case false:
               if( $QrCode[0]->used == 0){
                   $QrCode[0]->used = 1;
                   $QrCode[0]->student_id = $request->user()->id;
                   $QrCode[0]->valid_till = Carbon::now()->addDays(7)->format('Y-m-d');
                   $QrCode[0]->save();
                   $object = ['qr_Code'=>[
                       'qrcode_id'=>$QrCode[0]->id,'code_text'=>$QrCode[0]->code_text,
                       'code_url'=>$QrCode[0]->code_url,'used'=>$QrCode[0]->used,
                       'student_id'=>$QrCode[0]->student_id,'valid_till'=>$QrCode[0]->valid_till,
                   ],'lessons'=>$QrCode[0]['lessons'],'teacher'=>$QrCode[0]['teacher']];
                   return response()->json($object);
               }
               if($QrCode[0]->used == 1){
                   return response()->json(['error'=>'This QrCode Has Been Used Before'],402);
               }
               break;
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
