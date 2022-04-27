<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\Realestate;
use App\User;

class Favoraite extends Model
{
    protected $table = 'favoraites';
    protected $fillable =[
        'user_id',
        'real_id',
    ];

    public function realestates()
    {
        return $this->belongsTo('App\Models\Realestate');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
