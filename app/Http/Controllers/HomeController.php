<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }
    public function register(Request $request)
    {
        return view('home.register');
    }
    public function login(Request $request)
    {
        if($request->method() === "POST"){
            $user = User::where('email', $request->email)->first();
            if(is_null($user)){
                return response()->json(['message' => 'Email này không tồn tại!'], 422);
            }
        }
        return view('home.login');
    }
    public function loginFacebook()
    {
        return view('home.login');
    }
}
