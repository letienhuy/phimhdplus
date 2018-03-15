<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    public function filmDetail(){
        return $this->hasMany('App\FilmDetail', 'film_id', 'id');
    }
}
