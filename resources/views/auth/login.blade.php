@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tarjeta">
               <div class="row">
                    <div class="col-md-5 logo_liwru">
                        <div class="arriba">
                            <img width="30%" src="{{ asset('imgs/logo_liwru.png') }}" class="img-fluid" alt="">
                            <h2>Inicio de Sesión</h2>
                        </div>
                        
                    </div>
                    <div class="col-md-7 fondo-blanco">
                        <form  method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group ">
                                <input placeholder="Correo Electrónico" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                     @endif
                            </div>
                            <div class="form-group">
                                <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="boton hecho float-right">Iniciar Sesión</button>
                                <!--<a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>-->
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group mt-4">
                                <p class="text-justify">* Si aún no tienes con una cuenta, acércate a la Biblioteca Pública Municipal Ignacio Escudero a registrarte.</p>
                            </div>
        
                        </form>
                    </div>
               </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
