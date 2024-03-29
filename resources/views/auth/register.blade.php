@extends('welcome')
@section('content')

<div class="container mb-3 border-bottom">
    <div class="row">
        <div class="col-lg-12">
            <div class="big-title mayus mb-4 store_title"><b>FORMULARIO DE REGISTRO...</b>
            </div>
        </div>
    </div>

    <form class="mb-5" method="POST" action="{{ route('register') }}" onsubmit="return validaForm();">
    {{--<form id="form" method="POST">--}}
        @csrf
      <div class="row">

        <div class="col-md-9">

                <div class="row">
                  <div class="col-sm-6 form-group">
                    @if (Route::has('login'))
                    <a class="btn btn-link" href="{{ route('login') }}">
                    {{ __('Ya tengo un usuario. CLIC AQUÍ para iniciar sesión') }}
                    </a>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Nombre(s)</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Apellido(s)</label>
                    <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required="apellido" autofocus>
                    @error('apellido')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Tipo de identificación</label>

                    <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required="required">
                    <option disabled selected value="">Seleccione una opción</option>
                    <!--
                    @foreach ($identificacion as $idf)
                    <option
                    value="{{$idf->id}}"
                    >{{$idf->nombre}}
                    </option>
                    @endforeach
                    -->
                    @foreach ($identificacion as $idf)
                    <option value="{{$idf->id}}" {{ (old("tipo_identificacion") == $idf->id ? "selected":"") }}>{{$idf->nombre}}
                    </option>
                    @endforeach
                    </select>

                    @error('tipo_identificacion')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Número de identificación</label>
                    <input id="numeroidentificacion" type="text" class="form-control @error('numeroidentificacion') is-invalid @enderror" name="numeroidentificacion" value="{{ old('numeroidentificacion') }}" required="numeroidentificacion" onkeypress="return isNumberKey(event)">
                    @error('numeroidentificacion')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Departamento</label>

                    <select   required="required"  class="form-control state" name="state" id="state" >
                    <option disabled selected value="">Seleccione una opción</option>
                    <!--
                    @foreach($departamentos as $dep)
                    <option value="{{$dep->id}}">{{$dep->region}}</option>
                    @endforeach
                    -->
                    @foreach ($departamentos as $dep)
                    <option value="{{$dep->id}}" {{ (old("state") == $dep->id ? "selected":"") }}>{{$dep->region}}
                    </option>
                    @endforeach
                    </select>

                    @error('state')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Ciudad</label>
                    <select class="select2city2 form-control city" name="city" id="city" style="width: 100%" required="required">
                    </select>
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Dirección</label>
                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required="direccion" autofocus>
                    @error('direccion')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Teléfono</label>
                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required="telefono" onkeypress="return isNumberKey(event)">
                    @error('telefono')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Dirección de correo (Usuario)</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="new-password">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                      <span class="ml-1"><a href="/privacidad" target="_blank"><strong>CLIC AQUÍ</strong> para consultar nuestra política de protección de datos personales</a></span>
                    </label>
                  </div>
                </div>

                {{--
                <div class="row">
                  <div class="col-sm-6 form-group">
                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}" data-callback="enabledSubmit">></div>
                    <!--<div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">></div>-->
                    @endif
                  </div>
                </div>
            --}}

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <!--<button type="submit" name="enviar" class="btn btn-primary" id="btnSubmit" disabled=""><i class="fas fa-user mr-2"></i>Aceptar Política y Registrarme</button>-->
                    <button type="submit" name="enviar" class="btn btn-primary" id="btnSubmit"><i class="fas fa-user mr-2"></i>Aceptar Política y Registrarme</button>
                  </div>
                </div>

        </div>
      </div>
    </form>
</div>






@include('partials.newsletter')


@section('extra-js')

<script src="{{url('js/loadingoverlay.min.js')}}"></script>
<script src="{{url('js/toastr_options.js')}}"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script>

  function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }


    $(document).ready(function() {
      function clear_messages(){
        var form =  $("#form")
        form.find('.invalid-feedback').each(function(){
          $(this).remove()
        })
      }


      /*
      $("#form").on("submit", function(e){
        var recaptcha = document.forms["form"]["g-recaptcha-response"].value;
        if (recaptcha == "") {
          toastr.clear()

          const Toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
          });

          Toast.fire({
            type: 'info',
            title: 'El captcha es requerido'
          });
          return false;
        }


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        //var my_name= $('#my_name').val();
        //var my_time=$("input[name=my_time]").val();

        var name= $('#name').val();
        var apellido= $('#apellido').val();
        var tipo_identificacion= $('#tipo_identificacion').val();
        var numeroidentificacion= $('#numeroidentificacion').val();

        var state = $('#state').val();
        var city = $('#city').val();
        var direccion = $('#direccion').val();

        var telefono= $('#telefono').val();
        var email= $('#email').val();
        var password= $('#password').val();
        var passwordconfirm= $('#password-confirm').val();
        //var message= $('#password-confirm').val();

        e.preventDefault()


        var  formData = new FormData();

        formData.append( 'recaptcha', recaptcha);

        formData.append( 'name', name);
        formData.append( 'apellido', apellido);
        formData.append( 'tipo_identificacion', tipo_identificacion);
        formData.append( 'numeroidentificacion', numeroidentificacion);

        formData.append( 'state', state);
        formData.append( 'city', city);
        formData.append( 'direccion', direccion);


        formData.append( 'telefono', telefono);
        formData.append( 'email', email);
        formData.append( 'password', password);
        formData.append( 'password-confirm', passwordconfirm);


        $.ajax({
          type:'POST',
          url:'{{ route('register') }}',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend:function() {

             $('.super_container').LoadingOverlay("show", {
               image       : "",
               fontawesome : "fas fa-spinner fa-spin",
               fontawesomeColor: "#00922E"
             });

          },
          success: function(response){
            clear_messages();

            toastr.clear()
            //alert(response);
            //console.log(response);

            //alert()->success('¡Enhorabuena!','Tu cuenta ha sido creada exitosamente. Hemos enviado un correo electrónico a ' .$request->email.'');

            if (response == 'ok'){
                var testVar = "Cuenta creada exitosamente. Para comprobar que " + email + " es tu dirección de correo, te hemos enviado un mensaje de confirmación. " +
                "Si no lo encuentras en la BANDEJA DE ENTRADA, te sugerimos revisar en la carpeta SPAM" ;
                Swal.fire(testVar).then(function() {
                  window.location = "{{ route('home') }}";
                    });
            }
            else{
                var testVar = "No se ha podido crear el usuario. Es posible que ya exista en la base de datos. Intenta reestablecer contraseña." ;
                Swal.fire(testVar).then(function() {
                });
            }


            $('.super_container').LoadingOverlay("hide")
            $("#form").trigger("reset");
            toastr["success"](response.message)
          },

          error:function (xhr, ajaxOptions, thrownError){
            clear_messages();
            $('.super_container').LoadingOverlay("hide")


            toastr.clear()

            if (xhr.responseJSON.errors) {
              $.each(xhr.responseJSON.errors, function(key, value){
                console.log(value)
                toastr["error"](value)
              });

              return false;

            }
          }

        })
      });
      */


    });


    function validaForm() {
      if ($('#password').val() !=  $('#password-confirm').val()){
        //alert("Confirmación de contraseña inválida");
        toastr["error"]('Confirmación de contraseña inválida');
        return false;
      }
/*
      var response = grecaptcha.getResponse();

      if(response.length == 0){
        //alert("Captcha no verificado")
        var testVar = "reCAPTCHA no válido." ;
          Swal.fire(testVar).then(function() {
        });
        return false;
      } else {
        //alert("Captcha verificado");

      }
      return true;
  */

      //$('#password').val();
      //$('#password-confirm').val();


       /*
       var response = grecaptcha.getResponse();

        if(response.length == 0){
          //alert("Captcha no verificado")
          var testVar = "reCAPTCHA no válido." ;
            Swal.fire(testVar).then(function() {
          });
          return false;
        } else {
          //alert("Captcha verificado");

        }
        */
    }


    /*
    function enabledSubmit(response) {
      alert("que pasa");
      //document.getElemenstByName("enviar")[0].disabled = false;
      document.getElemenstById("btnSubmit").disabled = false;
    }
    */




  </script>

@endsection

@endsection
