<?php

namespace App\Http\Controllers\triats;

use App\Models\Teachers;

trait Teacher
{
    public function getTeacherId(){
        $response = Teachers::isTeacher();
        if(is_null($response['userId'])){
            return redirect(url('/login'));
        }
        $authId = $response['object'][0]['user_id'];
        if($response['isTeacher'] === false){
            $teacher =  auth()->user()->assistant()->get();
            $authId = $teacher[0]->user->id;
        }
        return ['user_id'=>$authId,'teacher'=>$response['object'][0]['id'],'object'=>$response['object']];
    }
}
