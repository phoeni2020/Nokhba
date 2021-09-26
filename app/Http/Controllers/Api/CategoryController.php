<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catgory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories($id){
        $getCategoriesBelongedToTeacher = Catgory::where('parent',$id)->select('id','name','img_url','desc','is_parent');
        $getCategoriesBelongedToTeacherCount = $getCategoriesBelongedToTeacher->count();
        foreach ($getCategoriesBelongedToTeacher->get()as $category){
            $categories['category'][]=$category;
        }
        $categories['count']=$getCategoriesBelongedToTeacherCount;
        return response($categories);
    }
}
