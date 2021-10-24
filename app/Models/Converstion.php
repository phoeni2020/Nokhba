<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Converstion extends Model
{
    use HasFactory;
    protected $table ='converstion';
    protected $fillable =['user_id','teahcer'];
}
