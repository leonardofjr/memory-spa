<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = "user_settings";
    public $primaryKey = 'id';
    protected $fillable = ['user_id', 'bio','profile_image','phone', 'email', 'facebook_url', 'instagram_url', 'twitter_url', 'github_url'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
