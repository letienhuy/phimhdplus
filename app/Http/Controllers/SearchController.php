<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index($keys){
        return $keys;
    }
    public function tag($keys){
        return $keys;
    }
}
