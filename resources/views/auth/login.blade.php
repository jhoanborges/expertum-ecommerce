@extends('welcome')
@section('content')

<section class="tables mb-5">
    <div class="container mb-3 border-bottom">    
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-3 border-bottom-custom"><b>Iniciar Sesión</b>
                </div>   

                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                        <p class="bold black mb-0 title-text">Inicia Sesión</p>
                        <p>Ingresa con tus datos de registro</p>

                        <div class="form-group">
                            <label class="bold black mb-0 title-text">Dirección de Correo (Usuario):</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="bold black mb-0 title-text">Contraseña:</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña. CLIC AQUÍ para reestablecerla') }}
                            </a>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                            <i class="fas fa-unlock-alt mr-2"></i>Ingresar</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="bold black mb-0 title-text">Soy nuevo en este sitio</p>
                        <p>Registro necesario para tramitar el pedido y emitir la factura</p>

                        <div class="form-group">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user mr-2"></i>Registrarme</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</section>


@include('partials.newsletter')


@endsection