<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catgory extends Model
{
    use HasFactory;
    protected $fillable=['name','desc','main','is_parent','parent','img_url','thmubnil_img_url','user_id'];

    /**
     * @return string[]
     */
    public function courses()
    {
        return $this->hasMany(Course::class,'category_id');
    }
}
