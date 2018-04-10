@extends('master')
@section('content')
    <div class="container">
        <h1 class="title">Trang người dùng</h1>
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="list-film">
                    <h1 class="title">CHỨC NĂNG</h1>
                    <ul class="admin-slide">
                        <li><a href="{{route('admin.film')}}">Quản lý phim</a></li>
                        <li>Quản lý danh mục</li>
                        <li>Quản lý người dùng</li>
                        <li>Danh sách báo lỗi</li>
                        <li>Yêu cầu post phim</li>
                        <li>Cài đặt trang web</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="list-film">
                    <h1 class="title">PHIM YÊU THÍCH</h1>
                    <div style="overflow-x: auto">
                    <table class="admin-table">
                        <tr>
                            <th>ID</th>
                            <th>Tên phim</th>
                            <th>Poster</th>
                            <th>Tuỳ chọn</th>
                        </tr>
                        @foreach ($like as $item)
                            <tr>
                                <td>{{$item->film->id}}</td>
                                <td style="text-align: left;">
                                    <a href="{{route('film', ['id' => $item->film->id, 'uri' => Help::beauty($item->film->name)])}}" title="{{$item->film->name}}">{{$item->film->name}}</a>
                                </td>
                                <td><img src="{{$item->film->poster}}" alt="" width="50px" height="50px"></td>
                                <td>
                                    <button id="like-button" data-id="{{$item->film->id}}" class="btn btn-inline btn-primary">
                                        <i class="fa fa-heart" style="color: #f00"></i>
                                        <span>Bỏ thích</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($like) === 0)
                            <tr>
                                <td colspan="4">Danh sách yêu thích đang trống, <a href="{{route('home')}}">Xem phim ngay</a>!</td>
                            </tr>
                        @endif
                    </table>
                    </div>
                    {{$like->links()}}
                </div>
                <div class="list-film">
                    <h1 class="title">PHIM ĐÃ ĐÁNH GIÁ</h1>
                    <div style="overflow-x: auto">
                    <table class="admin-table">
                        <tr>
                            <th>ID</th>
                            <th>Tên phim</th>
                            <th>Poster</th>
                            <th>Đánh giá</th>
                        </tr>
                        @foreach ($vote as $item)
                            <tr>
                                <td>{{$item->film->id}}</td>
                                <td style="text-align: left;">
                                    <a href="{{route('film', ['id' => $item->film->id, 'uri' => Help::beauty($item->film->name)])}}" title="{{$item->film->name}}">{{$item->film->name}}</a>
                                </td>
                                <td><img src="{{$item->film->poster}}" alt="" width="50px" height="50px"></td>
                                <td>
                                    <span class="star-point">{{$item->point}}</span> <i class="fa fa-star" style="color: #ED8A19"></i>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($vote) === 0)
                            <tr>
                                <td colspan="4">Danh sách đánh giá phim đang trống, <a href="{{route('home')}}">Xem phim ngay</a>!</td>
                            </tr>
                        @endif
                    </table>
                    </div>
                    {{$vote->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection