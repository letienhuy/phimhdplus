<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Vote;
use App\Film;
use App\User;
use App\Like;
class UserController extends Controller
{
    //
    public function index(){
        $vote = Auth::user()->vote()->paginate(10);
        $like = Auth::user()->like()->paginate(10);
        return view('user.index', ['vote' => $vote, 'like' => $like]);
    }
    public function info(){
        
    }
}
