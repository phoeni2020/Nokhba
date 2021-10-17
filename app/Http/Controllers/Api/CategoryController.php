<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catgory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories($id){
        $getCategoriesBelongedToTeacher = Catgory::where('parent',$id)->select('id','name','img_url','desc','is_parent')
            ->with('Courses','Courses.attch');
        $getCategoriesBelongedToTeacherCount = $getCategoriesBelongedToTeacher->count();

        foreach ($getCategoriesBelongedToTeacher->get() as $category){
            if(!is_null($category['courses'])){
                $count = count($category['courses']);
                for($i=0; $count > $i; $i++){
                    $category['courses'][$i]['vedio'] = json_decode($category['courses'][$i]['vedio'],true);
                    $category['courses'][$i]['attch'] = $category['courses'][$i]['attch'];
                }
            }
            $categories['category'][]=$category;
        }

        $categories['count']=$getCategoriesBelongedToTeacherCount;
        return response($categories);
    }
}
