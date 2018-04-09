@extends('master')
@section('content')
    <div class="container">
        <div class="list-film">
            <h1 class="title">Quản lý source - {{$film->name}}</h1>
            <div style="overflow-x: auto;">
                <table class="admin-table">
                    <tr>
                        <th>#</th>
                        <th>Tên tập phim</th>
                        <th>480p</th>
                        <th>720p</th>
                        <th>1080p</th>
                        <th>480p VIP</th>
                        <th>720p VIP</th>
                        <th>1080p VIP</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    @if (count($film->filmDetail) === 0)
                        <tr>
                            <td colspan="9">Chưa có resource cho phim này!</td>
                        </tr>
                    @else
                        @foreach ($filmDetail as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->source1}}</td>
                            <td>{{$item->source2}}</td>
                            <td>{{$item->source3}}</td>
                            <td>{{$item->source_vip1}}</td>
                            <td>{{$item->source_vip2}}</td>
                            <td>{{$item->source_vip3}}</td>
                            <td>
                                <a href="{{route('admin.film.source', ['action' => 'edit', 'id' => $item->id])}}">
                                    <button class="btn btn-success">Sửa</button>
                                </a>
                                <a id="delete-source"  data-id="{{$item->id}}">
                                    <button class="btn btn-danger">Xoá</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </div>
            {{$filmDetail->links()}}
            @if ($film->type === 2 && count($filmDetail) < $film->episode)
                <a href="{{route('admin.film.source', ['action' => 'add', 'id' => $film->id])}}"><button class="btn btn-success">Thêm resource phim</button></a>                            
            @endif
        </div>
    </div>
@endsection