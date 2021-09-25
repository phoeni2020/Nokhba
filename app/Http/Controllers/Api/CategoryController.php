<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catgory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories($id){
        $getCategoriesBelongedToTeacher = Catgory::where('id',$id)->get();
    }
}
