<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desire extends Model
{
    protected $fillable = [
        'location', 'city', 'floor','area','min_price','max_price','number_of_rooms',
        'number_of_path_rooms','furnished','services',
    ];

    public function User(){
        return $this->belongsTo('App\Models\User' , 'user_id');
    }
    
    public function city(){
        return $this->belongsTo('App\Models\City' , 'city_id');
    }



}
