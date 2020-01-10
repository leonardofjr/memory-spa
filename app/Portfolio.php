<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{       
        protected $table = "portfolio";
        protected $fillable = ['user_id', 'title', 'description', 'website_url', 'technologies', 'type', 'image'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
