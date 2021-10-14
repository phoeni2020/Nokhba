<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catgory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories($id){
        $getCategoriesBelongedToTeacher = Catgory::where('parent',$id)->select('id','name','img_url','desc','is_parent')->with('Courses');
        $getCategoriesBelongedToTeacherCount = $getCategoriesBelongedToTeacher->count();
       if($getCategoriesBelongedToTeacherCount == 0){
           $categories = Catgory::where('id','=',$id)
               ->select('id','name','img_url','desc','is_parent')
               ->with('courses')->get();
           return response($categories);
       }
        foreach ($getCategoriesBelongedToTeacher->get()as $category){
            $categories['category'][]=$category;
        }
        $categories['count']=$getCategoriesBelongedToTeacherCount;
        return response($categories);
    }
}
