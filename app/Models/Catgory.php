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
     * $mainCategory  = Catgory::create(['name'=>$request->name,'desc'=>$request->desc,'main'=>0,
    'is_parent'=>1,'img_url'=>$imageUrl,'thmubnil_img_url'=>$thumbnailsUrl]);
     */
}
