<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div>
    <ul id="dropdown1" class="dropdown-content">
        <li class="divider"></li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Salir
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <nav>
        <div class="nav-wrapper teal">
            <div class="row">
                <div class="col s8">
                    @if (auth()->user())
                        @yield('contentMenu')
                    @endif
                </div>
                <div class="col s4">
                    <ul class="right hide-on-med-and-down">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Ingresar</a></li>
                        @else
                            <li>
                                <a class="dropdown-button" href="#!" data-activates="dropdown1">
                                    <i>{{ auth()->user()->name }}</i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="row">
    @if(auth()->check())
        <div class="col s10 offset-s1">
            @yield('content')
        </div>
    @else
        <div class="col s12 m6 l4 offset-l4">
            <br><br><br>
            @yield('content')
        </div>
    @endif
</div>

<script
        src="//code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
<script src="/js/sidenav.js"></script>
<script src="/js/disease-symptom/add.js"></script>
<script src="/js/disease/edit.js"></script>
@yield('scripts')
</body>
</html>
