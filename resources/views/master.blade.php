<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{$title ?? $setting->title}}" />
    <meta property="og:description" content="{{$description ?? $setting->descriptions}}" />
    <meta property="og:image" content="{{$imagePoster ?? ''}}" />
    <meta name="description" content="{{$description ?? $setting->descriptions}}">
    <meta name="keywords" content="{{$keyword ?? $setting->keywords}}">
    <base href="{{url('')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('css/video-js.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
    <script src="https://content.jwplatform.com/libraries/90pS7TYy.js"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/swiper.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <title>{{$title ?? $setting->title}}</title>
</head>
<body id="root">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1830570347236325&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <header>
    <div class="header-logo">
        <img src="http://huyit.me/images/images/nameShop.png" alt="LOGO"/>
    </div>
    <div class="search-box">
        <button class="search-box_button">
            <i class="fa fa-search"></i>
        </button>
        <input type="text" placeholder="Tìm kiếm phim, diễn viên..." class="search-box_input"/>
        <button class="search-box_button_open"><i class="fa fa-search"></i></button>
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
</body>
</html>