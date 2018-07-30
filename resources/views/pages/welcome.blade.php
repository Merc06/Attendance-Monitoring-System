<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        @section('title', 'Welcome Page')
        @include('partials._head')
    
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a id="nav" href="{{ url('/batch') }}">Home</a>
                    @else
                        <a id="nav" href="/attendance">Attendance</a>
                        <a id="nav" href="{{ url('/login') }}">Login</a>
                        <a id="nav" href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div id="title" class="title m-b-md">
                    Attendance Monitoring System
                </div>
                <h2 id="title2">Pierre and Paul Solutions Inc.</h2><br>
            </div>
        </div>
    </body>

    @include('partials._scripts')

    

  
</html>
