<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    public function filmDetail(){
        return $this->hasMany('App\FilmDetail', 'film_id', 'id');
    }
    public function vote(){
        return $this->hasMany('App\Vote', 'film_id', 'id');
    }
}
