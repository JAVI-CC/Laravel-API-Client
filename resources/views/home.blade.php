@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #212121; color: white;">{{ __('Tablero') }}</div>

                <div class="card-body" style="background-color: #1a1a1a; color: white;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Has iniciado sessión!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<?php header("Refresh:4; url=/"); ?>
@endsection
