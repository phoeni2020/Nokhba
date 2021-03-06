<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifaction extends Model
{
    use HasFactory,HasTimestamps;
    protected $fillable =['body','user_id'];
}
