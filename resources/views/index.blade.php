@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/search')

@extends('layouts/app')

@section('header')

@auth
<button id="btn-add" onclick="window.location='/juegos/add/'">
  <i class="fas fa-plus icon-add"></i>
</button>
@endauth

<div style="margin-top: 30px;"></div>
@isset($error)<div class="alert alert-danger index-alert" role="alert" style="margin-top: 30px;"><i class="fas fa-times-circle icon-error"></i><span>{{ $error }}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset
@isset($success)<div class="alert alert-success index-alert" role="alert" style="margin-top: 30px;"><i class="fas fa-check-circle icon-check"></i><span>{{ $success }}</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset

@section('search')


@endsection('search')

@foreach($juegos as $juego)
<div class="card card-index">
  <div class="card-body">
    <h5 class="card-title">{{ $juego->nombre }}</h5>
    <strong style="font-size: 13px;">{{ $juego->desarrolladora }}</strong>
    <p class="card-text">{{ $juego->descripcion }}</p>
  </div>

  <div class="card-footer">
    <small class="text-muted">{{ $juego->fecha }}</small>
    @auth
    <a href="/juegos/delete/{{ $juego->id }}" onclick="return confirm('¿ Estas seguro de eliminar el juego {{ $juego->nombre }} ?')">
      <div class="button_delete" style="float: right; margin-left: 15px;">
        <i class="fas fa-trash-alt"></i>
    </a>
  </div>
  <a href="/juegos/{{ $juego->id }}">
    <div class="button_edit" style="float: right;">
      <i class="fas fa-edit"></i>
    </div>
    @endauth
  </a>
</div>
</div>

@endforeach

<div style="margin: 0 auto; display: table; margin-bottom: 50px;">
  <div class="col-12 text-center">
    {{ $juegos->links() }}
  </div>
</div>

@endsection('header')


@section('footer')


@endsection('footer')