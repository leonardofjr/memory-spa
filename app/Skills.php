<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $table = "setup_skills";
    protected $fillable = ['html', 'css', 'javascript', 'bootstrap', 'angular', 'vuejs', 'php', 'laravel', 'expressjs', 'git', 'windows', 'mac', 'linux'];
}
