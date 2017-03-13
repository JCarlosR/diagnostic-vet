@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-content">
        <span class="card-title">INICIAR SESION</span>

        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">email</i>
                  <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                  <label for="email" data-error="E-Mail no valido" data-success="good">E-Mail</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" name="password" type="password" class="validate" min="6" value="{{ old('password') }}" autocomplete="new-password" required>
                    <label for="password" data-error="Por favor ingresa tu contraseña" data-success="good">Contraseña</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12">
                    <input type="checkbox" id="test5" name="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label for="test5">Recordar sesión</label>
                </div>
            </div>


            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn">
                        Ingresar
                    </button>

                    <a class="right" href="{{ url('/password/reset') }}">
                        Olvidaste tu contraseña?
                    </a>
                </div>
            </div>
        </form>
    </div>
    
</div> 


@endsection
