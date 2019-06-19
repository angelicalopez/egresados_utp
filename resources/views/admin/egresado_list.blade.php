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
            @include('layouts.alerts')
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
                <div class="col-md-1 py-2">
                    <a class="deco-none" href="{{ route('admin.egresado.edit', $egresado->id) }}"><i class="fas fa-user-edit fa-lg"></i></a>
                </div>
                <div class="col-md-1">
                    <div class="unfollow">
                        <label class="checkbox" for="checkbox1" >
                            <input type="checkbox" value="" id="checkbox1" data-toggle="checkbox" @if($egresado->user->estado == 'A') checked @endif>
                        </label>
                    </div>
                </div>
                <div class="col-md-1 py-2">
                    <a href="#!" class="deco-none modal-delete" aria-id="{{ $egresado->id }}" data-toggle="modal" data-target="#delete_egresado_modal"><i class="fas fa-trash fa-lg"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="delete_egresado_modal" tabindex="-1" role="dialog" aria-labelledby="deleteEgresadoModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteEgresadoModal">Confirmar accion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('egresado.delete') }}">
            <div class="modal-body">
                    @csrf
                    {{ method_field('delete') }}
                    <h6 class="text-center orange-color">Esta seguro que desea borrar el egresado?</h6>                        
                    <input id="delete_egresado_input" name="egresado_id" type="hidden" value="0">
                    <p class="text-justify">Esta accion es irreversible, se perderan los datos del egresado y no podra volver a ingresar</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-confirm-delete">Confirmar</button>
            </div>
            </form>
        </div>
      </div>
    </div>  
@endsection

@section('scripts')
    <script src="{{ asset('js/egresados/delete.js') }}"></script>
@endsection