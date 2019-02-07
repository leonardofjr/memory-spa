<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = "setup_skills";
    public $primaryKey = 'id';
    protected $fillable = ['user_id', 'skills_and_offer', 'html', 'css', 'javascript', 'bootstrap', 'angular', 'vuejs', 'php', 'laravel', 'expressjs', 'git', 'windows', 'mac', 'linux'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
