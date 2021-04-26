@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/search')

@extends('layouts/app')

@section('header')

@if (Cookie::get('token') !== null && !isset($logout))
<button id="btn-add" onclick="window.location='/juegos/add/'">
  <i class="fas fa-plus icon-add"></i>
</button>
@endif

<div style="margin-top: 30px;"></div>
@isset($error)<div class="alert alert-danger index-alert" role="alert" style="margin-top: 30px;"><i class="fas fa-exclamation-circle icon-error"></i><span>{{ $error }}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset
@isset($success)<div class="alert alert-success index-alert" role="alert" style="margin-top: 30px;"><i class="fas fa-check-circle icon-check"></i><span>{{ $success }}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset

@section('search')


@endsection('search')

<!-- Index-1 -->
<div id="index-1">
  @foreach($juegos as $juego)
  <div class="card card-index">
    <div class="card-body">
      <h5 class="card-title">{{ $juego->nombre }}</h5>
      <strong style="font-size: 13px;">{{ $juego->desarrolladora }}</strong>
      <p class="card-text">{{ $juego->descripcion }}</p>
    </div>

    <div class="card-footer">
      <small class="text-muted">{{ $juego->fecha }}</small>
      @if (Cookie::get('token') !== null && !isset($logout))
      <a href="/juegos/delete/{{ $juego->slug }}" onclick="return confirm('¿ Estas seguro de eliminar el juego {{ $juego->nombre }} ?')">
        <div class="button_delete" style="float: right; margin-left: 15px;">
          <i class="fas fa-trash-alt"></i>
      </a>
    </div>
    <a href="/juegos/{{ $juego->slug }}">
      <div class="button_edit" style="float: right;">
        <i class="fas fa-edit"></i>
      </div>
      @endif
    </a>
  </div>
</div>

@endforeach
</div>
<!-- FINAL index-1 -->

<!-- index-2 -->
<div id="index-2">
  @foreach($juegos as $juego)

  <div class="col-md-3 col-xs-12 div-index-2-images">
    <div class="hover01 column">
      <div>
        <figure>
          <div class="open-modal-img" data-toggle="modal" data-target="#ModalJuego">
            <img class="juegos-images" src="{{ $juego->imagen }}" width="240" height="320">
            <input type="hidden" class="modal-juego-nombre" value="{{ $juego->nombre }}">
            <input type="hidden" class="modal-juego-desarrolladora" value="{{ $juego->desarrolladora }}">
            <input type="hidden" class="modal-juego-fecha" value="{{ $juego->fecha }}">
            <input type="hidden" class="modal-juego-descripcion" value="{{ $juego->descripcion }}">
            <input type="hidden" class="modal-juego-slug" value="{{ $juego->slug }}">
          </div>
        </figure>
      </div>
    </div>
    <span><a class="index-2-juego-nombre" href="/juegos/{{ $juego->slug }}">{{ $juego->nombre }}</a></span>
  </div>

  @endforeach

  <!-- Modal -->
  <div class="modal fade" id="ModalJuego" tabindex="-1" role="dialog" aria-labelledby="JuegoModalNombre" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title JuegoModalNombre">Nombre</h5>
          <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-header modal-header-subtitulo">
          <h5 class="modal-title JuegoModalDesarrolladora">desarrolladora</h5>
        </div>
        <div class="modal-body modal-body-content">
          <span class="modal-fecha JuegoModalFecha">fecha</span>
          <div style="margin-top: 10px;"></div>
          <span class="modal-descripcion JuegoModalDescripcion">descripcion</span>
        </div>
        @if (Cookie::get('token') !== null && !isset($logout))
        <div class="modal-footer modal-footer-juego">
          <a type="button" href="#" class="btn btn-danger modal-button-danger" onclick="return confirm('¿ Estas seguro de eliminar el juego ?')"><i class="fas fa-trash-alt modal-icon-trash"></i></a>
          <a type="button" href="#" class="btn btn-warning modal-button-warning"><i class="fas fa-edit modal-icon-edit"></i></a>
        </div>
      </div>
      @endif
    </div>
  </div>

</div>
</div>
<!-- Final index-2 -->

<div style="margin: 0 auto; display: table; margin-bottom: 50px;">
  <div class="col-12 text-center">
    {{ $juegos->links() }}
  </div>
</div>

@endsection('header')


@section('footer')


@endsection('footer')