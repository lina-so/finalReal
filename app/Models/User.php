<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use  Laravel\Passport\PassportServiceProvider;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function toArray($request)
    // {
    //     // return parent::toArray($request);
    //     return [
    //         'id'=>$this->id,
    //         'name'=>$this->name,
    //         'email'=>$this->email,
    //         'password'=>$this->password,
    //         'created_at'=>$this->created_at->format('d/m/y'),
    //         'updated_at'=>$this->updated_at->format('d/m/y'),

    //     ];
    // }

    public function Subscriptions(){
        return $this->belongsTo('App\Subscription' , 'user_id');
    }

    public function Realestats(){
        return $this->hasMany('App\Realestate' , 'user_id');
    }

    public function Purchases(){
        return $this->hasMany('App\Purchases' , 'user_id');
    }

    public function Sales(){
        return $this->hasMany('App\Sales' , 'user_id');
    }

    public function Desires(){
     
            return $this->hasMany('App\Desire' ,'user_id');
        
    }
    public function real_likes()
    {
        return $this->hasMany('App\Favoraite');
    }

    public function real_served()
    {
        return $this->hasMany('App\Reserve');
    }

    // public function favoraites(){
    //     return $this->belongsToMany('App\Favoraite', 'favoraites', 'real_id', 'user_id'); 
    //  }

     
    // public function favoraiteHas($realId){
    //     return self::favoraites()->where('priduct_id',$realId)->exists();
    //  }

    //  public function Realestatss(){
    //     return $this->belongsToMany('App\Realestate', 'Favoraites', 'real_id', 'user_id'); 
    //  }

}
