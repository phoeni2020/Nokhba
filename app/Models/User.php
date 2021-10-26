<?php

namespace App\Models;

use App\Notifications\RestPasswordNotifcation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fName',
        'mName',
        'lName',
        'email',
        'password',
        'student',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /*  public function sendPasswordResetNotification($token)
    {
        $this->notifyNow(new RestPasswordNotifcation());
    }*/

    /**
     * @return string
     */
    public function fullName(){
        if(is_null($this->fName)){
            return 'No Name';
        }
        return "$this->fName $this->mName $this->lName";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assistant(){
        return $this->belongsTo(Teachers::class,'belongs_to_teacher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function following(){
        return $this->hasOne(Follow::class,'user_id','id');
    }
}
