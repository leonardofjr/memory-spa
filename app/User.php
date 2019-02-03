<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function skills() {
        return $this->hasOne('App\Skill', 'id');
    }
    public function user_settings() {
        return $this->hasOne('App\UserSetting', 'id');
    }

    public function portfolio() {
        return $this->hasMany('App\Portfolio', 'id');
    }
}
