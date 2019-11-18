@extends('welcome')
@section('extra-css')
<style >
    .card {
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  }
</style>
@endsection
@section('content')

<div class="container mb-3 border-bottom">
    <div class="row">
      <div class="col-lg-12">
        <div class="big-title mayus mb-4 store_title"><b>DATOS DE FACTURACIÓN</b></div>
    </div>
</div>


<form class="mb-5" method="POST" action="{{route('checkout.store')}}">
    @csrf
    <div class="row">
        <div class="col-md-5">


            <div class="form-group">
                <label class="required bold black">Nombre(s) y Apellido(s) / Razón Social</label>
                <input id="razon" type="text" class="form-control @error('razon') is-invalid @enderror" name="razon" value="{{ old('razon') }}" required autocomplete="razon" autofocus>

                @error('razon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="required bold black">Tipo de identificación</label>
                <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required="required">
                    <option disabled selected value="">Seleccione una opción</option>
                    @foreach ($identificacion as $idf)
                    <option
                    value="{{$idf->id}}" {{(Auth::user()->tipo_identificacion == $idf->id ) ? ' selected' : '' }}
                    >{{$idf->nombre}}
                </option>
                @endforeach
            </select>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



        <div class="form-group">
            <label class="required bold black">Número</label>
            <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{old('numero', Auth::user()->numeroidentificacion ) }}" required autocomplete="numero" autofocus>

            @error('numero')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="required bold black">Departamento</label>
            <select   required="required"  class="form-control state" name="state" id="state" >
                <option disabled selected value="">Seleccione una opción</option>
                @foreach($departamentos as $dep)
                <option value="{{$dep->id}}">{{$dep->region}}</option>
                @endforeach
            </select>
            @error('state')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group">
            <label class="required bold black">Ciudad</label>
            <select class="select2city2 form-control city" name="city" id="city" style="width: 100%" required="required">
            </select>
            @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

{{--}}
        <div class="form-group">
            <label class="required bold black">Dirección</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        --}}
        <div class="form-group">
            <label class="bold black">Datos adicionales</label>
            <input id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" value="{{ old('observaciones') }}" autofocus maxlength="191">

            @error('observaciones')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

{{--}}
        <div class="form-group">
            <label class="required bold black">Teléfono</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        --}}

    </div>



    <div class="col-md-5">


        <div class="form-group">
            <label></label>

            <div class="checkbox pmd-default-theme" style="margin-top: 14px;">
                <label class="pmd-checkbox pmd-checkbox-ripple-effect centered-li">
                    <input type="checkbox" value="true" class="border-rounded" name="facturacion">
                    <span>Usar los mismos datos de facturación</span>
                </label>
            </div>
        </div>

{{--
        <div class="form-group mt-4">
            <label class="required bold black">Ciudad</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        --}}
        <div class="form-group">
            <label class="required bold black">Email</label>
            <input  type="email" class="form-control" name="email" id="email" value="{{ old('email',Auth::user()->email )}}" required="required" placeholder="Indica el nombre del destinarario">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group">
            <label class="required bold black">Dirección de entrega</label>
            <input id="direccion" type="text" class="form-control @error('name') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autofocus>

            @error('direccion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
{{--}}
        <div class="form-group">
            <label class="required bold black">Datos adicionales</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        --}}
        <div class="form-group">
            <label class="required bold black">Teléfono</label>
            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('name') }}" required  autofocus>

            @error('telefono')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="required bold black">Entregar a: Nombre (s) y Apellido (s) </label>
            <input  type="text" class="form-control" name="entregar" id="entregar" value="{{ old('entregar', Auth::user()->name .' '. Auth::user()->apellidos )}}" required="required" placeholder="Indica el nombre del destinarario">

            @error('entregar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label></label>

            <div class="checkbox pmd-default-theme">
                <label class="pmd-checkbox pmd-checkbox-ripple-effect centered-li">
                    <input type="checkbox" value="true" class="border-rounded" name="papel_regalo">
                    <span>Empacado en papel de regalo</span>
                </label>
            </div>
        </div>


        <div class="form-group mt-4 mb-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-danger checkout-button">
            Continuar</button>
        </div>




    </div>


    <div class="col-md-2">

      <div class="card p-2">
        <div class="card-content">
            <div class="form-group text-center borders mb-0">
              <img src="{{ asset('img/cart.png') }}" class="img-fluid" width="50">
          </div>
      </div>

      <label class="black text-right  pt-3">Flete $
        <span  type="text" name="flete" id="flete">-------</span>
    </label>


    <label class="bold black text-right pb-2 ">Total $
        <span  type="text" name="total_summary" id="total_summary">{{formatPrice(intval($total) )}}</span>
    </label>

</div>



</div>
</div>


</form>


</div>

@include('partials.newsletter')

@section('extra-js')

<script>
   $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'post',
        url: "{{ route('sql_session') }}",
        dataType : 'json',
        success:function(res){
            if (res) {

                $('.state').val(res.departamento.id).trigger('change')
                setTimeout(function(){
                    $('.city').val(res.ciudad.id).trigger('change')
                }, 500);
            }
        },
        error: function() {

        }
    })
})

</script>


<script>


    $(function () {

        $('.select2city2').on('select2:select change', function (e) {
            $("#flete").val('');
            var departamento =  $('.select2estado2').val();
            var ciudad = $('.select2city2').val();
            e.preventDefault()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            if (ciudad) {
                $.ajax({
                    type:"POST",
                    data:{
                        state:departamento,
                        city:ciudad,
                    },
                    url:"{{ route('flete_value') }}",

                    beforeSend: function() {
                    },
                    success:function(res){
                        $("#flete").html(parseInt(res).toLocaleString('de-DE',{ minimumFractionDigits: 0 }) )
                        var sum= parseInt('{{$total}}') + parseInt(res)
                        $("#total_summary").html(parseInt(sum).toLocaleString('de-DE',{ minimumFractionDigits: 0 }))
                    }
                });
            }

        });
    });
</script>
@endsection

@endsection
