<header>
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-3 logo  align-content-center">
                <a href="{{ secure_url('/') }}">VisaBadge</a>
            </div>
            <div class="col-9 main-nav text-right justify-content-md-center">
                @guest
                    <a href="javascript: void(0)" onclick="$('#connect-modal').modal('show')" class="bg-inverse">My Visas</a>
                    <a href="javascript: void(0)" onclick="$('#connect-modal').modal('show')">Sign In</a>
                @else
                    <a href="{{ route('my-visas') }}" class="bg-inverse">My Visa</a>
                @endguest
                <div class="menu-icon">
                    <span class="menu-icon__line menu-icon__line-left"></span>
                    <span class="menu-icon__line"></span>
                    <span class="menu-icon__line menu-icon__line-right"></span>
                </div>
            </div>
        </div>
    </div>
</header>