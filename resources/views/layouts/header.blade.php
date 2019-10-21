<header>
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-3 logo  align-content-center">
                <a href="{{ secure_url('/') }}"><img src = "{{ secure_asset('/images/logo.png') }}" style="width: 116px" /></a>
            </div>
            <div class="col-9 main-nav text-right justify-content-md-center">
                @guest
                <ul>
                    <li class="active"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    <li><a href="javascript: void(0)" onclick="$('#connect-modal').modal('show')">{{ __('Sign In') }}</a></li>
                </ul>
                <form id="visaForm" action="{{ secure_url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <ul>
                    <li class="active">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar }}">
                                <span class="user-title">{{ Auth::user()->name }}</span>
                            </button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="{{ secure_url('/logout') }}"
                                   onclick="signOut(); event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Sign out') }}
                                </a>

                                <form id="logout-form" action="{{ secure_url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('my-visas') }}">{{ __('My Visas') }}</a>
                    </li>
                </ul>
                
                @endguest
            </div>

        </div>
    </div>
</header>
