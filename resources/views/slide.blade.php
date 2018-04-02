<div class="slide">
    <div class="slide-user">
    <span class="icon-user"></span>
    <div class="visible-xs">
        @if (Auth::check())
            <span style="color:red">Credit: {{Auth::user()->credit}}</span><br>
            <span><a href="{{route('user.info')}}">Thông tin cá nhân</a></span> |
            <span><a href="{{route('logout')}}">Đăng xuất</a></span>
        @else
            <a href="{{route('login', ['redirectUrl' => url()->current()])}}">
                <button class="button">Đăng nhập</button>
            </a>
        @endif
    </div>
    <span class="slide-collapse hidden-xs">
        @if (Auth::check())
        @if (Auth::user()->right === 1)
        <span><a style="color:red; font-weight:bold;" href="{{route('admin')}}">Admin Control Panel</a></span>            
        @endif
            <span><a href="{{route('user.info')}}">Thông tin cá nhân</a></span>
            <span style="color:red">Credit: {{Auth::user()->credit}}</span>
            <span><a href="">Nạp Credit</a></span>
            <span><a href="">Yêu cầu phim</a></span>
            @if (!Auth::user()->vip)
                <span><a href="">Nâng cấp VIP</a></span>                
            @endif
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