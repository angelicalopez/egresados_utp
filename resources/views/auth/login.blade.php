@extends('layouts.app')
	
@section('title', 'Iniciar sesion')

@section('content')
    <div class="wrapper">
        <div class="register-background"> 
            <div class="filter-black"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 mx-auto">
                            <div class="register-card">
                                <h3 class="title">Bienvenido!</h3>
                                <form class="register-form" method="POST">
                                    @csrf
                                    <label>Correo electronico</label>
                                    
                                    <input name="email" required type="email" class="form-control" placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        <br>
                                    @endif

                                    <label>Contrasena</label>
                                    <input name="password" min="6" required type="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <button class="btn btn-danger btn-block">Iniciar sesion</button>
                                </form>
                                <div class="forgot">
                                    <a href="#" class="btn btn-simple btn-danger">Olvide mi contrasena</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
        </div>
    </div>      
@endsection