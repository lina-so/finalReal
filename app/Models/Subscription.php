<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'subscription_by_month', 'subscription_by_year',
    ];
    public function users(){
        return $this->hasMany('App\Models\User' , 'user_id');
    }
}
