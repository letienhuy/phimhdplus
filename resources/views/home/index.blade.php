@extends('master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
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
                    <div id="swiper-home" class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="list-film">
                    <h1 class="title">PHIM BỘ</h1>
                    <div class="row">
                        @foreach ($filmBo as $item)
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="list-item" title="{{$item->name}}">
                                @if (count($item->vote) === 0)
                                    <div class="star-rank-5"></div>
                                @else
                                    <div class="star-rank-{{round($item->vote->sum('point')/count($item->vote))}}"></div>
                                @endif
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
                <div class="list-film">
                    <h1 class="title">PHIM LẺ</h1>
                    <div class="row">
                        @foreach ($filmLe as $item)
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="list-item" title="{{$item->name}}">
                                @if (count($item->vote) === 0)
                                    <div class="star-rank-5"></div>
                                @else
                                    <div class="star-rank-{{round($item->vote->sum('point')/count($item->vote))}}"></div>
                                @endif
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
                <div class="list-film">
                    <h1 class="title">TOP PHIM MỚI</h1>
                    <div class="row">
                        @foreach ($filmNew as $item)
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="list-item" title="{{$item->name}}">
                                @if (count($item->vote) === 0)
                                    <div class="star-rank-5"></div>
                                @else
                                    <div class="star-rank-{{round($item->vote->sum('point')/count($item->vote))}}"></div>
                                @endif
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
                <div class="list-film top-film">
                    <h1 class="title">TOP PHIM XEM NHIỀU</h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($filmMostView as $item)
                            <div class="swiper-slide col-md-3 col-sm-3 col-xs-2">
                                <div class="list-item" title="{{$item->name}}">
                                    @if (count($item->vote) === 0)
                                        <div class="star-rank-5"></div>
                                    @else
                                        <div class="star-rank-{{round($item->vote->sum('point')/count($item->vote))}}"></div>
                                    @endif
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
            </div>
            <div class="col-md-3 col-sm-4 hidden-xs">
                <div class="ads">
                    <img src="http://huyit.me/images/images/1462520762-phai-2-mon-ngon.jpg" alt="">
                </div>
                <div class="list-film">
                    <h1 class="title">TOP PHIM - PHIMHD+</h1>
                    <div class="list-item-bar">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var swiper = new Swiper('.slide-home .swiper-container', {
            pagination: {
                el: '.swiper-pagination',
                type: 'progressbar',
            },
            autoplay: {
            delay: 5000,
        },
        });
        var width = window.innerWidth;
        var newFilm = new Swiper('.top-film .swiper-container', {
            slidesPerView: width <= 480 ? 2 : width > 480 && width <= 768 ? 3 : 4,
            slidesPerColumn: 2
        });
    </script>
@endsection
