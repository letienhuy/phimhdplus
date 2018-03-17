<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{url('')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
    <title></title>
</head>
<body id="root">
    <header>
    <div class="header-logo">
        <a href="{{route('home')}}">
            <img src="" alt="LOGO"/>
        </a>
    </div>
    <div class="search-box">
        <button class="search-box_button">
            <i class="fa fa-search"></i>
        </button>
        <input type="text" placeholder="Tìm kiếm phim, diễn viên..." class="search-box_input"/>
    </div>
    <button class="btn-toggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    </header>
    <div id="content">
        @include('slide')
        @yield('content')
    </div>
    <footer>
        Copyright: {{date("Y")}}
    </footer>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>