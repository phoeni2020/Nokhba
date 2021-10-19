<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Converstion;
use App\Models\Massge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MassagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$teacher)
    {

        $validatedData = Validator::make($request->all(),[
            'image'=>'mimes:jpg,jpeg,png,bmp,tiff|max:10000'
        ]);
        $student = $request->user();
        $converstionId = Converstion::where('user_id','=',$student->id)->where('teahcer','=',$teacher)->get();
        $converstionId = empty($converstionId->all()) ?
            Converstion::create(['user_id'=>$student->id,'teahcer'=>$teacher])->id : $converstionId[0]->id;
        $massage = Massge::create(
            [
                'massge'=>$request->massage??null,'attchment'=>$request->attchment??null,'user_id'=>$student->id,
                'convsertion'=>$converstionId
            ]);
        $response = [
            'user'=>[
                'id'=>$student->id,
                'name'=>$student->fullname(),
                'image'=>''
            ],
            'message'=>$request->massage??'',
            'attachment_image'=>$request->image ?? '',
            'date'=>$massage->created_at,
        ];
        return response()->json($response,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Massge  $massge
     * @return \Illuminate\Http\Response
     */
    public function show(Massge $massge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Massge  $massge
     * @return \Illuminate\Http\Response
     */
    public function edit(Massge $massge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Massge  $massge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Massge $massge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Massge  $massge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Massge $massge)
    {
        //
    }
}
