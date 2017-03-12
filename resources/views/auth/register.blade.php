@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-content">
        <span class="card-title">Registrar</span>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div> -->

            <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">email</i>
                  <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required>
                  <label for="email" data-error="Nombre no valido" data-success="good">Nombre</label>
                </div>
            </div>

         <!--    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div> -->

            <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">email</i>
                  <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                  <label for="email" data-error="Email no valido" data-success="good">E-Mail Address</label>
                </div>
            </div>

          <!--   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div> -->

            <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock</i>
                  
                  <input id="password" type="password" class="validate" name="password" value="" required>
                  <label for="password" data-error="No valido" >Password</label>
                  @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <!-- <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
 -->
             <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock_outline</i>                  
                  <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                  <label for="password-confirm" data-error="No valido" data-success="good">Confirm Password</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
    
</div> 
<!-- 
 -->
                
@endsection

