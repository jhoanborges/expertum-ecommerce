@extends('welcome')
@section('content')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/nouislider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/checkbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/roundedcheckbox.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/range-slider.css')}}">
@endsection

@include('partials.slider')

<!-- Shop -->

<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            <div class="col-lg-2">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <ul class="brands_list mt-0">
                            <li class="row no-gutters h-100">



                                <div class="col-lg-12 mb-4">
                                    <div id="accordion" class="accordion">
                                        <div class="card  no-borders">
                                            <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseOne">
                                                <a class="card-title mayus">
                                                    Marcas
                                                </a>
                                            </div>
                                            <div id="collapseOne" class="card-body collapse pl-0 pr-0 {{!empty($checked)  ? 'show':null}}" data-parent="#accordion" >
                                               <!-- Simple checkbox with label, checked -->

                                               @foreach($marcas as $mark)
                                               @if($mark->cantidad > 0)
                                               <div class="checkbox pmd-default-theme mt-3">
                                                <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                    <input type="checkbox" value="{{$mark->id}}" class="brands"
                                                    @if (!empty ( $checked ))
                                                    @foreach ( $checked as $filter)
                                                    {{$filter == $mark->id ? 'checked':null}}
                                                    @endforeach
                                                    @endif>

                                                    <span>{{$mark->nombre}}</span>
                                                </label>
                                                <span class="badge badge-light">{{ $mark->cantidad }}</span>
                                            </div>

                                            @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                            @if (count($projects) > 0)
                            @foreach ($projects as $key => $project)
                            @include('partials.filtros', $project)
                            @endforeach

                            @endif

                            {{--
                            @if( !empty($max) )
                            <div class="col-lg-12">
                                <div class="card-title mayus pb-2">Precio</div>
                                <div id="pmd-slider-range-tooltip"  class="pmd-range-slider pmd-range-tooltip"></div>
                            </div>
                            @endif
                            --}}
                        </li>

                    </ul>
                </div>

            </div>

        </div>





        <div class="col-lg-10 ">

            <!-- Shop Content -->



            <div class="shop_content ">
                <div class="store_title mayus mb-5">{{$categorias_nombre['nombrecategoria']}}</div>

                <div class="product_grid">
                    <div class="product_grid_border"></div>

                    @foreach( $productos as $key => $producto)
                    <!-- Product Item -->
                    <div class="product_item" >
                        <!--<div class="product_border"></div>-->
                        <div class="product-image-content h-100">
                            <a href="{{route('product.show' , ['product'=>$producto['slug'] ])}}">
                                <img class="img-fluid" src="{{ image($producto->hasManyImagenes->first()->urlimagen) }}" alt="{{$producto['nombre_producto']}}">
                            </a>
                        </div>
                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <a href="{{route('product.show' , ['product'=>$producto['slug'] ])}}">
                                        <li class="pmd-card-subtitle-text blue body-text">{{$producto['nombre_producto']}}</li>
                                    </a>
                                    <li class="pmd-card-subtitle-text blue body-text">
                                        <a  href="{{route('store.search', ['search' => $producto->getMarcaProduct($producto->id)['nombre'] ])}}" class="no-decoration">
                                            {{$producto->getMarcaProduct($producto->id)['nombre'] }}
                                        </a>
                                    </li>
                                    <div class="price-box">
                                        @if ($producto['id_moneda'] == 1 && $trmdeldia->isEmpty()  )
                                        <li class="pmd-card-subtitle-text blue body-text bold black">
                                         {{'$'. number_format((float) precioNew($producto['slug']) , 0, ',', '.' )}}
                                     </li>

                                     @elseif( $producto->cantidad==0 )

                                     <li class="pmd-card-subtitle-text blue body-text bold black">
                                         {{'$'. number_format((float) precioNew($producto['slug']) , 0, ',', '.' )}}
                                     </li>

                                     <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price">
                                        {{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                                    </span>
                                </p>
                                @else


                                <li class="pmd-card-subtitle-text blue body-text bold black">
                                 {{'$'. number_format((float) precioNew($producto['slug']) , 0, ',', '.' )}}
                             </li>



                             @if(count($producto->hasManyPromociones))
                             @if (
                                ($producto->hasManyPromociones->first()->date_start <= date("Y-m-d")
                                    &&
                                    $producto->hasManyPromociones->first()->date_end >= date("Y-m-d"))
                                &&
                                ($producto->hasManyPromociones->first()->hour_start <= date("h:i:s")
                                    &&
                                    $producto->hasManyPromociones->first()->hour_end >= date("h:i:s"))
                                    )
                                    <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price">
                                        {{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                                    </span>
                                </p>
                                @elseif ($producto['promocion']=='1' )
                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price">
                                    {{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                                </span>
                            </p>
                            @endif
                            @endif




                            @endif
                        </div>


                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>
        @endforeach
    </div>



    <!-- Shop Page Navigation -->
    <div class="container">
        <div class="row">
            {{$productos->appends(request()->input() )->links()}}
        </div>
    </div>

</div>

<!--aca-->


</div>
</div>
</div>
@include('partials.newsletter')


</div>



@section('extra-js')

{{--<script src="{{url('js/wNumb.js')}}"></script>
<script src="{{url('js/nouislider.js')}}"></script>--}}


@include('partials.js.slider')
{{--
@if( !empty($max) )
<script>

    // multiple range slider with default tooltip open
    var pmdSliderRangeTooltip = document.getElementById('pmd-slider-range-tooltip');
    noUiSlider.create(pmdSliderRangeTooltip, {
        start: [{{floor  (floatval($min) )}}, {{floor  (floatval($max) )}}],
        connect: true,
        tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
        range: {
            'min': {{floor  (floatval($min) )}},
            'max': {{floor  (floatval($max) )}}
        }
    });

</script>
@endif
--}}


<script>
  $(function(){
    $(".filters").change(function(e) {
      document.getElementsByClassName("filters").disabled = true;
      var valor = [];
      $('input.filters[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
  });

      var url =
      '{{route('categoria.get', ['cat' => $oldcat2 ,'categoria' => $idd,
      'filtros' =>':filtros',
      'search' =>request()->search,
      'marcas'=>request()->marcas])}}';
      var parseResult = new DOMParser().parseFromString(url, "text/html");
      var parsedUrl = parseResult.documentElement.textContent;
      url = parsedUrl.replace('%3Afiltros', valor);
      window.location.href = url
  });

    $(".brands").change(function(e) {
      document.getElementsByClassName("brands").disabled = true;
      var valor = [];

      $('input.brands[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
  });


      var url =
      '{{route('categoria.get', ['cat' => $oldcat2 ,'categoria' => $idd,
      'marcas' =>':marcas',
      'filtros' =>request()->filtros,
      'search' =>request()->search
      ])}}';

      var parseResult = new DOMParser().parseFromString(url, "text/html");
      var parsedUrl = parseResult.documentElement.textContent;
      url = parsedUrl.replace('%3Amarcas', valor);
      window.location.href = url
  });


});
</script>




@endsection

@endsection
