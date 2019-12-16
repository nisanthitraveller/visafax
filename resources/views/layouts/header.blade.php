<header>
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-3 logo  align-content-center">
                <a href="{{ url('/') }}"><img src = "{{ secure_asset('/images/logo.png') }}" style="width: 116px" /></a>
            </div>
            <div class="col-9 main-nav text-right justify-content-md-center">
                @guest
                <ul>
                    <li><a href="javascript: void(0)" onclick="$('#connect-modal').modal('show')">{{ __('Sign In') }}</a></li>
                </ul>
                @else
                <ul>
                    <li class="active"><a class="btn btn-outline-primary" href="{{ route('my-visas') }}">{{ __('My Visas') }}</a></li>
                    <li>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar }}">
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item my-visa" href="javascript: void(0)"
                                   onclick="signOut(); event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Sign out') }}
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </li>
                </ul>
                
                @endguest
            </div>

        </div>
    </div>
</header>
