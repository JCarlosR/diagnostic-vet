<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- css- TAG-IT-->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/reset-fonts/reset-fonts.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/base/base-min.css">
    <link href="http://fonts.googleapis.com/css?family=Brawler" rel="stylesheet" type="text/css">
    <!-- <link href="/tag-it/_static/master.css" rel="stylesheet" type="text/css">
    <link href="/tag-it/_static/subpage.css" rel="stylesheet" type="text/css">
 -->
    <link href="/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="/tag-it/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">



    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/css/disease/edit.css">
    <style type="text/css">
      .circle responsive-img{ background-repeat: no-repeat; }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">        

      <!-- Dropdown Structure -->
      <ul id="dropdown1" class="dropdown-content">
        <li class="divider"></li>
        <li>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" >
              Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
            </form>
        </li>                 
      </ul>
      <nav>
        <div class="nav-wrapper">
        <div class="row">          
          <div class="col s4">
            @if(auth()->user())
              @yield('contentMenu')
            @endif             
          </div>
          <div class="col s8">
              <!-- <a href="{{ url('/') }}" class="brand-logo">
                  {{ config('app.name', 'Laravel') }}
              </a>  -->             
              <ul class="right hide-on-med-and-down">
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
                
                @else
                <!-- Dropdown Trigger -->
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i>{{ Auth::user()->name }}</i></a></li>
                @endif
              </ul>            
          </div>
        </div>
      </nav>

    </div>

    
    <!-- <div class="container"> -->
    <div class="row">           
         @if(auth()->user())
         <div class="col s10 offset-s1 ">
              @yield('content')
         </div> 
         @else
         <div class="col s4 offset-s4 ">
              <br><br><br>
              @yield('content')
         </div>
         @endif
     </div>   
        
    <!-- </div> -->
    <!-- Scripts -->

    <!-- TAG-IT -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="/js/sidenav.js" type=""></script>
    <script src="/js/disease-symptom/add.js" type=""></script>
    <script src="/js/disease/edit.js" type=""></script>
    @yield('scripts')
</body>
</html>
