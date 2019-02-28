<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortfolioPhoto extends Model
{
    protected $table = "portfolio_photos";
    protected $fillable = ['id', 'filename_1'];
 
    public function portfolio_entry()
    {
        return $this->belongsTo('App\Portfolio', 'portfolio_entry_id');
    }
}
