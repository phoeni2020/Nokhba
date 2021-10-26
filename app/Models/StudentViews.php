<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentViews extends Model
{
    use HasFactory;
    protected $table ='views_student_course';
    protected $fillable = ['student','course','views'];
}
