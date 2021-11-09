<?php

namespace App\Models;

use App\Models\view\UserView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=['questions','user_id','course','teacher'];
    public function student(){
        return $this->hasOne(UserView::class,'id','user_id');
    }
    public function lesson(){
        return $this->belongsTo(Course::class,'course','id');
    }
}
