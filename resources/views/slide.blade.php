<div class="slide">
    <div class="slide-user">
    <span class="icon-user"></span>
    <span class="slide-collapse">
        @if (Auth::check())
            
        @else
            <a href="{{route('login')}}"><button class="btn">Đăng nhập | Đăng ký</button></a>
        @endif
    </span>
    </div>
    <ul class="slide-list">
        {!! Help::slideCategories() !!}
    </ul>
</div>