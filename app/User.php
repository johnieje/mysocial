<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
