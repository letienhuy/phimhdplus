<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index($keys){
        return view('search.index');
    }
    public function tag($keys){
        return $keys;
    }
}
