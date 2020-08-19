@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/app')

@section('title', 'Añadir juego')

@section('header')          

<!-- HTML -->
@isset($error)<div class="alert alert-danger" role="alert" style="margin-top: 30px;"><i class="fas fa-times-circle icon-error"></i>Corrige los siguientes errores:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset

<form method="POST" action="{{ url("juegos/add") }}">
    @csrf 

  <div class="form-group">
    <label class="input-title">Titulo:</label>
    <input type="text" name="nombre" class="form-control input-titulo" value="@isset($values['nombre']){{$values['nombre']}}@endisset" placeholder="Titulo" style="@isset($error->nombre['0']) border-color: red; @endisset">
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->nombre['0']) {{ $error->nombre['0'] }} @endisset</small>
  </div>
  <div class="row">
    <div class="col col-md-8 col-xs-12">
      <label class="input-title">Desarrolladora:</label>
      <input type="text" name="desarrolladora" class="form-control input-desarrolladora" value="@isset($values['desarrolladora']){{$values['desarrolladora']}}@endisset" placeholder="Desarrolladora" style="@isset($error->desarrolladora['0']) border-color: red; @endisset">
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->desarrolladora['0']) {{ $error->desarrolladora['0'] }} @endisset</small>
    </div>
    <div class="col col-md-4 col-xs-12">
      <label class="input-title">Fecha:</label>
      <input type="date" name="fecha" class="form-control input-fecha" value="@isset($values['fecha']){{$values['fecha']}}@endisset" placeholder="Fecha" style="@isset($error->fecha['0']) border-color: red; @endisset">
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->fecha['0']) {{ $error->fecha['0'] }} @endisset</small>
    </div>
  </div>
  <div class="form-group" style="margin-top: 15px;">
    <label class="input-title">Descripción:</label>
    <textarea class="form-control input-descripcion" name="descripcion" rows="3" placeholder="Descripción..." maxlength="255" style="@isset($error->descripcion['0']) border-color: red; @endisset">@isset($values['descripcion']){{$values['descripcion']}}@endisset</textarea>
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->descripcion['0']) {{ $error->descripcion['0'] }} @endisset</small>
  </div>
  <button type="submit" class="btn btn-success" style="color: white;">Añadir</button>
  <div style="margin-bottom: 30px;"></div>
</form>

@endsection