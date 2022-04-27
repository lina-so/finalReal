<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $fillable = [
        'price',
    ];


    public function Realestates(){
        return $this->hasMany('App\Models\Realestate' , 'real_id');
    }

    public function User(){
        return $this->hasMany('App\Models\User' , 'user_id');
    }
}
