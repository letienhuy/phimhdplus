@extends('master')
@section('content')
    <div class="container">
        <div class="col-md-9">
            @if (count($film->filmDetail) === 0)
                <div id="player">
                    <script>
                        play('','');
                    </script>
                </div>
            @else
                <div id="player"></div>
                <script>
                    play({
                        m18: '{{$film->filmDetail->first()->source1}}',
                        m22: '{{$film->filmDetail->first()->source2}}',
                        m36: '{{$film->filmDetail->first()->source3}}',
                    }, '{{$film->poster}}', '{{$film->filmDetail->first()->name}}');
                </script>
            @endif
            <div class="film-action">
                @if (!Auth::check() || Auth::check() && !Auth::user()->vip)
                    <button class="off-ads">
                        <i class="fa fa-toggle-off"></i>
                        Tắt Quảng Cáo
                    </button>
                @endif
                <button class="report" data-film="{{$film->id}}">
                    <i class="fa fa-flag-checkered"></i>
                    Báo lỗi
                </button>
            </div>
            <div class="list-film">
                <h1 class="title" style="color: rgb(255, 94, 0);">
                    {{$film->name}}
                </h1>
                @if (Auth::check())
                    @if (count(App\Vote::where([['film_id', $film->id], ['user_id', Auth::id()]])->get()) === 0)
                        <div class="film-vote">
                            <span>Đánh Giá Phim Này</span>
                            <div class="list-star" data-id="{{$film->id}}">
                                <span class="star-white"></span>
                                <span class="star-white"></span>
                                <span class="star-white"></span>
                                <span class="star-white"></span>
                                <span class="star-white"></span>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="fb-like" data-href="{{url()->current()}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                @if ($film->type === 2)
                    <div class="film-eposide">
                        @foreach ($film->filmDetail as $item)
                            <span {{$loop->index ? '' : 'class=active'}} data-eposide="{{$item->id}}">{{++$loop->index}}</span>
                        @endforeach
                    </div>
                @endif
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