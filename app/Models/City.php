<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Realestate;

class City extends Model
{
    protected $fillable = [
        'country',
    ];

    public function realestates(){
     
        return $this->hasMany('App\Models\Realestate' ,'city_id');
    
    }

    public function Desires(){
     
        return $this->hasMany('App\Models\Desire' ,'city_id');
    
    }
}
