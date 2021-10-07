<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Models\QrCode as qrModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    use Teacher;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authId = $this->getTeacherId();
        $qrCodes = json_decode($request->qrObject,true);
        $lessonId = $request->lesson;
        foreach($qrCodes as $qrCode){
            $validatedData = Validator::make(
                [$qrCode],
                ['qrCode'=>'required|string|unique:qr_codes,code_text'],
                [
                    'qrCode.unique'=>'There Is Duplicated QrCode Please Try Again',
                ]);
            if($validatedData->fails()){
                return response()->json($validatedData->errors()->messages());
            }
            $pathUrl = url('images/QR/'.$qrCode.'.svg');
            $path = public_path('images/QR/'.$qrCode.'.svg');
            QrCode::size(300)->
            backgroundColor(63, 11, 51)->
            color(49, 84, 115)->
            format('svg')->
            generate($qrCode, $path);
            $qrCodeObject = qrModel::create(
                [
                    'code_text'=>$qrCode,'code_url'=>$pathUrl,
                    'teacher_id'=>$authId,'lesson'=>$lessonId
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function show(QrCode $qrCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function edit(QrCode $qrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCode $qrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QrCode  $qrCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCode $qrCode)
    {
        //
    }
}
