@extends('layouts.app')

@section('title', 'Lista de administradores')

@section('content')  
<div class="wrapper">
    <div class="profile-background"> 
        <div class="filter-black"></div>  
    </div>
    @include('layouts.nav_root')
    <div class="profile-content section-nude">
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
                    <p>Aqui puedes ver la lista de administradores, de igual manera puedes activarlos o desactivarlos facilmente </p>
                    <br/>
                </div>
            </div>
            <hr>
            @foreach($administradores as $admin)
            <div class="row">
                <div class="col-md-7 col-xs-4 text-center mx-auto">
                    <h6>{{ $admin->user->name }} {{ $admin->apellidos }}<br /><small>Administrador</small></h6>
                </div>
                <div class="col-md-3 col-xs-2">
                    <div class="unfollow">
                        <label class="checkbox" for="checkbox1" >
                            <input type="checkbox" value="" id="checkbox1" data-toggle="checkbox" @if($admin->user->estado == 'A') checked @endif>
                        </label>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="row mt-5">
                <div class="text-enter mx-auto">
                    {{ $administradores->links() }}

                </div>

            </div>
        </div>
    </div> 
@endsection