@extends('master')
@section('content')
<div class="login-dialog">
    <form id="login-form">
        <div id="result"></div>
        <div class="input">
            <input type="email" name="email" placeholder="Email"/>
        </div>
        <div class="input">
            <input type="password" name="password" placeholder="Mật khẩu"/>
        </div>
        <button class="btn">Đăng nhập</button>
    </form>
    <a href="{{route('register')}}">
        <button class="btn">Đăng ký tài khoản</button>
    </a>
    <span class="login-choose">hoặc</span>
    <button class="btn btn-facebook">Đăng nhập bằng Facebook</button>
</div>
@endsection