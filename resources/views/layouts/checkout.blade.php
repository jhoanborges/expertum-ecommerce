@extends('welcome')
@section('extra-css')
    <style>
        .card {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        }
    </style>
@endsection
@section('content')


    <div class="container mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-4 store_title"><b>FACTURACIÓN Y ENVÍO</b></div>
            </div>
        </div>


        <form class="mb-5" method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="bold black title-text">DATOS DE FACTURACIÓN</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Nombre(s) y Apellido(s) / Razón Social</label>
                            <input id="razon" type="text" class="form-control @error('razon') is-invalid @enderror"
                                name="razon"
                                value="{{ old('razon', Auth::user()->name . ' ' . Auth::user()->apellidos) }}" required
                                autocomplete="razon" readonly="">
                            @error('razon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ old('email', Auth::user()->email) }}" required="required"
                                placeholder="Indica el nombre del destinarario" readonly="">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Tipo de identificación</label>
                            <select class="form-control" id="tipo_identificacion" name="tipo_identificacion"
                                required="required" readonly="">
                                <option disabled selected value="">Seleccionar tipo de identificación</option>
                                @foreach ($identificacion as $idf)
                                    <option value="{{ $idf->id }}"
                                        {{ Auth::user()->tipo_identificacion == $idf->id ? ' selected' : '' }}>
                                        {{ $idf->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Número de identificación</label>
                            <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror"
                                name="numero" value="{{ old('numero', Auth::user()->numeroidentificacion) }}" required
                                autocomplete="numero" readonly="" onkeypress="return isNumberKey(event)">
                            @error('numero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Departamento facturación</label>
                            <input id="state-1" type="text" class="form-control @error('state-1') is-invalid @enderror"
                                name="state-1" value="{{ $depfacturacion }}" required readonly="">
                            <!--
            <select   required="required"  class="form-control state" name="state-1" id="state-1" >
                        <option disabled selected value="">Seleccionar un departamento</option>
                        @foreach ($departamentos as $dep)
    <option value="{{ $dep->id }}">{{ $dep->region }}</option>
    @endforeach
                </select>
                    -->
                            @error('state-1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Ciudad facturación</label>
                            <input id="state-2" type="text" class="form-control @error('state-2') is-invalid @enderror"
                                name="state-2" value="{{ $ciufacturacion }}" required readonly="">
                            <!--
                        <select class="select2city2-1 form-control city" name="city-1" id="city-1" style="width: 100%" required="required">
                    </select>
                    -->
                            @error('stte-2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Dirección de facturación</label>
                            <input id="dirfacturacion" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="dirfacturacion"
                                value="{{ $dirfacturacion }}" required readonly="">

                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Teléfono de faturación</label>
                            <input id="telfacturacion" type="text"
                                class="form-control @error('telfacturacion') is-invalid @enderror" name="telfacturacion"
                                value="{{ $telfacturacion }}" required readonly=""
                                onkeypress="return isNumberKey(event)">

                            @error('telfacturacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


















                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="bold black title-text" style="color:#0076bd">DATOS PARA ENVÍO Y ENTREGA DE LA
                                MERCANCÍA:</label>
                        </div>
                    </div>








                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Entregar a: Nombre(s) y Apellido(s) </label>
                            <input type="text" class="form-control" name="entregar" id="entregar"
                                value="{{ old('entregar', Auth::user()->name . ' ' . Auth::user()->apellidos) }}"
                                required="required" placeholder="Indica el nombre del destinarario">
                            @error('entregar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Teléfono para entrega</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ $telfacturacion }}" required autofocus onkeypress="return isNumberKey(event)">

                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Departamento entrega</label>
                            <select required="required" class="form-control state" name="state" id="state">
                                <option disabled selected value="">Selecciona un departamento</option>
                                @foreach ($departamentos as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->region }}</option>
                                @endforeach
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Ciudad entrega</label>
                            <select class="select2city2 form-control city" name="city" id="city"
                                style="width: 100%" required="required" onchange="handleChangeCity(this);">
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Dirección de entrega</label>
                            <input id="direccion" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="direccion" value="{{ $dirfacturacion }}" required autofocus>

                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>





                    <div class="row">





                        @if (\App\Parametromodelo::first()->show_envio_a_cargo_de_tienda == true || \App\Parametromodelo::first()->show_envio_cargo_de_cliente == true || \App\Parametromodelo::first()->show_recoger_en_tienda == true)
                            <!--show_envio_a_cargo_de_tienda-->
                            <div class="col-sm-6 form-group">
                                <label class="bold black title-text required">Selecciona la opción de envío</label>


                                @if ($parametros->show_envio_a_cargo_de_tienda == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="cargo_tienda" value="cargo_tienda">
                                        <label class="form-check-label" for="cargo_tienda">
                                            Liquidar el flete y pagar en línea
                                        </label>
                                    </div>
                                @endif

                                @if ($parametros->show_envio_cargo_de_cliente == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="cargo_cliente" value="cargo_cliente">

                                        <label class="form-check-label" for="exampleRadios2">
                                            Pago el flete contra entrega del pedido
                                        </label>


                                        <div class="form-group mt-3 mb-3" id="transportista" style="display: none">
                                            <label class="bold black title-text">Nombre de la transportadora</label>
                                            <input type="text" id="typeahead" name="transportista" autocomplete="off"
                                                placeholder="Escriba la transportadora de su preferencia"
                                                class="form-control" />
                                        </div>
                                    </div>
                                @endif

                                @if ($parametros->show_recoger_en_tienda == true)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="recoger_tienda" value="recoger_tienda">
                                        <label class="form-check-label" for="show_recoger_en_tienda">
                                            Prefiero recoger en la tienda
                                        </label>
                                    </div>
                                @endif

                                @error('cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        <div class="col-sm-12 form-group">
                            <label class="bold black title-text">Observaciones de la entrega:</label>
                            <textarea rows="2" input id="observaciones" type="text"
                                class="form-control @error('observaciones') is-invalid @enderror" name="observaciones"
                                value="{{ old('observaciones') }}" autofocus maxlength="300">
                </textarea>
                            @error('observaciones')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>


                <div class="col-sm-12">

                    <div class="card p-2 mt-4">
                        <div class="card-content">
                            <div class="form-group text-center borders mb-0">
                                <img src="{{ asset('img/cart.png') }}" class="img-fluid" width="50">
                            </div>
                        </div>
                        <label class="black mr-2 ml-2 pt-2 text-right">Sub Total
                            <span type="text" name="">${{ formatPrice(intval($total)) }}</span>
                        </label>
                        <label class="black mr-2 ml-2 text-right">Flete $<span type="text" name="flete"
                                id="flete">0</span>
                        </label>
                        <label class="bold mr-2 ml-2 black text-right pb-0 ">Total
                            <span type="text" name="total_summary"
                                id="total_summary">${{ formatPrice(intval($total)) }}</span>
                        </label>
                    </div>
                </div>


                {{-- <div class="callwrapper mt-5 mb-5">
    <div class="main_cont">
        <div class="left_side">	
            <div class="image_col"> <img src="{{asset('img/customer-service.png')}}"> </div>
            <div class="name_col"> <h2>En {{$nombre_tienda}} </h2> <h5>te escuchamos.</h5> </div>    
        </div>
        <a  href="tel:+57{{$telefono1}}">
            <div class="right_side">
                <button type="button" class="audio_call"><img src="https://image.flaticon.com/icons/svg/830/830688.svg" alt=""></button>   
            </div>
        </a>   
    </div>    
    <div class="footer_cont">
        Comunícate a los {{$telefono1}} ó {{$telefono2}} ante cualquier duda.
    </div>    
</div> --}}



                <div class="col-sm-12 form-group mt-4 mb-4 d-flex justify-content-end">
                    <button id="AddPaymentInfo" type="submit" class="btn btn-danger checkout-button">
                        Ir a Pagar $ </button>
                </div>

            </div>


        </form>


    </div>

    @include('partials.newsletter')

@section('extra-js')
    <script src="{{ url('js/loadingoverlay.min.js') }}"></script>
    <script src="{{ url('js/typeahead/bootstrap3-typeahead.min.js') }}"></script>



    <script>
        var route = "{{ url('autocomplete-search') }}";

        $('#typeahead').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>


    <script>
        $(window).on("load", function() {
            console.log("window loaded");
            setTimeout(function() {
                getCheckoutSettingsForStore()

            }, 1500);

        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ route('sql_session') }}",
                dataType: 'json',
                success: function(res) {
                    if (res) {

                        $('.state').val(res.departamento.id).trigger('change')
                        setTimeout(function() {
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
        var precio = 0;

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }



        const getCheckoutSettingsForStore = async (id) => {
            $("#loading-checkout").LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });


            await axios
                .get('{{route('getCheckoutSettingsForStore') }}' )
                .then(res => {
                    let result = res.data;
                    console.log(result)

                    if (
                        result.show_envio_a_cargo_de_tienda === 1 &&
                        result.show_envio_cargo_de_cliente === 1 &&
                        result.show_recoger_en_tienda === 1
                    ) {
                        $("#cargo_tienda").prop("checked", true);

                    } else if (result.show_envio_a_cargo_de_tienda === 1) {
                        $("#cargo_tienda").prop("checked", true);
                        calcularFlete()
                    } else if (result.show_envio_cargo_de_cliente === 1) {
                        $("#cargo_cliente").prop("checked", true);
                        //set input shot
                        $('#transportista').show()
                        //$("[name='transportista']").prop("required", true)

                    } else if (result.show_recoger_en_tienda === 1) {
                        $("#recoger_tienda").prop("checked", true);
                    } else {
                        console.log('nothing]?')
                    }


                })
                .catch(error => {
                    /*
                                    

                          
                    show_envio_cargo_de_cliente: 1
                    show_recoger_en_tienda: 1
                    */
                    //console.log("error");
                    //console.log(error.response);
                    //toastr.error(error.response.data.message);
                })
                .finally(() => {
                    $("#loading-checkout").LoadingOverlay("hide", true);
                });
        };


        function handleChangeCity(city) {

            let value = city.value
            let cargo_tienda = $('#cargo_tienda').val()

            if (cargo_tienda === 'cargo_tienda') {
                calcularFlete()
            }
            //
        }

        function calcularFlete() {
            console.log('calcular flete')
            $("#flete").val(0);

            var departamento = $('.state').val();
            var ciudad = $('.city').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            if (ciudad) {
                $.ajax({
                    type: "POST",
                    data: {
                        state: departamento,
                        city: ciudad,
                    },
                    url: "{{ route('flete_value') }}",

                    beforeSend: function() {
                        $.LoadingOverlay("show", {
                            background: "rgba(165, 190, 100, 0.5)",
                            text: 'Calculando el valor del envío. Por favor espere...',
                            textAutoResize: true,
                            textResizeFactor: 0.2
                        });
                    },
                    success: function(res) {
                        $("#flete").html(parseInt(res).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        }))
                        var sum = parseInt('{{ $total }}') + parseInt(res)
                        $("#total_summary").html(parseInt(sum).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        }))

                        precio = parseInt(sum).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        })
                    },
                    complete: function() {
                        $.LoadingOverlay("hide", true);
                    }
                });
            } else {
                alert('Selecciona una ciudad')
            }
        }


        function handleChange(src) {

            console.log('metodo de envio seleccionado')

            var cargo = src.value
            console.log(cargo)

            if (cargo === 'cargo_cliente') {


                $("#flete").html(0)
                $("#total_summary").html('{{ formatPrice(intval($total)) }}')

                //mostrar transportistas  

                $('#transportista').show()
                $("[name='transportista']").prop("required", true)

            } else if (cargo === 'recoger_tienda') {
                $("#flete").html(0)
                $("#total_summary").html('{{ formatPrice(intval($total)) }}')
                $('#transportista').hide()
                $("[name='transportista']").prop("required", false)

            } else if (cargo === 'cargo_tienda') {

                calcularFlete()
                $('#transportista').hide()
                $("[name='transportista']").prop("required", false)

            } else {
                alert('Selecciona un método d envío.')
            }



        }
    </script>


{{--
    
    <script type="text/javascript">
  var usuario="{{Auth::check() ? Auth::user()->email : 'Usuario no logueado'}}"
  var total= "{{$totalizacion}}"
  var moneda= "{{$moneda_name}}"
  var numero_pedido= "{{$reference}}"

  console.log(usuario)
  console.log(total)
  console.log(moneda)
  console.log(numero_pedido)
</script>


    <!-- add or no pixel code-->
    @if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'iniciar_checkout')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'iniciar_checkout')->first()->code !!}
        @endif
    @endif
--}}
@endsection

@endsection




{{-- }}
        <div class="form-group">
            <label class="required bold black">Dirección</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> --}}
{{-- }}
        <div class="form-group">
            <label class="required bold black">Teléfono</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> --}}




{{-- <div class="form-group">
            <label></label>

            <div class="checkbox pmd-default-theme" style="margin-top: 14px;">
                <label class="pmd-checkbox pmd-checkbox-ripple-effect centered-li">
                    <input type="checkbox" value="true" class="border-rounded" name="facturacion">
                    <span>Usar los mismos datos de facturación</span>
                </label>
            </div>
        </div>


        <div class="form-group mt-4">
            <label class="required bold black">Ciudad</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> --}}

{{-- }}
        <div class="form-group">
            <label class="required bold black">Datos adicionales</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> --}}

{{-- <div class="form-group">
            <label></label>

            <div class="checkbox pmd-default-theme">
                <label class="pmd-checkbox pmd-checkbox-ripple-effect centered-li">
                    <input type="checkbox" value="true" class="border-rounded" name="papel_regalo">
                    <span>Empacado en papel de regalo</span>
                </label>
            </div>
        </div> --}}
