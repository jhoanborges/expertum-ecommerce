@extends('welcome')
@section('content')

<div class="container mb-3 border-bottom">
    <div class="row">
      <div class="col-lg-12">
        <div class="big-title mayus mb-4 store_title ">Registrarme</div>
    </div>
</div>


<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">

            <p class="bold black mb-2 title-text">Formulario de registro</p>
            <p>Completa tus datos personales</p>

            <div class="form-group">
              @if (Route::has('login'))
              <a class="btn btn-link" href="{{ route('login') }}">
                {{ __('¿Tienes un usuario?') }}
            </a>
            @endif
        </div>

    </div>



    <div class="col-md-6">

      <form method="POST" action="{{ route('register') }}">
        @csrf


        <div class="form-group">
            <label class="bold required black">Nombre</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="form-group">
            <label class="bold required black">Apellido</label>
            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

            @error('apellido')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>


        <div class="form-group">
            <label class="bold black required">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="bold black required">Contraseña</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="bold black required">Confirmar contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>


        <div class="form-group">
            <div class="checkbox pmd-default-theme">
                <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                    <input type="checkbox" value="">
                    <span class="mr-1">Acepto.</span>
                    <span class="ml-1">Consulta nuestra política de protección de datos aquí</span>

                </label>
            </div>

        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user mr-2"></i>Registrarme</button>
            </div>

        </form>




    </div>


</div>
</form>
</div>


@include('partials.newsletter')


@endsection
