<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }
    public function follow_user() {
      return $this->belongsTo('App\User','follow_user_id');
    }
}
