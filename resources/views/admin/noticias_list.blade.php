@extends('layouts.app')

@section('title', 'Lista de noticias')

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
                    <p>Aqui puedes ver la lista de noticias creadas por ti</p>
                    <br/>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-8 col-md-offset-3 text-left mx-auto m-2">
                    @foreach($noticias as $noticia)
                    <div class="card">
                        <div class="card-header text-white bg-orange">
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse1_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse1_{{ $noticia->id }}">Archivos</button>
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse2_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse2_{{ $noticia->id }}">Imagenes</button>
                            <button class="btn align-self-end align-self-center text-white border" type="button" data-toggle="collapse" data-target="#multiCollapse3_{{ $noticia->id }}" aria-expanded="false" aria-controls="multiCollapse3_{{ $noticia->id }}">Videos</button>
                            <a href="{{ route('admin.noticia.edit', $noticia->id) }}" class="btn align-self-end align-self-center text-white border">Editar</a>
                            <button type="button" class="btn align-self-end align-self-center text-white border btn-modal" data-toggle="modal" data-target="#delete_modal" aria-id="{{ $noticia->id }}">Borrar</button>
                            <form method="POST" action="{{ route('admin.noticia.delete', $noticia->id) }}" id="delete_form_{{ $noticia->id }}">
                                @csrf
                                {{ method_field('delete') }}
                                <input type="hidden" name="noticia_id" value="{{ $noticia->id }}">
                            </form>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $noticia->nombre }}</h5>
                            <p class="card-text">{{ $noticia->descripcion }}</p>
                            @foreach($noticia->intereses as $interes)
                                <span class="badge badge-pill badge-secondary">{{ $interes->nombre }}</span>
                            @endforeach
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse1_{{ $noticia->id }}">
                                    <div class="card card-body">
                                        <div class="row">
                                            @foreach($noticia->archivos as $archivo)
                                            <div class="col-s4 border m-1 mx-auto">
                                                <a href="/{{ $archivo->ruta }}">{{ $archivo->nombre }}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse2_{{ $noticia->id }}">
                                    <div class="card card-body text-center">
                                        <div class="row">
                                            @foreach($noticia->imagenes as $imagen)
                                            <div class="col-l4 m-1 border text-center">
                                                <img src="/{{ $imagen->ruta }}" alt="" class="rounded mh-75 w-75">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapse3_{{ $noticia->id }}">
                                    <div class="card card-body">
                                        <div class="row">
                                            @foreach($noticia->videos as $video)
                                            <div class="col-l4 m-1 border text-center mx-auto hv-25">
                                                <iframe src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>

            <div class="row mt-5">
                <div class="text-enter mx-auto">
                    {{ $noticias->links() }}
                </div>

            </div>
        </div>
    </div> 
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var noticia_id = 0;
            $('.btn-modal').on('click', function() {
                noticia_id = $(this).attr('aria-id');
            });

            $('#btn-confirm-delete').on('click', function() {
                $('#delete_form_'+noticia_id).submit();
            });
        });
    </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Confirmar accion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Al borrar la noticia tambien se borraran los archivos multimedia asociados y no podran ser visto por los usuarios
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn-confirm-delete">Confirmar</button>
      </div>
    </div>
  </div>
</div>