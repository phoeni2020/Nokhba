<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function followUnfollow(Request $request)
    {
        $validatedData = Validator::make(
            $request->all(),
            [
                'follow' =>'required',
                'teacher' =>'required',
            ],
        );
        $validatedData->validated();
        $id = $request->user()->id;
        if($request->follow == 1){
            $followData = Follow::where('user_id','=',$id)->where('teacher','=',$request->teacher)->get();
            if(empty($followData->toArray())){
                $followData[0]->delete();
            }
            return response()->json(['massage'=>'Unfollowed Successfully'],200);
        }
        else{
            $followData = Follow::create(['user_id'=>$id,'teacher'=>$request->teacher]);

            return response()->json(['massage'=>'Followed Successfully'],200);
        }
    }
}
