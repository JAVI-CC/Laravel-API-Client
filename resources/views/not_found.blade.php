@extends('layouts/footer')

@extends('layouts/header')

@extends('layouts/search')

@extends('layouts/app')

@section('header')

@if (Cookie::get('token') !== null)
<button id="btn-add" onclick="window.location='/juegos/add/'">
  <i class="fas fa-plus icon-add"></i>
</button>
@endif

<div style="margin-top: 30px;"></div>

@section('search')


@endsection('search')

<div class="div-not-found col-md-12">
  <div class="div-text-not-found">
    <span class="text-not-found">{{ $error }}</span>
    <div></div>
    <a href="/" class="link-not-found">VOLVER AL INICIO</a>
  </div>
  <i class="fas fa-exclamation icon-exclamation"></i>
  <i class="fas fa-exclamation icon-exclamation"></i>
  <i class="fas fa-exclamation icon-exclamation"></i>
</div>


@endsection('header')


@section('footer')


@endsection('footer')