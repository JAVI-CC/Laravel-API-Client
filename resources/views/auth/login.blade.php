@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #212121; color: white;">{{ __('Iniciar sessión') }}</div>

                <div class="card-body" style="background-color: #1a1a1a;">
                    <form method="POST" action="{{ url("auth/login") }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" style="background-color: #1a1a1a; color: #dee2e6; border: 1px solid #6c757d;" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus>

                                
                                <span class="invalid-feedback" role="alert">
                                    <strong>@isset($error->email['0']){{ $error->email['0'] }}@endisset</strong>
                                </span>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" style="background-color: #1a1a1a; color: #dee2e6; border: 1px solid #6c757d;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <span class="invalid-feedback" role="alert">
                                    <strong>@isset($error->password['0']){{ $error->password['0'] }}@endisset</strong>
                                </span>

                                <span class="invalid-feedback" role="alert">
                                    <strong>@isset($error->error){{ $error->error }}@endisset</strong>
                                </span>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" style="color:white;" for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Acceder') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection