<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realestate extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'address', 'floor','area','price','number_of_rooms',
        'number_of_path_rooms','furnished','services','cover','image','countF','end_r_date',
    ];

    public function Purchases(){
        return $this->belongsTo('App\Models\Purchases' , 'real_id');
    }

    public function Sales(){
        return $this->belongsTo('App\Models\Sales' , 'real_id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User' , 'user_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City' , 'city_id');
    }

    public function real_likes()
    {
        return $this->hasMany('App\Models\Favoraite');
    }

    public function real_served()
    {
        return $this->hasMany('App\Models\Reserve');
    }

    // public function Users(){
    //     return $this->belongsToMany(User::class , 'favoraites');
    // }


}


