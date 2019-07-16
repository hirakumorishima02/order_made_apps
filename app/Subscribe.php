<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['message', 'status'];
    
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }
    public function job() {
      return $this->belongsTo('App\Job', 'job_id');
    }
}
