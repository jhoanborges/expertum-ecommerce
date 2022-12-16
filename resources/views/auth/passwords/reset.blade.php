@extends('welcome')
@section('content')

<section class="tables mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                {{--<div class="big-title mayus mb-3 border-bottom-custom">REESTABLECE <b>tu contraseña</b> </div>--}}

                @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body m-5 text-center">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="container">
                            <div class="row d-inline-flex ">

                                <div class="form-group row d-none">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-12">

                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12 " >
                                    <div class="form-group">
                                        <label class="required bold black">Password</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" maxlength="191">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 " >
                                    <div class="form-group">

                                        <label class="required bold black">Confirmar Password</label>
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" maxlength="191">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 " >
                                    <div class="form-group row text-center">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('CLIC AQUÍ para reestablecer contraseña') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>



@section('extra-js')
<script src="{{url('js/loadingoverlay.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#form').on('submit', function(e){
            $(".super_container").LoadingOverlay("show", {
              image       : "",
              fontawesomeColor: '#0076bd',
              fontawesome : "fas fa-spinner fa-spin",
          });
        });
    });
</script>

@endsection

@endsection


















