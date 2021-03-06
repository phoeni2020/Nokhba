<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Massge extends Model
{
    use HasFactory;
    protected $fillable =['attchment','massge','user_id','convsertion'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
