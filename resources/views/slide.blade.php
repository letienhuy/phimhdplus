<div class="slide">
    <div class="slide-user">
    <span class="icon-user"></span>
    <div class="visible-xs">
        @if (Auth::check())
            <a href="{{route('logout')}}">
                <button class="button">Đăng xuất</button>
            </a>
        @else
            <a href="{{route('login', ['redirectUrl' => url()->current()])}}">
                <button class="button">Đăng nhập</button>
            </a>
        @endif
    </div>
    <span class="slide-collapse hidden-xs">
        @if (Auth::check())
            <a href="{{route('logout')}}">
                <button class="button">Đăng xuất</button>
            </a>
        @else
            <a href="{{route('login', ['redirectUrl' => url()->current()])}}">
                <button class="button">Đăng nhập</button>
            </a>
        @endif
    </span>
    </div>
    <ul class="slide-list">
        {!! Help::slideCategories() !!}
    </ul>
</div>