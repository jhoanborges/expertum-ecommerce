@extends('welcome')
@section('content')

<section class="tables mb-5">
    <div class="container mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-3 border-bottom-custom">REESTABLECER <b>Contraseña</b> </div>

                    <div class="card-body m-5 text-center">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" id="form">
                            @csrf
                            <div class="container">
                                <div class="row d-inline-flex ">
                                    <div class="col-sm-12 " >
                                        <div class="form-group">
                                            <label class="required bold black mb-2 title-text">Dirección de Correo (Usuario)</label>
                                                <p>Aplica para Cuentas Activadas</p>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100">
                                            {{ __('CLIC AQUÍ para reestablecer') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>


    @section('extra-js')
        <script src="{{url('js/loadingoverlay.min.js')}}"></script>
        <script>
            const form = document.getElementById('form');
            form.onsubmit = function(){
            $(".super_container").LoadingOverlay("show", {
            image       : "",
            fontawesomeColor: '#0076bd',
            fontawesome : "fas fa-spinner fa-spin",
            });
            };
        </script>
    @endsection

    @include('partials.newsletter')

@endsection
