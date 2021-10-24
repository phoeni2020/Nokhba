<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = ['code_text','code_url','lesson','teacher_id','used','student_id','created_at','updated_at','valid_till'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mainCategories(){
        return $this->categories()->where('main','=',0)->select(['id','name','desc','user_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(Catgory::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lessons(){
        return $this->hasOne(Course::class,'id','lesson');
    }

    public function teacher(){
        return $this->hasOne(Teachers::class,'user_id','teacher_id');
    }

    public function student(){
        return $this->hasOne(User::class,'id','student_id');
    }
}
