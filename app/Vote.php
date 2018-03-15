<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    public function film(){
        return $this->hasMany('App\Film', 'film_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
