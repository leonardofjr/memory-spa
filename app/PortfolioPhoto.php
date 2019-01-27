<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioPhoto extends Model
{
    protected $table = "portfolio_photos";
    protected $fillable = ['photo_id', 'filename_1'];
 
    public function portfolio_entry()
    {
        return $this->belongsTo('App\Portfolio', 'id');
    }
}
