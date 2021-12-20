<?php

namespace App\Models;

use App\Models\view\UserView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Converstion extends Model
{
    use HasFactory;

    protected $table = 'converstion';
    protected $fillable = ['user_id', 'teahcer', 'not_read'];

    public function user()
    {
        return $this->belongsTo(UserView::class, 'user_id');
    }
}
