<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question_text','question_img','answers','course'];
    public function course(){
        $this->belongsTo(Course::class,'course','id');
    }


}
