<?php

namespace App\Http\Controllers\triats;

use App\Models\Teachers;

trait Teacher
{
    public function getTeacherId(){
        $response = Teachers::isTeacher();
        $authId = $response['userId'];
        if($response['isTeacher'] === false){
            $teacher =  auth()->user()->assistant()->get();
            $authId = $teacher[0]->user->id;
        }
        return $authId;
    }
}
