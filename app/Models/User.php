<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function education(){
        return $this->hasMany(Education::class);
    }

    public function basic_info(){
        return $this->hasOne(BasicInfo::class);
    }

    public function works(){
        return $this->hasMany(WorkHistory::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
}
