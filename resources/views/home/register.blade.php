@extends('master')
@section('content')
<div class="login-dialog">
    <form id="register-form">
        <div id="result"></div>
        <div class="input">
            <input type="email" name="email" placeholder="Email" required/>
        </div>
        <div class="input">
            <input type="password" name="password" placeholder="Mật khẩu" required/>
        </div>
        <div class="input">
            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu"/>
        </div>
        <button class="btn">Đăng ký</button>
    </form>
    <a href="{{route('login')}}">
        <button class="btn">Đăng nhập tài khoản</button>
    </a>
    <span class="login-choose">hoặc</span>
    <button class="btn btn-facebook">Đăng nhập bằng Facebook</button>
</div>
@endsection