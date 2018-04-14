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