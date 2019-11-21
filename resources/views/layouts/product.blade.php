@extends('welcome')

@section('extra-meta')
<meta property="og:description" content="{{$producto->descripcion}}" />
<meta property="og:image" content="{{$allImages->first()->urlimagen}}" />
<meta property="og:url" content="{{\URL::current()}}" />
<meta property="og:type" content="product" />
<meta property="og:title" content="{{$producto->nombre_producto}}" />
<meta property="og:image:alt" content="{{$producto->nombre_producto}}" />
<meta property="fb:app_id" content="545837192560177" />

@endsection


@section('extra-css')
<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/electro.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/lightgallery/lightgallery.css')}}">

@endsection
@section('content')
<form action="{{route('resumen.store')}}" method="POST" class="form-prevent">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$producto->slug}}">
    <!-- SECTION -->
    <div class="section mt-1">
        <!-- container -->
        <div class="container">



            <!-- row -->
            <div class="row border-bottom-custom">
                <div class="col-sm-10 mb-5">

                    {{ Breadcrumbs::render() }}

                    <!--<div class="store_title mayus mb-2">CIENCIA - <b>EXPERIMENTOS</b> </div>-->
                    <div class="row mt-4">

                        <!-- Product main img -->
                        <div class="col-md-6">
                            <div id="product-main-img">

                                @foreach ($allImages as $allImage)
                                <div class="product-preview thumbnail">
                                    <img src="{{url($allImage->urlimagen)}}" alt="{{url($allImage->urlimagen)}}">
                                </div>

                                @endforeach
                            </div>


                            <!-- Product thumb imgs -->
                            <div class="col-md-12">
                                <div id="product-imgs">

                                 @foreach ($allImages as $allImage)
                                 <div class="product-preview ">
                                    <img src="{{url($allImage->urlimagen)}}" class="img-fluid" alt="{{url($allImage->urlimagen)}}">
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- /Product thumb imgs -->


                    </div>
                    <!-- /Product main img -->




                    <!-- Product details -->
                    <div class="col-md-6">
                        <div class="product-details ">
                            <div class="border-bottom-custom">

                                <h2 class="product-name">{{$producto->nombre_producto}}</h2>
                                <h3 class="product-name mt-2 fs-16">{{$producto->getMarcaProduct($producto->id)['nombre'] }}</h3>
                                <h3 class="mt-2 mb-3 bold">
                                    {{'$'. number_format((float)  precioNew($producto->slug) , 0, ',', '.' )}}
                                </h3>
                            </div>

                            <div class="d-block mb-2 mt-1">
                               <div class="row no-gutters ">
                                   <div class="col-sm-6">
                                       Ref. {{$producto->referencia}}
                                   </div>
                                   <div class="col-sm-6">
                                    <span class="float-right">Stock:
                                        @if($producto->cantidad_critica)
                                        @if(!$producto->cantidad==0)
                                        @if( $producto->cantidad_critica >= $producto->cantidad )
                                        Pocas unidades
                                        @else
                                        Disponible
                                        @endif
                                        @else
                                        No disponbile
                                        @endif
                                        @else
                                        @if($param->cantidad_critica)
                                        @if(!$producto->cantidad==0)
                                        @if( $param->cantidad_critica >= $producto->cantidad )
                                        Pocas unidades
                                        @else
                                        Disponible
                                        @endif
                                        @else
                                        No disponbile
                                        @endif
                                        @else
                                        Disponible
                                        @endif
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom-custom">
                            <p class="mt-3 expander">{{str_limit($producto->descripcion, 1500)}}</p>
                            <div class="d-block mb-4 mt-1">
                               <div class="row no-gutters h-100">
                                <div class="col-lg-3">
                                    <label>Cantidad</label>
                                    <div class="d-inline-block">

                                      <div class="qty-box">

                                        <input type='button' value='-' class='qtyminus' field='quantity'
                                        data-id="{{$producto->id}}" />
                                        <input type='number' onkeyup="this.value=this.value.replace(/[^1-9]/g,'');" name='qty' id="{{$producto->id}}"
                                        value="{{isset($qty) ? $qty : 1}}" class='qty' data-id="{{$producto->id}}"/>

                                        <input type='button' value='+' class='qtyplus' field='quantity'
                                        data-id="{{$producto->id}}"/>
                                    </div>



{{--}}
                                    <div class="qty-box">
                                        <input type='button' value='-' class='qtyminus' field='qty' />
                                        <input type='text' name='qty' value='1' class='qty' />
                                        <input type='button' value='+' class='qtyplus' field='qty' />
                                    </div>
                                    --}}
                                {{--<a href="#" class="icons ml-2" id="cart">
                                    <img src="{{ asset('img/cart.png') }}" class="img-fluid header-icon">
                                </a>
                                --}}
                            </div>
                        </div>


                        <div class="col-lg-9 justify-content-end align-self-end">
                          <button type="submit"  class="btn btn-primary checkout-button">
                            <img src="{{ asset('img/cart-white.png') }}" class="img-fluid header-icon">
                        Comprar</button>
                    </div>

                </div>
            </div>
        </div>



        <ul class="footer_list d-inline-flex mt-2">
            <li>

                <a class="facebook-share-button" href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.show', ['slug_' => $producto->slug]) }}" target="_blank">
                    <img src="{{ asset('img/fb.png') }}" class="img-fluid mr-1 img-footer" width="40">
                </a>
{{--
                    <a href="" target="_blank">
                        <img src="{{ asset('img/fb.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a>--}}
                </li>
                <li>
                    {{--<a href="" target="_blank">
                        <img src="{{ asset('img/ig.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a>--}}


                    <a class="twitter-share-button"

                    href="https://twitter.com/intent/tweet?text={{$producto->nombre_producto}} {{ route('product.show', ['slug_' => $producto->slug]) }}"
                    data-size="large"
                    data-text="{{$producto->nombre_producto}}"
                    data-url="{{ route('product.show', ['slug_' => $producto->slug]) }}"
                    data-hashtags="{{$producto->referencia}},{{$producto->alias}},{{$param->nombre_tienda}}"
                    data-via=""
                    data-related="twitterapi,twitter" target="_blank">
                    <img src="{{ asset('img/tw.png') }}" class="img-fluid mr-1 img-footer" width="40">
                </a>

            </li>
            {{--<li>
                <a href="" target="_blank">
                    <img src="{{ asset('img/tw.png') }}" class="img-fluid mr-1 img-footer" width="40">
                </a>
            </li>
            --}}
        </ul>
    </div>
</div>
</div>

</div>


<!-- /Product details -->
<div class="col-xl-2 mb-3 pl-0 pr-0">
    @include('partials.top')
</div>


</div>


<!-- /row -->

<!-- Product tab -->

<div class="row border-bottom-custom">


    <div class="col-md-12">
        <div class="mayus mb-2 fs-16 mt-3 mb-3">ESPECIFICACIONEs</div>

        @foreach($filters as $filter)
        <p><strong>{{$filter['categoria6']}}</strong> {{$filter['categoria7']}}</p>
        @endforeach
    </div>
</div>
<div class="row border-bottom-custom mt-2">
    <div class="col-md-12">

        <p >{!!$producto->descripcion_larga!!}</p>
    </div>
</div>

</div>

</div>
<!-- /product tab -->



</div>
<!-- /container -->
</form>

<!-- /SECTION -->


<!--aca-->
@include('partials.newsletter')

@section('extra-js')
@include('partials.js.slider')
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/nouislider.min.js')}}"></script>
<script src="{{asset('js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{url('js/qty.js')}}"></script>
<script src="{{url('js/jquery.expander.min.js')}}"></script>
<!-- lightgallery plugins -->
<script src="{{url('js/lightgallery/lightgallery.min.js')}}"></script>
<script src="{{url('js/jquery.mousewheel.min.js')}}"></script>
<script src="{{url('js/lightgallery/lg-thumbnail.min.js')}}"></script>
<script src="{{url('js/lightgallery/lg-fullscreen.min.js')}}"></script>


<script>
    $('.expander').expander({
        slicePoint: 200,
  //widow: 2,
  expandEffect: 'show',
  expandSpeed: 0,
  collapseEffect: 'hide',
  collapseSpeed: 0,
  userCollapseText: 'Leer menos',
  expandText:'Leer más',
  moreLinkClass:'badge badge-pill badge-light',
  lessLinkClass: "badge badge-pill badge-light",
  //userCollapseText: '[^]'
});
</script>


<script type="text/javascript">
    var image_current = null;

    $("#lightgallery").lightGallery({
        selector: '.thumbnail',
        cssEasing: 'cubic-bezier(0.680, -0.550, 0.265, 1.550)',
        download: false,
        speed: 500
    });



    $('.thumbnail').on('click', function(e) {

        var allImages = {!! $allImages->toJson() !!};
        var array= new Array();

        $.each(allImages, function( key, value ) {
            array.push({
                src: value.urlimagen,
                thumb:  value.urlimagen
            });
        });

        $(this).lightGallery({
            download: false,
            dynamic: true,
            dynamicEl: array,
            index: $(this).index(),
        })
    });


</script>

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
    $(function() {

        var id= '{{Session::get('id')}}';
        var qty= '{{Session::get('qty')}}';
        console.log(qty)
         $('.qty').val(qty);

        if (!id) {
            var id=null;
        }
        $('#modalCiudadesSelector').modal('show');
        $('#modalCiudadesSelector').find('.modal-body #id').val(id)
    });
</script>
@endif

@endsection

@endsection
