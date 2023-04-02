@extends('welcome')

@section('extra-meta')
    <meta property="og:description" content="{{ $producto->descripcion }}" />
    @if (count($allImages) > 0)
        <meta property="og:image" content="{{ $allImages->first()->urlimagen }}" />
    @endif
    <meta property="og:url" content="{{ \URL::current() }}" />
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{ $producto->nombre_producto }}" />
    <meta property="og:image:alt" content="{{ $producto->nombre_producto }}" />
    <meta property="fb:app_id" content="545837192560177" />
@endsection


@section('extra-css')
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/electro.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/lightgallery/lightgallery.css') }}">
@endsection
@section('content')

<div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="brand" content="{{ $producto->getMarcaProduct($producto->id)['nombre'] ?? null}}">
    <meta itemprop="name" content="{{$producto->nombre_producto}}">
    <meta itemprop="description" content="{{$producto->descripcion}}">
    <meta itemprop="productID" content="{{$producto->slug}}">
    <meta itemprop="url" content="{{url()->current()}}">
    <meta itemprop="image" content="{{$allImages->first()->urlimagen}}">
    <div itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
      <span itemprop="propertyID" content="{{$producto->id}}"></span>
      <meta itemprop="value" content="{{$producto->slug}}"></meta>
    </div>
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        @if($producto->cantidad > 0 && $producto->estado == true)
      <link itemprop="availability" href="http://schema.org/InStock">
      @else
      <link itemprop="availability" href="http://schema.org/OutOfStock">
      @endif


      @if($producto->nuevo_usado == true)
      <link itemprop="itemCondition" href="http://schema.org/NewCondition">

      @else
      <link itemprop="itemCondition" href="http://schema.org/UsedCondition">

      @endif


      <meta itemprop="price" content="{{ '$' . number_format((float) precioNew($producto->slug), 0, ',', '.') }}">
      <meta itemprop="priceCurrency" content="{{$moneda->name}} ">
    </div>
  </div>

    <form action="{{ route('resumen.store') }}" method="POST" class="form-prevent">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $producto->slug }}">
        <!-- SECTION -->
        <div class="section mt-1">
            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row border-bottom-custom">
                    <div class="col-sm-10 mb-5">

                        <!--<div class="store_title mayus mb-2">CIENCIA - <b>EXPERIMENTOS</b> </div>-->
                        <div class="row mt-4">

                            <!-- Product main img -->
                            <div class="col-md-6">


                                @if ($producto->promocion()->exists() && ( \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)))
                                    <div class="icon-sale-label">
                                        <img width="60" src="{{ $producto->promocion()->first()->imagen }}"
                                            alt="{{ $producto->promocion()->first()->name }}" data-toggle="tooltip"
                                            data-placement="right" title="{{ $producto->promocion()->first()->name }}}"
                                            alt="{{ $producto->promocion()->first()->name }}">
                                    </div>
                                @endif


                                <div id="product-main-img">
                                    @if (count($allImages) > 0)
                                        @foreach ($allImages as $allImage)
                                            <div class="product-preview thumbnail">
                                                <img src="{{ url($allImage->urlimagen) }}"
                                                    alt="{{ url($allImage->urlimagen) }}"
                                                    alt="{{ $producto->nombre_producto }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="product-preview thumbnail">
                                            <img src="{{ image('') }}" alt="">
                                        </div>
                                    @endif
                                </div>


                                <!-- Product thumb imgs -->
                                <div class="col-md-12 mt-1">
                                    <div id="product-imgs">
                                        @if (count($allImages) > 0)
                                            @foreach ($allImages as $allImage)
                                                <div class="product-preview ">
                                                    <img src="{{ url($allImage->urlimagen) }}" class="img-fluid"
                                                        alt="{{ url($allImage->urlimagen) }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <!--
                                        <div class="product-preview ">
                                            <img src="{{ image('') }}" class="img-fluid" alt="" >
                                        </div>
                                        -->
                                        @endif
                                    </div>
                                </div>
                                <!-- /Product thumb imgs -->


                            </div>
                            <!-- /Product main img -->




                            <!-- Product details -->
                            <div class="col-md-6">
                                <div class="product-details ">
                                    <div class="border-bottom-custom">

                                        <h2 class="product-name">{{ $producto->nombre_producto }}</h2>
                                        <h3 class="product-name mt-2 fs-16">Marca:
                                            {{ $producto->getMarcaProduct($producto->id)['nombre'] }}</h3>
                                        <div class="d-flex">




                                            @if ($producto->promocion()->exists()
                                            &&  $check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)
                                            )
                                                <h3 class="bold">
                                                    {{ '$' . number_format((float) precioNew($producto->slug), 0, ',', '.') }}
                                                </h3>

                                                <span
                                                    class="tachado font-weight-light mt-1 ml-1">{{ '$' . number_format((float) $producto->precioventa_iva, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <h3 class="bold">
                                                    {{ '$' . number_format((float) precioNew($producto->slug), 0, ',', '.') }}
                                                </h3>
                                            @endif


                                        </div>

                                    </div>

                                    <div class="d-block mb-2 mt-1">
                                        <div class="row no-gutters ">
                                            <div class="col-sm-6">
                                                Referencia: {{ $producto->referencia }}
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="float-right">Stock:
                                                    @if ($producto->cantidad_critica)
                                                        @if (!$producto->cantidad == 0)
                                                            @if ($producto->cantidad_critica >= $producto->cantidad)
                                                                Pocas unidades
                                                            @else
                                                                Disponible
                                                            @endif
                                                        @else
                                                            No disponbile
                                                        @endif
                                                    @else
                                                        @if ($param->cantidad_critica)
                                                            @if (!$producto->cantidad == 0)
                                                                @if ($param->cantidad_critica >= $producto->cantidad)
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
                                        <p class="mt-3 expander">{{ str_limit($producto->descripcion, 1500) }}</p>
                                        <div class="d-block mb-4 mt-1">
                                            <div class="row no-gutters h-100">
                                                <div class="col-lg-3">
                                                    <label>Cantidad</label>
                                                    <div class="d-inline-block">

                                                        <div class="qty-box">

                                                            <input type='button' value='-' class='qtyminus'
                                                                field='quantity' data-id="{{ $producto->id }}" />
                                                            <input type='number'
                                                                onkeyup="this.value=this.value.replace(/[^1-9]/g,'');"
                                                                name='qty' id="{{ $producto->id }}"
                                                                value="{{ isset($qty) ? $qty : 1 }}" class='qty'
                                                                data-id="{{ $producto->id }}" />

                                                            <input type='button' value='+' class='qtyplus'
                                                                field='quantity' data-id="{{ $producto->id }}" />
                                                        </div>



                                                        {{-- }}
                                    <div class="qty-box">
                                        <input type='button' value='-' class='qtyminus' field='qty' />
                                        <input type='text' name='qty' value='1' class='qty' />
                                        <input type='button' value='+' class='qtyplus' field='qty' />
                                    </div> --}}
                                                        {{-- <a href="#" class="icons ml-2" id="cart">
                                    <img src="{{ asset('img/cart.png') }}" class="img-fluid header-icon">
                                </a> --}}
                                                    </div>
                                                </div>

                                                <div class="col-lg-9 justify-content-end align-self-end">
                                                    @if ($producto->cantidad <= 0 || $producto->estado == false)
                                                        <button type="submit" class="btn btn-danger checkout-button">No
                                                            disponible</button>
                                                    @else
                                                        <button
                                                        id="AddToCart"
                                                        type="submit" class="btn btn-primary checkout-button">
                                                            <img src="{{ asset('img/cart-white.png') }}"
                                                                class="img-fluid header-icon"
                                                                alt="{{ $producto->nombre_producto }}">Comprar</button>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <ul class="footer_list d-inline-flex mt-2">
                                        <li>

                                            <a class="facebook-share-button"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ route('product.show',
                                                 ['slug' => isset($producto->slug) ? $producto->slug : 'null']
                                                 ) }}"
                                                target="_blank">
                                                <img src="{{ asset('img/fb.png') }}" class="img-fluid mr-1 img-footer"
                                                    width="40" alt="{{ $producto->nombre_producto }}">
                                            </a>
                                            {{-- <a href="" target="_blank">
                        <img src="{{ asset('img/fb.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a> --}}
                                        </li>
                                        <li>
                                            {{-- <a href="" target="_blank">
                        <img src="{{ asset('img/ig.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a> --}}


                                            <a class="twitter-share-button"
                                                href="https://twitter.com/intent/tweet?text={{ $producto->nombre_producto }} {{ route('product.show', ['slug' => isset($producto->slug) ? $producto->slug : 'null'
                                                ]) }}"
                                                data-size="large" data-text="{{ $producto->nombre_producto }}"
                                                data-url="{{ route('product.show', ['slug' =>
                                                isset($producto->slug) ? $producto->slug : 'null'
                                                ]) }}"
                                                data-hashtags="{{ $producto->referencia }},{{ $producto->alias }},{{ $param->nombre_tienda }}"
                                                data-via="" data-related="twitterapi,twitter" target="_blank">
                                                <img src="{{ asset('img/tw.png') }}" class="img-fluid mr-1 img-footer"
                                                    width="40" alt="{{ $producto->nombre_producto }}">
                                            </a>

                                        </li>
                                        {{-- <li>
                <a href="" target="_blank">
                    <img src="{{ asset('img/tw.png') }}" class="img-fluid mr-1 img-footer" width="40">
                </a>
            </li> --}}
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
                <div class="row border-bottom-custom mt-2">
                    <div class="col-md-12">
                        <div class="mayus mb-2 fs-16 mt-3 mb-3">ESPECIFICACIONES</div>
                        <p>{!! $producto->descripcion_larga !!}</p>
                    </div>
                </div>



                <div class="row border-bottom-custom">
                    <div class="col-md-12">
                        <div class="mayus mb-2 fs-16 mt-3 mb-3">INFORMACIÓN ADICIONAL</div>

                        @foreach ($filters as $filter)
                            <p><strong>{{ $filter['categoria6'] }}</strong> {{ $filter['categoria7'] }}</p>
                        @endforeach
                    </div>
                </div>



                <div class="row border-bottom-custom">
                    <div class="col-md-12 mt-2">
                        <!-- <div class="mayus mb-2 fs-16 mt-3 mb-3">INFORMACIÓN ADICIONAL</div> -->

                        <p><strong>IMPORTANTE PARA TENER EN CUENTA:</strong>
                            <br> - Producto sujeto a disponibilidad.
                            <br> - Las imágenes publicadas para este producto son ilustrativas. El producto
                            real puede variar con respecto a los colores, aspecto y sensación de la
                            representación visual en este sitio web.
                            <br> - Aunque realizamos todos nuestros esfuerzos para comprobar los precios,
                            cantidades disponibles, especificaciones de los productos y para evitar
                            errores en cada publicación, de vez en cuando se pueden presentar errores
                            de forma inadvertida. En tal caso nos reservamos el derecho de rechazar los
                            pedidos que surjan de dichos errorres y proceder con la devolución del dinero.

                        </p>

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
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ url('js/qty.js') }}"></script>
    <script src="{{ url('js/jquery.expander.min.js') }}"></script>
    <!-- lightgallery plugins -->
    <script src="{{ url('js/lightgallery/lightgallery.min.js') }}"></script>
    <script src="{{ url('js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ url('js/lightgallery/lg-thumbnail.min.js') }}"></script>
    <script src="{{ url('js/lightgallery/lg-fullscreen.min.js') }}"></script>


    <script>
        $('.expander').expander({
            slicePoint: 200,
            //widow: 2,
            expandEffect: 'show',
            expandSpeed: 0,
            collapseEffect: 'hide',
            collapseSpeed: 0,
            userCollapseText: 'Leer menos',
            expandText: 'Leer más',
            moreLinkClass: 'badge badge-pill badge-light',
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
            var array = new Array();

            $.each(allImages, function(key, value) {
                array.push({
                    src: value.urlimagen,
                    thumb: value.urlimagen
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

    @if (!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <script>
            $(function() {

                var id = '{{ Session::get('id') }}';
                var qty = '{{ Session::get('qty') }}';
                console.log(qty)
                $('.qty').val(qty);

                if (!id) {
                    var id = null;
                }
                $('#modalCiudadesSelector').modal('show');
                $('#modalCiudadesSelector').find('.modal-body #id').val(id)
            });
        </script>
    @endif

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{$producto->nombre_producto}}",
  "image": "{{$allImages->first()->urlimagen}}",
  "description": "{{$producto->descripcion}}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $producto->getMarcaProduct($producto->id)['nombre'] }}"
  },
  "sku": "{{ $producto->referencia}}",
  "offers": {
    "@type": "Offer",
    "url": "{{url()->current()}}",
    "priceCurrency": "{{$moneda->name}}",
    "price": "{{$producto->precioventa_iva}}",
    "priceValidUntil" : "{{date('Y-m-d', strtotime('+1 month'))}}",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "100",
    "bestRating": "100",
    "worstRating": "100",
    "ratingCount": "1",
    "reviewCount": "1"
  },
  "review": {
    "@type": "Review",
    "name": "{{$nombre_tienda}}",
    "reviewBody": "{{$producto->descripcion}}",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "100",
      "bestRating": "100",
      "worstRating": "100"
    },
    "datePublished": "{{$producto->created_at}}",
    "author": {"@type": "Person", "name": "{{$nombre_tienda}}"},
    "publisher": {"@type": "Organization", "name": "{{$nombre_tienda}}"}
  }
}
</script>

<script type="text/javascript">
    var moneda= "{{$moneda->name}}"
    var usuario="{{Auth::check() ? Auth::user()->email : 'Usuario no logueado'}}"
    var referencia="{{$producto->referencia}}"
    var nombre="{{$producto->nombre_producto}}"
    var cantidad = $('.qty').val()
    var precio="{{$producto->precioventa_iva}}"

</script>

<script type="text/javascript">

console.log('moneda ' + moneda)
console.log('usuario ' + usuario)
console.log('referencia ' + referencia)
console.log('nombre ' + nombre)
console.log('cantidad ' + cantidad)
console.log('precio ' + precio)

</script>


<!-- add or no pixel code-->
@if (App\Pixel::first()->pixel_id != null)
@if (App\PixelEvents::where('type', 'add_to_cart')->first()->active == true)
    {!! \App\PixelEvents::where('type', 'add_to_cart')->first()->code !!}
@endif

@if (App\PixelEvents::where('type', 'ver_contenido_producto')->first()->active == true)
    {!! \App\PixelEvents::where('type', 'ver_contenido_producto')->first()->code !!}
@endif



@endif


@endsection

@endsection
