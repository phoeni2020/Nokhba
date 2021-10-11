<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;
    protected $casts =['id'=>'integer','user_id'=>'integer'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(Catgory::class,'user_id','user_id');
    }

    public function links(){
        return $this->hasMany(Link::class,'teacher','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mainCategories(){
        return $this->categories()->where('main','=',0)->select(['id','name','desc','user_id']);
    }

    /**
     * @return array
     */
    public static function isTeacher(){

        $id = auth()->id();
        $result = parent::find($id);
        if(is_null($result)){
            return ['userId'=>$id,'object'=>$result,'isTeacher'=>false];
        }
        return ['userId'=>$id,'object'=>$result,'isTeacher'=>true];
    }
}
