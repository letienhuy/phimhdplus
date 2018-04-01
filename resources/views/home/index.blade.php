@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="slide-home">
                    <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($slide as $item)
                            <div class="swiper-slide">
                                <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="list-film">
                    <h1 class="title">PHIM BỘ</h1>
                    <div class="swiper-container">
                            <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="row">
                                @foreach ($film as $item)
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="list-item" title="{{$item->name}}">
                                        @if ($item->type === 2)
                                        <div class="episode">{{sizeof($item->filmDetail)}}/{{$item->episode}}</div>
                                        @endif
                                        <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                        <div class="play"></div>
                                        <div class="black-gradient"></div>
                                        <div class="film-name">
                                            <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">{{$item->name}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 hidden-xs">
                ADS
            </div>
        </div>
    </div>
@endsection
