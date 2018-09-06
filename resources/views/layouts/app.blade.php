
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('partials._head')

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            @if (Auth::guest())
                <a class="navbar-brand" href="{{ url('/') }}">
            @else
                <a class="navbar-brand" href="{{ url('/batch') }}">
            @endif
                {{ Html::image('images/logo.png', 'Logo', ['width' => '200px']) }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="nav navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a class="nav-item nav-link" id="navitem" href="/attendance">Attendance</a></li>
                        <li><a class="nav-item nav-link" id="navitem" href="{{ route('login') }}">Login</a></li>
                        <li><a class="nav-item nav-link" id="navitem" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navitem" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <!--<a class="dropdown-item" href="/user/{{Auth::user()->id}}/edit">Account Settings</a> -->
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>   
	</nav>

    <div class="container">
        <br>
        @include('inc.messages')
        
        @yield('content')
        <div class="footer">
            <hr>
            <p class="text-center">Copyright &copy; 2018 <strong>Pierre & Paul Solutions Inc</strong></p>
        </div>
    </div>



    @include('partials._scripts')

</body>
</html>
