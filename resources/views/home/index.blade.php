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
                    <h1 class="title">
                        PHIM BỘ MỚI NHẤT
                        <span>
                            <a href="{{route('phimbo')}}"></a>
                        </span>
                    </h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($filmBo as $item)
                            <div class="swiper-slide col-md-3 col-sm-3 col-xs-6">
                                <div class="list-item" title="{{$item->name}}">
                                    <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                    <div class="star-rank-{{$item->total_vote}}"></div>
                                    @if ($item->type === 2)
                                    <div class="episode">{{sizeof($item->filmDetail)}}/{{$item->episode}}</div>
                                    @endif
                                    <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                    <div class="play"></div>
                                    <div class="black-gradient"></div>
                                    <div class="film-name">
                                        {{$item->name}}
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="list-film">
                    <h1 class="title">
                        PHIM LẺ MỚI
                        <span>
                            <a href="{{route('phimle')}}"></a>
                        </span>
                    </h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($filmLe as $item)
                            <div class="swiper-slide col-md-3 col-sm-3 col-xs-6">
                                <div class="list-item" title="{{$item->name}}">
                                    <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                    <div class="star-rank-{{$item->total_vote}}"></div>
                                    @if ($item->type === 2)
                                    <div class="episode">{{sizeof($item->filmDetail)}}/{{$item->episode}}</div>
                                    @endif
                                    <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                    <div class="play"></div>
                                    <div class="black-gradient"></div>
                                    <div class="film-name">
                                        {{$item->name}}
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="list-film">
                    <h1 class="title">
                        TOP PHIM MỚI
                        <span>
                            <a href="{{route('phimmoi')}}"></a>
                        </span>
                    </h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($filmNew as $item)
                            <div class="swiper-slide col-md-3 col-sm-3 col-xs-6">
                                <div class="list-item" title="{{$item->name}}">
                                    <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                    <div class="star-rank-{{$item->total_vote}}"></div>
                                    @if ($item->type === 2)
                                    <div class="episode">{{sizeof($item->filmDetail)}}/{{$item->episode}}</div>
                                    @endif
                                    <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                    <div class="play"></div>
                                    <div class="black-gradient"></div>
                                    <div class="film-name">
                                        {{$item->name}}
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="list-film">
                    <h1 class="title">TOP PHIM XEM NHIỀU</h1>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($filmMostView as $item)
                            <div class="swiper-slide col-md-3 col-sm-3 col-xs-6">
                                <div class="list-item" title="{{$item->name}}">
                                    <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                    <div class="star-rank-{{$item->total_vote}}"></div>
                                    @if ($item->type === 2)
                                    <div class="episode">{{sizeof($item->filmDetail)}}/{{$item->episode}}</div>
                                    @endif
                                    <div class="thumb" style="background-image: url({{$item->poster}});"></div>
                                    <div class="play"></div>
                                    <div class="black-gradient"></div>
                                    <div class="film-name">
                                        {{$item->name}}
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="ads hidden-xs">
                    <img src="http://huyit.me/images/images/1462520762-phai-2-mon-ngon.jpg" alt="">
                </div>
                <div class="list-film">
                    <h1 class="title">TOP PHIM - PHIMHD+</h1>
                    @foreach ($topRate as $item)
                        <div class="list-item-bar">
                            <div class="thumb" style="background-image: url({{$item->poster}})"></div>                                      
                            <div class="info-film">
                                <span class="film-name">
                                    <a href="{{route('film', ['uri' => Help::beauty($item->name), 'id' => $item->id])}}" title="{{$item->name}}">
                                        {{$item->name}}
                                    </a>
                                </span>
                                <span class="star-rank-{{$item->total_vote}}"></span>
                                <span>Lượt xem: {{$item->view}}</span>
                            </div>
                        </div>
                    @endforeach
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
        var newFilm = new Swiper('.list-film .swiper-container', {
            slidesPerView: width <= 480 ? 2 : width > 480 && width <= 1024 ? 3 : 4,
            slidesPerColumn: 2
        });
    </script>
@endsection
