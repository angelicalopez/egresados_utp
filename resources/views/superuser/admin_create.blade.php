@extends('layouts.app')

@section('title', 'Lista de administradores')

@section('content')  
<div class="wrapper">
    <div class="profile-background"> 
        <div class="filter-black"></div>  
    </div>
    @include('layouts.nav_root')
    <div class="profile-content section-nude mb-5">
        <div class="container">
            <div class="row owner mt-3">
                <div class="text-center mx-auto">
                    <div class="name">
                        <h4>Super usuario<br/><small>Panel administrativo</small></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center mx-auto">
                    <p>Aqui puedes agregar nuevos administradores al sistema</p>
                    <br/>
                </div>
            </div>
            <hr>
            @include('layouts.alerts')
            <div class="row mx-auto">
                <div class="col-8 mx-auto">
                    <form class="register-form" method="POST" action="{{ route('admin.store') }}">
                        @csrf

                        <label class="orange-color">Nombres</label>                        
                        <input name="name" required type="text" class="form-control border" placeholder="nombres">
                        @if ($errors->has('nombres'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('nombres') }}</strong>
                            </span>
                            <br>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Apellidos</label>                        
                        <input name="apellidos" required type="text" class="form-control border" placeholder="apellidos">
                        @if ($errors->has('apellidos'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                            </span>
                            <br>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Correo electronico</label>                        
                        <input name="email" required type="email" class="form-control border" placeholder="email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            <br>
                            <br>
                        @endif

                        <label class="orange-color mt-2">DNI</label>
                        <input name="dni" min="8" required type="text" class="form-control border" placeholder="dni">
                        @if ($errors->has('dni'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('dni') }}</strong>
                            </span>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Direccion</label>
                        <input name="direccion" type="text" class="form-control border" placeholder="direccion">
                        @if ($errors->has('direccion'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Telefono</label>
                        <input name="telefono" min="0" type="number" class="form-control border" placeholder="telefono">
                        @if ($errors->has('telefono'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                            </span>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Pais</label>
                        <select name="pais_id" required class="form-control border">
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('pais_id'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('pais_id') }}</strong>
                            </span>
                            <br>
                        @endif

                        <label class="orange-color mt-2">Contrasena</label>                        
                        <input name="password" required type="password" class="form-control border" placeholder="contrasena">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            <br>
                        @endif

                        <br>

                        <button class="btn btn-danger btn-block">Crear administrador</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection