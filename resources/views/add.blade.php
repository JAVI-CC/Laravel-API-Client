@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/app')

@section('title', 'Añadir juego')

@section('header')

<!-- HTML -->
@isset($error)<div class="alert alert-danger" role="alert" style="margin-top: 30px;"><i class="fas fa-times-circle icon-error"></i>Corrige los siguientes errores:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset

<form enctype="multipart/form-data" method="POST" action="{{ url("juegos/add") }}" >
  @csrf

  <div class="form-group">
    <label class="input-title">Titulo:</label>
    <input type="text" name="nombre" class="form-control input-titulo" value="@isset($values['nombre']){{$values['nombre']}}@endisset" placeholder="Titulo" style="@isset($error->nombre['0']) border-color: red; @endisset">
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->nombre['0']) {{ $error->nombre['0'] }} @endisset</small>
  </div>
  <div class="row div-input-des-fecha">
    <div class="col col-md-8 col-xs-12 input-des">
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

  <div class="form-group" style="margin-top: 15px; margin-bottom: 40px">
    <div class="col col-md-5 col-xs-12" style="padding-left: 0px;">
      <label class="input-title">Seleccionar imagen:</label>
      <div class="">
        <input type="file" name="imagen" class="input-file" style="width: 100%;">
        <div class="input-group col-xs-12">
          <span class="input-group-addon"><i class="fa fa-video-camera"></i></span>
          <span class="input-group-btn">
            <button class="upload-field btn btn-imagen" type="button" style="@isset($error->imagen['0']) border-color: red; @endisset"><i class="fas fa-image" style="font-size: 20px;"></i></button>
          </span>
          <input type="text" class="form-control input-upload" disabled placeholder="Ningún archivo seleccionado" style="@isset($error->imagen['0']) border-color: red; @endisset">
        </div>
      </div>
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->imagen['0']) {{ $error->imagen['0'] }} @endisset</small>
    </div>
  </div>

  <button type="submit" class="btn btn-success" style="color: white;">Añadir</button>
  <div style="margin-bottom: 170px;"></div>
</form>

@endsection