<?php

namespace App\Models\view;

use App\Models\Catgory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class view_teacher_lesson_qr extends Model
{
    use HasFactory;
    public function categories() {
        return $this->hasMany(Catgory::class,'user_id');
    }

    public function mainCategories(){
        return $this->categories()->where('main','=',0)->select(['id','name','desc','user_id']);
    }
}
