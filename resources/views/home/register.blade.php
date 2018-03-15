@extends('master')
@section('content')
<div class="login-dialog">
    <form id="register-form">
        <input type="email" placeholder="Email"/>
        <input type="password" placeholder="Mật khẩu"/>
        <input type="confirm_password" placeholder="Nhập lại mật khẩu"/>
        <button class="btn">Đăng ký</button>
    </form>
    <a href="{{route('login')}}">
        <button class="btn">Đăng nhập tài khoản</button>
    </a>
    <span class="login-choose">hoặc</span>
    <button class="btn btn-facebook">Đăng nhập bằng Facebook</button>
</div>
@endsection