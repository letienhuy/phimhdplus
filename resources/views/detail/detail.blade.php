@extends('master')
@section('content')
    <div class="container">
        <div class="col-md-9">
            <a href="{{route('film.view', ['uri' => Help::beauty($film->name), 'id' => $film->id])}}">
            <div class="slide-home">
                <div class="thumb" style="background-image: url({{$film->poster}});"></div>
                <div class="play"></div>
            </div>
            </a>
            <div class="list-film">
                <h1 class="title" style="color: rgb(255, 94, 0);">
                    {{$film->name}}
                </h1>
                <div class="fb-like" data-href="{{url()->current()}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="film-detail">
                    <a href="{{route('film.view', ['uri' => Help::beauty($film->name), 'id' => $film->id])}}">
                    <button class="btn btn-inline btn-success">XEM PHIM</button>
                    </a>              
                    @if (Auth::check())
                        <a href="{{route('film.view', ['uri' => Help::beauty($film->name), 'id' => $film->id])}}">
                        <button class="btn btn-inline btn-danger">DOWNLOAD</button>
                        </a>
                    @endif              
                    <span>Đạo  diễn: {{$film->director}}</span>
                    <span>Diễn viên: {{$film->actor}}</span>
                    @if ($film->type === 2)
                        <span>Số tập: {{sizeof($film->filmDetail)}}/{{$film->episode}}</span>
                    @endif
                    <span>Thể  loại: {!! Help::listCategory($film->category) !!}</span>
                    <span>Tags: </span>
                    <div class="film-about">
                        {{$film->about}}
                    </div>
                </div>
            </div>
            <div class="list-film">
                <h1 class="title">Bình luận phim</h1>
                <div class="fb-comments" data-href="{{url()->current()}}" data-numposts="10"></div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
@endsection