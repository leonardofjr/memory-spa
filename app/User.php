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
        'fname', 
        'lname', 
        'email', 
        'password', 
        'bio', 
        'profile_image', 
        'phone', 
        'email', 
        'facebook_url', 
        'linkedin_url', 
        'twitter_url', 
        'github_url', 
        'skills_and_offer'
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
        return $this->hasOne('App\Skill', 'user_id');
    }


    public function portfolio() {
        return $this->hasMany('App\Portfolio', 'user_id');
    }
}
