@extends('welcome')

@section('content')

    <div class="container mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-4 store_title "><b>Detalles de la transacción</b> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex text-center justify-content-center">


                <div class="jumbotron d-inline-flex ">

                    <div class="rows-col">

                        <img src="{{ 'img/check.png' }}" width="100" height="100" class="mb-3">

                        <div class="col">
                            <div class="d-inline-flex">
                                <h5 class="mayus mr-2 bold">Estatus:</h5>
                                <h5>{{ $_REQUEST['estadoTx'] }}</h5>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-inline-flex">
                                <h5 class="mayus mr-2 bold">método de pago:</h5>
                                <h5>{{ $_REQUEST['metodopago'] }}</h5>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-inline-flex">
                                <h5 class="mayus mr-2 bold">tipo de pago:</h5>
                                <h5>{{ $_REQUEST['tipopago'] }}</h5>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-inline-flex">
                                <h5 class="mayus mr-2 bold">monto:</h5>
                                <h5> {{ formatPrice($_REQUEST['valor']) }}</h5>
                            </div>
                        </div>

                        <button type="button" class="btn btn-transparent mt-3" onClick="window.print()">
                            <i class="fas fa-print fa-2x" style="color:#4c4c4c"></i>
                        </button>


                    </div>


                </div>


            </div>





        </div>



    </div>

    @include('partials.newsletter')

@section('extra-js')
    <script src="{{ url('js/loadingoverlay.min.js') }}"></script>
    <script src="{{ url('js/toastr_options.js') }}"></script>

    <script type="text/javascript">
        var moneda = ""
        var precio = "{{ request()->valor }}"
        var estado_transaccion = "{{ request()->estadoTx }}"
        var user="{{Auth::check() ? Auth::user()->email : 'Usuario no logueado'}}"
        
        console.log(estado_transaccion)
        //- Usuario
        //- Pedido
        //- Valor
        //- Nombre Pasarela
        //- Medio de pago
    </script>

    <!-- add or no pixel code-->
    @if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'comprar')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'comprar')->first()->code !!}
        @endif
    @endif
@endsection

@endsection
