<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  
    protected $fillable = ['title', 'money','content','wish_at','job_photo'];
  
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }
    
    public function subscribesToJob() {
      return $this->hasMany('App\Subscribe','job_id');
    }
    
    public function favoritesToJob() {
      return $this->hasMany('App\Favorite','job_id');
    }
}
