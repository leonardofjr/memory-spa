<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $table = "user_settings";
    protected $fillable = ['phone', 'email', 'facebook_url', 'instagram_url', 'twitter_url', 'github_url'];
}
