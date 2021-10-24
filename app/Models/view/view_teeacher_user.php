<?php

namespace App\Models\view;

use App\Models\Catgory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_teeacher_user extends Model
{
    protected $table ='view_teacher_user';
    use HasFactory;
    public function categories() {
        return $this->hasMany(Catgory::class,'user_id');
    }

    public function mainCategories(){
        return $this->categories()->where('main','=',0)->select(['id','name','desc','user_id']);
    }

    public static function isTeacher(){

        $id = auth()->id();
        $result = parent::find($id);
        if(is_null($result)){
            return ['userId'=>$id,'object'=>$result,'isTeacher'=>false];
        }
        return ['userId'=>$id,'object'=>$result,'isTeacher'=>true];
    }
}
