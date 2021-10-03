<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

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
