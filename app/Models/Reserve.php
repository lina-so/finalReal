<?php

namespace App\Models;

use App\Realestate;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'reserves';
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
