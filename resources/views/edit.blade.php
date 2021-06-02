@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/app')

@section('title', 'Editar juego')

@section('header')          

@isset($error->generos['0'])
<style>
.choices__inner {
  border: 1px solid red!Important;
}
</style>
@endisset

<!-- HTML -->

<input type="hidden" value="{{$fecha = null}}">
@isset($juego->fecha)
  <input type="hidden" value="{{$fecha = $juego->fecha}}">
@endisset 

@isset($values['fecha'])
  <input type="hidden" value="{{$fecha = $values['fecha']}}">
@endisset

@isset($error)<div class="alert alert-danger" role="alert" style="margin-top: 30px;"><i class="fas fa-exclamation-circle icon-error"></i>Corrige los siguientes errores:<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endisset

<form enctype="multipart/form-data" method="POST" action="{{ url("juegos/edit") }} ">
    @csrf
    @method('POST')  
  <div class="form-group">
    <label class="input-title">Titulo:</label>
    <input type="text" name="nombre" class="form-control input-titulo" value="@isset($juego->nombre){{$juego->nombre}}@endisset
    @isset($values['nombre']){{$values['nombre']}}@endisset" style="@isset($error->nombre['0']) border-color: red; @endisset" placeholder="Titulo">
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->nombre['0']) {{ $error->nombre['0'] }} @endisset</small>
  </div>
  <div class="row">
    <div class="col col-md-8 col-xs-12 mobile-margin-bottom-16">
      <label class="input-title">Desarrolladora:</label>
      <input type="text" name="desarrolladora" class="form-control input-desarrolladora" value="@isset($juego->nombre){{$juego->desarrolladora->nombre}}@endisset @isset($values['desarrolladora']){{$values['desarrolladora']}}@endisset" style="@isset($error->desarrolladora['0']) border-color: red; @endisset" placeholder="Desarrolladora">
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->desarrolladora['0']) {{ $error->desarrolladora['0'] }} @endisset</small>
    </div>
    <div class="col col-md-4 col-xs-12">
      <label class="input-title">Fecha:</label>
      <input type="date" name="fecha" class="form-control input-fecha" value="{{ $fecha }}" style="@isset($error->fecha['0']) border-color: red; @endisset" placeholder="Fecha">
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->fecha['0']) {{ $error->fecha['0'] }} @endisset</small>
    </div>
  </div>
  <div class="form-group" style="margin-top: 15px;">
    <label class="input-title">Descripción:</label>
    <textarea class="form-control input-descripcion" name="descripcion" rows="3" placeholder="Descripción..." maxlength="255" style="@isset($error->descripcion['0']) border-color: red; @endisset">@isset($juego->descripcion){{$juego->descripcion}}@endisset @isset($values['descripcion']){{$values['descripcion']}}@endisset</textarea>
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->descripcion['0']) {{ $error->descripcion['0'] }} @endisset</small>
  </div>

  <div class="form-group" style="margin-bottom: 30px;">
    <label class="input-title">Generos:</label>
    <div class="row d-flex mt-100 div-flex-selec-multipe">
      <div class="col-md-6 div-md-select-multiple"> 
        <select id="choices-multiple-remove-button" name="generos[]" placeholder="Selecciona hasta 5 generos" multiple style="border:right;">
        @if(!isset($error))
          @foreach($juego->generos as $genero)
            <option value="{{$genero->slug}}" selected>{{$genero->nombre}}</option>
          @endforeach
        @endif
        
        @isset($values['generos'])
          @foreach($values['generos'] as $genero)
            <option value="{{$genero}}" selected>{{$genero}}</option>
          @endforeach
        @endisset

        @foreach($generos as $genero)
          @if(!isset($error))
            <option value="{{$genero->slug}}">{{$genero->nombre}}</option>
          @else
            <option value="{{$genero->nombre}}">{{$genero->nombre}}</option>
          @endif
        @endforeach
        </select> 
      </div>
    </div>
    <div style="margin-top: 5px;"></div>
    <small style="color: red;">@isset($error->generos['0']) {{ $error->generos['0'] }} @endisset</small>
    <span style="display: none;">{{$i='generos.0'}}</span>
  </div>

  <div class="div-cambiar-imagen">
    <label class="input-title" style="margin-right: 10px;">Actualizar imagen:</label>
      <label class="switch">
      <input class="int-input-check" type="checkbox">
      <div class="slider round"></div>
    </label>
  </div>

  <div class="form-group" style="margin-top: 15px; margin-bottom: 40px">
    <div class="col col-md-5 col-xs-12 div-form-imagen" style="padding-left: 0px;">
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
        <span style="color: white; font-size: 11px">Se recomienda mantener una relación de aspecto de 300x400</span>
      </div>
      <div style="margin-top: 5px;"></div>
      <small style="color: red;">@isset($error->imagen['0']) {{ $error->imagen['0'] }} @endisset</small>
    </div>
  </div>

  <input type="hidden" name="slug" value="@isset($juego->slug){{$juego->slug}}@endisset @isset($values['slug']){{$values['slug']}}@endisset">

  <button type="submit" class="btn btn-warning" style="color: white;">Actualizar</button>
  <div style="margin-bottom: 145px;"></div>
</form>

@endsection


