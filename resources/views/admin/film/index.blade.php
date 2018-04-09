@extends('master')
@section('content')
<div class="container">
<div class="list-film">
        <h1 class="title">QUẢN LÝ PHIM</h1>
        <div style="overflow-x: auto">        
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Tên phim</th>
                <th>Poster</th>
                <th>Tuỳ chọn</th>
            </tr>
            @foreach ($film as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td style="text-align: left;">{{$item->name}}</td>
                    <td><img src="{{$item->poster}}" alt="" width="50px" height="50px"></td>
                    <td>
                            <a href="{{route('admin.film.source', ['id' => $item->id])}}">
                                    <button class="btn btn-primary">Quản lý Source</button>
                            </a>
                            <a href="{{route('admin.film', ['action' => 'edit', 'id' => $item->id])}}">
                                <button class="btn btn-success">Sửa</button>
                            </a>
                            <a href="{{route('admin.film', ['action' => 'delete', 'id' => $item->id])}}">
                                <button class="btn btn-danger">Xoá</button>
                            </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
        {{$film->links()}}
        <a href="{{route('admin.film', ['action' => 'add'])}}"><button class="btn btn-success">Thêm phim mới</button></a>
</div>
</div>
@endsection