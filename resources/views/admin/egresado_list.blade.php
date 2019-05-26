@extends('layouts.app')

@section('title', 'Lista de egresados')

@section('content')  
<div class="wrapper">
    <div class="profile-background-admin"> 
        <div class="filter-black"></div>  
    </div>
    @include('layouts.nav_admin')
    <div class="profile-content section-nude">
        <div class="container">
            <div class="row owner mt-3">
                <div class="text-center mx-auto">
                    <div class="name">
                        <h4>Administrador<br/><small>Panel administrativo</small></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center mx-auto">
                    <p>Aqui puedes ver la lista de egresado, de igual manera puedes activarlos o desactivarlos facilmente </p>
                    <br/>
                </div>
            </div>
            <hr>
            @foreach($egresados as $egresado)
            <div class="row">
                <div class="col-md-7 col-xs-4 text-center mx-auto">
                <h6>{{ $egresado->user->name }} {{ $egresado->apellidos }}<br /><small>Egresado</small></h6>
                </div>
                <div class="col-md-1 align-middle">
                <a href="{{ route('admin.egresado.edit', $egresado->id) }}"><i class="fas fa-user-edit"></i></a>
                </div>
                <div class="col-md-1 align-middle">
                    <div class="unfollow">
                        <label class="checkbox" for="checkbox1" >
                            <input type="checkbox" value="" id="checkbox1" data-toggle="checkbox" @if($egresado->user->estado == 'A') checked @endif>
                        </label>
                    </div>
                </div>
            </div>
            @endforeach
            

            <div class="row mt-5">
                <div class="text-enter mx-auto">
                    {{ $egresados->links() }}
                </div>

            </div>
        </div>
    </div> 
@endsection