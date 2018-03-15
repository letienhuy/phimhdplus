@extends('master')
@section('content')
<div class="login-dialog">
    <form id="login-form">
        <input type="email" placeholder="Email"/>
        <input type="password" placeholder="Mật khẩu"/>
        <button class="btn">Đăng nhập</button>
    </form>
    <a href="{{route('register')}}">
        <button class="btn">Đăng ký tài khoản</button>
    </a>
    <span class="login-choose">hoặc</span>
    <button class="btn btn-facebook">Đăng nhập bằng Facebook</button>
</div>
@endsection