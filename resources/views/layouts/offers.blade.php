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
        <div class="shop_sidebar d-none d-sm-block d-md-none d-lg-none d-xl-block">
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
                <a href="{{route('product.show' , ['slug'=>$producto['slug'] ?? 'null' ])}}">
                  <img class="img-fluid" src="{{ image($producto->hasManyImagenes->first()->urlimagen) }}" alt="{{$producto['nombre_producto']}}">
                </a>
              </div>

              @if ($producto->promocion()->exists()
              &&  $check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)
              )
              <span class="icon-sale-label sale-right">
                <img  class="img-fluid" src="{{$producto->promocion()->first()->imagen}}" alt="{{$producto->promocion()->first()->name}}"
                data-toggle="tooltip" data-placement="right" title="{{$producto->promocion()->first()->name}}">
              </span>
              @endif

{{--
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
                      <span class="icon-sale-label sale-right">
                          <img  class="img-fluid" src="{{imagePromo($producto->hasManyPromociones->first()->imagen)}}" alt="{{$producto->hasManyPromociones->first()->name}}"
                          data-toggle="tooltip" data-placement="right" title="{{$producto->hasManyPromociones->first()->name}}">
                      </span>
                      @endif
                      @endif

                      @if ($producto['promocion']=='1' && $producto['fechapromocion_inicial'] <= date("Y-m-d") && $producto['fechapromocion_final'] >= date("Y-m-d"))
                      @foreach($imagenpromocion as $imgpromo)
                      <span class="icon-sale-label sale-right">
                          <img  class="img-responsive" src="{{$imgpromo->urlimagen}}" alt="">
                      </span>
                      @endforeach
                      @endif
                      @if ($producto['novedad']==true)
                      <div class="icon-new-label new-left">Nuevo</div>
                      @endif
                      @if ($producto['destacado']==true)
                      <div class="icon-sale-label new-right">Destacado</div>
                      @endif
                      --}}

                      <div class="product_content">

                        <div class="pmd-card-title">
                          <ul class="list-inline text-center justify-content-center align-items-center">




                           <a  href="{{route('product.show' , ['slug'=>$producto['slug'] ?? 'null' ])}}">
                            <li class="pmd-card-subtitle-text blue body-text title-height list-inline  text-center justify-content-center align-items-center d-flex mb-0">
                              <p class="two-row mb-0 ">{{$producto['nombre_producto']}}</p>

                            </li>
                          </a>
                          @include('partials.products_reference')


                          <li class="pmd-card-subtitle-text blue body-text">
                            <a  href="{{route('store.search', ['search' => $producto->getMarcaProduct($producto->id)['nombre'] ])}}" class="no-decoration">
                              {{$producto->getMarcaProduct($producto->id)['nombre'] }}
                            </a>
                          </li>
                          <!-- Nuevo price box de promociones -->
                          <div class="price-box d-flex justify-content-center">




              @if ($producto->promocion()->exists()
              &&  $check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)
              )
                            <li class="pmd-card-subtitle-text blue body-text bold black">
                              {{'$'. number_format((float) precioNew($producto->slug) , 0, ',', '.' )}}
                            </li>
                            <span class="tachado font-weight-light ml-1">{{'$'. number_format((float)  $producto->precioventa_iva , 0, ',', '.' )}}
                            </span>

                            @else
                            <li class="pmd-card-subtitle-text blue body-text bold black">
                            {{'$'. number_format((float)  precioNew($producto->slug) , 0, ',', '.' )}}
                            </li>
                            @endif







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
