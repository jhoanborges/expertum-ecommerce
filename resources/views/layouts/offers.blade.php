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


                @if(count($marcas))
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

                      @endforeach

                    </div>
                  </div>

                </div>
              </div>

              @endif
              @if (count($projects) > 0)
              @foreach ($projects as $key => $project)
              @include('partials.filtros', $project)
              @endforeach

              @endif


              @if( !empty($max) )

              <div class="col-lg-12">
                <div class="card-title mayus">Precio</div>
                <div class="row">
                  {{--<div id="pmd-slider-range-tooltip"  class="pmd-range-slider pmd-range-tooltip"></div>--}}
                  <div class="col-lg-6 mb-1 ">
                    <input class="form-control price-form min" type="number" value="{{floor  (floatval($min) )}}">
                  </div>

                  <div class="col-lg-6 mb-1 ">
                    <input class="form-control price-form max" type="number" value="{{floor  (floatval($max) )}}">
                  </div>

                  <div class="col-lg-12 mt-2">
                    <button class="btn btn-primary checkout-button w-100 btn-gray white price-filter">
                      <i class="fas fa-filter"></i>Filtrar</button>
                    </div>


                  </div>
                </div>


                @endif

              </li>

            </ul>
          </div>

        </div>

      </div>





      <div class="col-lg-10 ">

        <!-- Shop Content -->



        <div class="shop_content ">



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
                  <ul class="list-inline text-center justify-content-center align-items-center">


                    <a  href="{{route('product.show' , ['product'=>$producto['slug'] ])}}">
                      <li class="pmd-card-subtitle-text blue body-text one-row">{{$producto['nombre_producto']}}</li>
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

                                 <span class="tachado font-weight-light">{{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                      </span>

                     </li>

           
                  @else


                  <li class="pmd-card-subtitle-text blue body-text bold black">
                   {{'$'. number_format((float) precioNew($producto['slug']) , 0, ',', '.' )}}

                   @if(count($producto->hasManyPromociones))
                   @if (
                    ($producto->hasManyPromociones->first()->date_start <= date("Y-m-d")
                      &&
                      $producto->hasManyPromociones->first()->date_end >= date("Y-m-d"))

                      )
                      <span class="tachado font-weight-light">{{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                      </span>


                      @elseif ($producto['promocion']=='1' )
                      sda
                      <span class="tachado font-weight-light">{{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                      </span>
                      @endif
                      @endif

                    </li>


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

<script>
  $(function(){


    $(".filters").change(function(e) {
      document.getElementsByClassName("filters").disabled = true;
      var valor = [];
      $('input.filters[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
      });

      @if( Route::currentRouteNamed('ofertas.index') ||  Route::currentRouteNamed('ofertas.filter') )
      var url =
      '{{ route('ofertas.filter', [
      'marcas'=>request()->marcas,
      'filtros' =>':filtros',
      'search' =>request()->search,
      'range'=>request()->price
      ])}}';
      @elseif( Route::currentRouteNamed('novedades.index') ||  Route::currentRouteNamed('novedades.filter') )
      var url =
      '{{ route('novedades.filter', [
      'marcas'=>request()->marcas,
      'filtros' =>':filtros',
      'search' =>request()->search,
      'range'=>request()->price
      ])}}';
      @else
            var url =
      '{{ route('masvendidos.filter', [
      'marcas'=>request()->marcas,
      'filtros' =>':filtros',
      'search' =>request()->search,
      'range'=>request()->price
      ])}}';
      @endif



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


      @if( Route::currentRouteNamed('ofertas.index') ||  Route::currentRouteNamed('ofertas.filter')  )
      var url =
      '{{route('ofertas.filter', [
      'marcas' =>':marcas',
      'filtros' =>request()->filtros,
      'search' =>request()->search,
      'range'=>request()->price,

      ])}}';
      @elseif( Route::currentRouteNamed('novedades.index') ||  Route::currentRouteNamed('novedades.filter'))
      var url =
      '{{route('novedades.filter', [
      'marcas' =>':marcas',
      'filtros' =>request()->filtros,
      'search' =>request()->search,
      'range'=>request()->price,

      ])}}';
      @else
            var url =
      '{{route('masvendidos.filter', [
      'marcas' =>':marcas',
      'filtros' =>request()->filtros,
      'search' =>request()->search,
      'range'=>request()->price,

      ])}}';
      @endif



      var parseResult = new DOMParser().parseFromString(url, "text/html");
      var parsedUrl = parseResult.documentElement.textContent;
      url = parsedUrl.replace('%3Amarcas', valor);

      window.location.href = url
    });

    $(".price-filter").click(function(e) {
      var valor = [];

      e.preventDefault()
      var valor = [];
      var ini = $('.min').val();
      var end = $('.max').val();
      valor.push(ini,end);

      @if( Route::currentRouteNamed('ofertas.index')  ||  Route::currentRouteNamed('ofertas.filter') )
      var url =
      '{{route('ofertas.filter', [
      'filtros'=>request()->filtros,
      'marcas'=>request()->marcas,
      'search' =>request()->search,
      'range'=>':price',
      ])}}';
      @elseif( Route::currentRouteNamed('novedades.index')  ||  Route::currentRouteNamed('novedades.filter') )
      var url =
      '{{route('novedades.filter', [
      'filtros'=>request()->filtros,
      'marcas'=>request()->marcas,
      'search' =>request()->search,
      'range'=>':price',
      ])}}';
      @else
            var url =
      '{{route('masvendidos.filter', [
      'filtros'=>request()->filtros,
      'marcas'=>request()->marcas,
      'search' =>request()->search,
      'range'=>':price',
      ])}}';
      @endif




      var parseResult = new DOMParser().parseFromString(url, "text/html");
      var parsedUrl = parseResult.documentElement.textContent;
      url = parsedUrl.replace('%3Aprice', valor)
      window.location.href = url
    });



  });
</script>




@endsection

@endsection
