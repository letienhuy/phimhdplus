@extends('master')
@section('content')
    <div class="container">
        <div class="col-md-9">
            @if (count($film->filmDetail) === 0)
                <div id="player">
                    <span>
                        Có lỗi xảy ra! Không tìm thấy source phim
                    </span>
                </div>
            @else
                <div id="player"></div>
            @endif
            <div class="film-action">
                @if (!Auth::check() || Auth::check() && !Auth::user()->vip)
                    <button class="off-ads">Tắt Quảng Cáo</button>
                @endif
                <button class="report">Báo lỗi</button>
            </div>
            <script>
                play({
                    m18: '{{$film->filmDetail->first()->source1}}',
                    m22: '{{$film->filmDetail->first()->source2}}',
                    m36: '{{$film->filmDetail->first()->source3}}',
                }, '{{$film->poster}}', '{{$film->filmDetail->first()->name}}');
            </script>
            <div class="list-film">
                <h1 class="title" style="color: rgb(255, 94, 0);">
                    {{$film->name}}
                </h1>
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