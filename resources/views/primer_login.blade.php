@extends('layouts.app')
	
@section('title', 'Cambiar contrasena')

@section('content')
    <div class="wrapper">
        <div class="" id="primer-login-background"> 
            <div class="filter-black"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-4 mt-5 text-white text-center mx-auto">
                            <h5>Debes cambiar la contrasena para acceder a la plataforma</h5>
                        </div>
                    </div>
                    <div class="row vertical-center">
                        <div class="col-md-4 col-md-offset-4 mx-auto align-self-center">
                            <div class="password-card wv-50">
                                <h3 class="title text-center orange-color font-weight-bold">Cambiar contrasena!</h3>
                                <form class="register-form" method="POST" action="{{route('changepassword')}}">
                                    @csrf
                                    <br>
                                    <label>Contrasena</label>
                                    
                                    <input name="password" required type="password" class="form-control transparent border border-orange text-white " placeholder="Contrasena">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        <br>
                                    @endif

                                    <br>
                                    <label>Repetir Contrasena</label>
                                    <input name="password_confirmation" min="6" required type="password" class="form-control transparent border border-orange text-white" placeholder="Repetir contrasena">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                    <br>
                                    <button class="btn btn-danger btn-block text-white">Aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>     
        </div>
    </div>      
@endsection