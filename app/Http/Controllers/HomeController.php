<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Film;
use Auth;
use Hash;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Film::where('is_slide', 1)->get();
        $filmBo = Film::where([['type', 2], ['disable', 0]])->get(); 
        $filmLe = Film::where([['type', 1], ['disable', 0]])->get(); 
        $filmNew = Film::where('disable', 0)->orderBy('id', 'DESC')->get(); 
        $filmMostView = Film::where('disable', 0)->orderBy('view', 'DESC')->get();
        return view('home.index', [
            'slide' => $slide,
            'filmBo' => $filmBo,
            'filmLe' => $filmLe,
            'filmNew' => $filmNew,
            'filmMostView' => $filmMostView
        ]);
    }
    public function register(Request $request)
    {
        if($request->method() === "POST"){
            $user = User::where('email', $request->email)->first();
            if(is_null($request->email)){
                return response()->json(['message' => 'Vui lòng nhập email!'], 422);                
            }elseif(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9_.+-].[a-zA-Z0-9_.+-]/', $request->email)){
                return response()->json(['message' => 'Vui lòng nhập email hợp lệ!'], 422);                
            }elseif(is_null($request->password)){
                return response()->json(['message' => 'Vui lòng nhập mật khẩu!'], 422);                
            }elseif(strlen($request->password) < 6){
                return response()->json(['message' => 'Mật khẩu phải ít nhất 6 kí tự trở lên!'], 422);                
            }elseif(strpos($request->password, $request->confirm_password) === false){
                return response()->json(['message' => 'Hai mật khẩu không giống nhau!'], 422);                
            }elseif(is_null($user)){
                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);
                if($user){
                    Auth::login($user, true);
                    return response()->json([
                        'message' => 'Tạo tài khoản thành công, hệ thống đang tự động đăng nhập, vui lòng đợi trong giây lát!',
                        'redirectUrl' => $request->redirectUrl ?? route('home')
                    ]);                    
                } else {
                    return response()->json(['message' => 'Có lỗi xảy ra, không thể tạo tài khoản, vui lòng thử lại sau!'], 422);
                }
            } else {
                return response()->json(['message' => 'Email này đã có người đăng ký!'], 422);
            }
        }
        return view('home.register');
    }
    public function login(Request $request)
    {
        if($request->method() === "POST"){
            $user = User::where('email', $request->email)->first();
            if(is_null($user)){
                return response()->json(['message' => 'Email này không tồn tại!'], 422);
            } else {
                if(Hash::check($request->password, $user->password)){
                    Auth::login($user, true);
                    return response()->json([
                        'message' => 'Đăng nhập thành công, hệ thống đang tự động chuyển hướng, vui lòng đợi trong giây lát!',
                        'redirectUrl' => $request->redirectUrl ?? route('home')
                    ]);    
                } else {
                    return response()->json(['message' => 'Mật khẩu không chính xác!'], 422);
                }
            }
        }
        return view('home.login');
    }
    public function loginFacebook()
    {
        return view('home.login');
    }
}
