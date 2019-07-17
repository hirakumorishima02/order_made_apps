<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function jobsToUser() {
      return $this->hasMany('App\Job','user_id');
    }
    public function userInfosToUser() {
      return $this->hasOne('App\User_Info','user_id');
    }
    public function portfoliosToUser() {
      return $this->hasMany('App\Portfolio','user_id');
    }
    public function subscribesToUser() {
      return $this->hasMany('App\Subscribe','user_id');
    }
    public function followToUser() {
      return $this->hasMany('App\Follow','user_id');
    }
    public function isFollowedToUser() {
      return $this->hasMany('App\Follow','follow_user_id');
    }
    public function favoritesToUser() {
      return $this->hasMany('App\Favorite','user_id');
    }
    public function messagesToUser() {
      return $this->hasMany('App\Message','to_user_id');
    }
    public function messagesFromUser() {
      return $this->hasMany('App\Message','from_user_id');
    }
    
}
