<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = ['code_text','code_url','lesson','used','student_id'];
    public function mainCategories(){
        return $this->categories()->where('main','=',0)->select(['id','name','desc','user_id']);
    }
    public function categories() {
        return $this->hasMany(Catgory::class,'user_id');
    }

}
