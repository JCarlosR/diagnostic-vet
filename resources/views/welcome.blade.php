<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Diagnostic Vet</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{ asset('/principal/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{ url('/') }}" class="brand-logo">{{ config('app.name', 'Laravel') }}</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('/login') }}">Ingresar</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="{{ url('/login') }}">Ingresar</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Bienvenido a Diganostic Vet</h1>
        <div class="row center">
            <h5 class="header col s12 light">Sistema de diagnóstico veterinario</h5>
        </div>
        <div class="row center">
            <a href="{{ route('login') }}" id="download-button" class="btn-large waves-effect waves-light orange">
                Ingresar al sistema
            </a>
        </div>
        <br><br>

    </div>
</div>

@include('includes.features')

<footer class="page-footer orange">
    <div class="container">
        <div class="row center-align">
            <div class="col l6 s12">
                <h5 class="white-text">Acerca de</h5>
                <p class="grey-text text-lighten-4">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Enlaces</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Información</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Desarrollado por 
            <a class="orange-text text-lighten-3" href="http://programacionymas.com" target="_blank">PYM</a>
        </div>
    </div>
</footer>

<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>

</body>
</html>

