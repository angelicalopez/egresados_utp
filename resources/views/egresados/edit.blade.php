@extends('layouts.app')

@section('title', 'Editar perfil')

@section('content')
    @include('layouts.nav_egresado')
    <div class="navbar-egresado"></div>
    <div class="container p-3">
        @include('layouts.alerts')
        <div class="row mx-auto">
            <div class="col-8 mx-auto">
                <form class="register-form" method="POST" action="{{ route('egresado.updateegresado', $user->egresado->id) }}">
                    @csrf
                    {{ method_field('put') }}

                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="egresado_id" value="{{ $user->egresado->id }}">

                    <label class="orange-color">Nombres</label>                        
                    <input name="name" required type="text" class="form-control border" placeholder="nombres" value="{{$user->name}}">
                    @if ($errors->has('nombres'))
                        <span class="help-block">
                                <strong>{{ $errors->first('nombres') }}</strong>
                        </span>
                        <br>
                        <br>
                    @endif

                    <label class="orange-color mt-2">Apellidos</label>                        
                    <input name="apellidos" required type="text" class="form-control border" placeholder="apellidos" value="{{$user->egresado->apellidos}}">
                    @if ($errors->has('apellidos'))
                        <span class="help-block">
                                <strong>{{ $errors->first('apellidos') }}</strong>
                        </span>
                        <br>
                    @endif

                    <label class="orange-color mt-2">Correo electronico</label>                        
                    <input name="email" required type="email" class="form-control border" placeholder="email" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        <br>
                    @endif

                    <label class="orange-color mt-2">DNI</label>
                    <input name="dni" min="8" required type="text" class="form-control border" placeholder="dni" value="{{ $user->egresado->dni }}">
                    @if ($errors->has('dni'))
                        <span class="help-block">
                                <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                        <br>
                    @endif

                    <label class="orange-color mt-2">Genero</label>
                    <select name="genero" required class="form-control border">
                        <option value="M" @if($user->egresado->genero == 'M') selected @endif>Masculino</option>
                        <option value="F" @if($user->egresado->genero == 'F') selected @endif>Femenino</option>
                    </select>
                    @if ($errors->has('genero'))
                        <span class="help-block">
                            <strong>{{ $errors->first('genero') }}</strong>
                        </span>
                        <br>
                    @endif
                    
                    <label class="orange-color mt-2">Manejo de datos</label>
                    <select name="manejo_datos" required class="form-control border">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    @if ($errors->has('manejo_datos'))
                        <span class="help-block">
                            <strong>{{ $errors->first('manejo_datos') }}</strong>
                        </span>
                        <br>
                    @endif

                    <label class="orange-color mt-2">Edad</label>
                    <input type="numeric" min="14" name="edad" class="form-control border" placeholder="edad" value="{{ $user->egresado->edad }}">
                    @if ($errors->has('edad'))
                        <span class="help-block">
                            <strong>{{ $errors->first('edad') }}</strong>
                        </span>
                        <br>
                    @endif

                    
                    <label class="orange-color mt-2">Pais</label>
                    <select name="pais_id" required class="form-control border">
                        @foreach($paises as $pais)
                            @if($user->egresado->pais_id == $pais->id)
                                <option value="{{ $pais->id }}" selected>{{ $pais->nombre }}</option>
                            @else
                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('pais_id'))
                        <span class="help-block">
                                <strong>{{ $errors->first('pais_id') }}</strong>
                        </span>
                        <br>
                    @endif

                    <label class="orange-color mt-2">Contrasena</label>                        
                    <input name="password" type="password" class="form-control border" placeholder="contrasena">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        <br>
                    @endif
                    
                    <br>

                    <button class="btn btn-danger btn-block">Editar egresado</button>
                </form>
            </div>
        </div>
    </div>
@endsection