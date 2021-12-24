<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Http\Resources\Api\qrResource;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Log;
use App\Models\QrCode;
use App\Models\Question;
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

        $storeEventsData = qrResource::collection($qrDataObject);

        $responseObject['QrCode']=$storeEventsData;

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
        $mac=$request->mac;
        if(empty($request->qrCode)||is_null($request->qrCode)){
            return response()->json(['error'=>'QrCode Is Required Field'],400);
        }
        $QrCode = QrCode::where('code_text','=',$request->qrCode)->with('lessons','teacher','teacher.mainCategories')->get();
        $result = empty($QrCode->toArray());
        switch ($result){
               case true:
                   $data = ['user' => $request->user()->fullname(), 'QrText' => $request->qrCode];
                   Log::create(['log' => 'QrCode Scanned And Its Not Exists', 'user' => $request->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
                   return response()->json(['error' => 'هذا الكيو ار غير موجود'], 404);
                   break;
               case false:
                   if($QrCode[0]->used == 0) {
                       $lesson = Course::find($request->lesson);
                       $id = $request->user()->id;
                       $questions = Question::where('course', '=', $lesson->id)->get()->random($lesson->question_no)->pluck('id');
                       $QrCode[0]->used = 1;
                       $QrCode[0]->student_id = $id;
                       $QrCode[0]->mac = $mac;
                       $QrCode[0]->lesson = $request->lesson;
                       $QrCode[0]->valid_till = Carbon::now()->addDays(7)->format('Y-m-d');
                       $QrCode[0]->save();
                       Exam::create([
                           'questions' => json_encode($questions->toArray()),
                           'user_id' => $id,
                           'course' => $QrCode[0]->lesson,
                           'teacher' => $QrCode[0]->teacher_id,
                       ]);
                       $QrCode[0]['lessons']['vedio'] = json_decode($lesson->vedio);

                       $object = [
                           'messages' => 'Done',
                           'qr_Code' => [
                               'qrcode_id' => $QrCode[0]->id, 'code_text' => $QrCode[0]->code_text,
                               'code_url' => $QrCode[0]->code_url, 'used' => $QrCode[0]->used,
                               'student_id' => $QrCode[0]->student_id, 'valid_till' => $QrCode[0]->valid_till,
                               'mac' => $mac
                           ], 'lessons' => $QrCode[0]['lessons'], 'teacher' => $QrCode[0]['teacher']];
                       $data = ['user' => $request->user()->fullname(), 'QrText' => $request->qrCode];
                       Log::create(['Log' => 'QrCode Scanned Successfully', 'user' => $request->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);

                       return response()->json($object);
                   }
                   if($QrCode[0]->used == 1){
                       $data = ['user' => $request->user()->fullname(), 'QrText' => $request->qrCode];
                       Log::create(['log' => 'QrCode Has Been Used Before', 'user' => $request->user()->id, 'data' => json_encode($data), 'route' => request()->route()->uri()]);
                       return response()->json(['error'=>'This QrCode Has Been Used Before'],402);
                   }
                   break;
           }
    }
}
