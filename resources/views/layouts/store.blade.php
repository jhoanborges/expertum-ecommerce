@extends('welcome')
@section('content')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roundedcheckbox.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/range-slider.css') }}">
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

                                @if ($categorias->count() > 0 && ($param->categories_bar_position == 'left' || $param->categories_bar_position == 'both'))
                                    <div class="sidebar_section w-100" id="sidebar_section">
                                        <div class="row no-gutters footer_title mayus">
                                            <div class="col-sm-12 no-gutters">
                                                <span>CATEGORÍAS</span>
                                                <a class="float-right" onclick="activate(); return false;">
                                                    <i class="ti-search pointer"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input id="myInput" placeholder="Buscar"
                                            class="mt-2 search form-control fuzzy-search no-show" />

                                        <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">
                                            @foreach ($categorias as $category)
                                                <li>
                                                    <a class="category-name"
                                                        href="{{ route('categoria.get', ['cat' => $cat2 ?? 'null', 'categoria' => $category->slug ?? 'null']) }} ">{{ $category->nombrecategoria }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endif


                                @if (count($marcas))
                                    <div class="col-lg-12 mb-4">
                                        <div id="accordion" class="accordion">


                                            <div class="card no-borders">

                                                <div class="card-header pointer collapsed" data-toggle="collapse"
                                                    href="#collapseOne">
                                                    <a class="card-title mayus">
                                                        Marcas
                                                    </a>
                                                </div>
                                                <div id="collapseOne"
                                                    class="card-body collapse pl-0 pr-0 {{ !empty($checked) ? 'show' : null }} scrollable mCustomScrollbar"
                                                    data-parent="#accordion">
                                                    <!-- Simple checkbox with label, checked -->

                                                    @foreach ($marcas as $mark)
                                                        <div class="checkbox pmd-default-theme mt-3">
                                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                                <input type="checkbox" value="{{ $mark->id }}"
                                                                    class="brands"
                                                                    @if (!empty($checked)) @foreach ($checked as $filter)
                              {{ $filter == $mark->id ? 'checked' : null }}
                              @endforeach @endif>

                                                                <span>{{ $mark->nombre }}</span>
                                                            </label>
                                                            <span
                                                                class="badge badge-light">{{ $mark->cantidad }}</span>
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


                                @if (!empty($max))
                                    <div class="col-lg-12">
                                        <div class="card-title mayus">Precio</div>
                                        <div class="row">
                                            {{-- <div id="pmd-slider-range-tooltip"  class="pmd-range-slider pmd-range-tooltip"></div> --}}
                                            <div class="col-lg-6 mb-1 ">
                                                <input class="form-control price-form min" type="number"
                                                    value="{{ floor(floatval($min)) }}">
                                            </div>

                                            <div class="col-lg-6 mb-1 ">
                                                <input class="form-control price-form max" type="number"
                                                    value="{{ floor(floatval($max)) }}">
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <button
                                                    class="btn btn-primary checkout-button w-100 btn-gray white price-filter">
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
                    <div class="store_title mayus mb-2">
                        {{ isset($categorias_nombre['nombrecategoria']) ? $categorias_nombre['nombrecategoria'] : 'PRODUCTOS ENCONTRADOS: ' . $search_key }}
                    </div>

                    <div class="d-flex flex-row-reverse mb-3">
                        <div class="short-by">
                            <select onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                <option
                                    value="{{ route('categoria.get', ['cat' => $oldcat2 ?? 'null',
                                        'id' => $id ?? 'null',

                                    'categoria' => $idd ?? 'null', 'todos' => 'todos']) }}"
                                    {{ 'todos' == $selected ? 'selected="selected"' : '' }}>Ordenar por:</option>
                                <option
                                    value="{{ route('categoria.get', [
                                        'cat' => $oldcat2 ?? 'null',
                                        'categoria' => $idd ?? 'null',
                                        'id' => $id ?? 'null',
                                        'filtros' => request()->filtros,
                                        'marcas' => request()->marcas,
                                        'range' => request()->range,
                                        'search' => request()->search,
                                        'sort' => 'menor_mayor',
                                    ]) }}"
                                    {{ 'menor_mayor' == request()->sort ? 'selected="selected"' : '' }}>Menor precio
                                </option>
                                <option
                                    value="{{ route('categoria.get', [
                                        'cat' => $oldcat2 ?? 'null',
                                        'categoria' => $idd ?? 'null',
                                        'id' => $id ?? 'null',

                                        'filtros' => request()->filtros,
                                        'marcas' => request()->marcas,
                                        'order' => request()->order,
                                        'range' => request()->range,
                                        'search' => request()->search,
                                        'sort' => 'mayor_menor',
                                    ]) }}">
                                    {{ 'mayor_menor' == request()->sort ? 'selected="selected"' : '' }}">Mayor precio
                                </option>
                                <option
                                    value="{{ route('categoria.get', [
                                        'cat' => $oldcat2 ?? 'null',
                                        'id' => $id ?? 'null',

                                        'categoria' => $idd ?? 'null',
                                        'filtros' => request()->filtros,
                                        'marcas' => request()->marcas,
                                        'sort' => request()->sort,
                                        'range' => request()->range,
                                        'search' => request()->search,
                                        'order' => 'asc',
                                    ]) }} "
                                    {{ 'asc' == request()->order ? 'selected="selected"' : '' }}>A-Z</option>
                                <option
                                    value="{{ route('categoria.get', [
                                        'cat' => $oldcat2 ?? 'null',
                                        'id' => $id ?? 'null',

                                        'categoria' => $idd ?? 'null',
                                        'filtros' => request()->filtros,
                                        'marcas' => request()->marcas,
                                        'sort' => request()->sort,
                                        'search' => request()->search,
                                        'order' => 'desc',
                                    ]) }} "
                                    {{ 'desc' == request()->order ? 'selected="selected"' : '' }}>Z-A</option>
                            </select>
                        </div>
                    </div>



                    <div class="">
                        <div class="product_grid_border"></div>
                        <div class="row">

                            @foreach ($productos as $key => $producto)
                                <!-- Product Item -->
                                <div class="col-sm-3 ">
                                    <!--<div class="product_border"></div>-->
                                    <div class="product-image-content product-item text-center">
                                        <a class="product-img"
                                            href="{{ route('product.show', ['slug' => isset($producto['slug']) ? $producto['slug'] : 'null']) }}">

                                            @if ($producto->hasManyImagenes->first())
                                                <img class="img-fluid"
                                                    src="{{ image($producto->hasManyImagenes->first()->urlimagen) }}"
                                                    alt="{{ $producto['nombre_producto'] }}">
                                            @else
                                                <img class="img-fluid" src="{{ image('') }}"
                                                    alt="{{ $producto['nombre_producto'] }}">
                                            @endif
                                        </a>
                                    </div>


                                    @if ($producto->promocion()->exists() && ($check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)))
                                        <span class="icon-sale-label sale-right">
                                            <img class="img-fluid" src="{{ $producto->promocion()->first()->imagen }}"
                                                alt="{{ $producto->promocion()->first()->name }}" data-toggle="tooltip"
                                                data-placement="right"
                                                title="{{ $producto->promocion()->first()->name }}">
                                        </span>
                                    @endif
                                    <div class="product_content">

                                        <div class="pmd-card-title">
                                            <ul class="list-inline text-center">
                                                <a
                                                href="{{ route('product.show', ['slug' => isset($producto['slug']) ? $producto['slug'] : 'null']) }}">
                                                    <li
                                                        class="pmd-card-subtitle-text blue body-text title-height list-inline  text-center justify-content-center align-items-center d-flex mb-0">
                                                        <p class="two-row mb-0 ">{{ $producto['nombre_producto'] }}
                                                        </p>



                                                    </li>
                                                </a>

                                                @include('partials.products_reference')

                                                <li class="pmd-card-subtitle-text blue body-text">
                                                    <a href="{{ route('store.search', ['search' =>
                                                     $producto->getMarcaProduct($producto->id) != null
                                                      && isset($producto->getMarcaProduct($producto->id)->nombre )
                                                      ? $producto->getMarcaProduct($producto->id)->nombre : 'null'
                                                    ]) }}"
                                                        class="no-decoration bold">¿
                                                      {{
                                                        $producto->getMarcaProduct($producto->id) != null
                                                        && isset($producto->getMarcaProduct($producto->id)->nombre )
                                                        ? $producto->getMarcaProduct($producto->id)->nombre : 'null'

                                                      }}

                                                    </a>
                                                </li>

                                                <!--
                            @include('partials.products_reference')
                          -->

                                                <div class="price-box d-flex justify-content-center">
                                                    {{-- }}    <li class="pmd-card-subtitle-text blue body-text bold black">
                            <p class="old-price">
                              {{'$'. number_format((float)  old_price($producto['slug']) , 0, ',', '.' )}}
                          </p>
                          </li> --}}


                                                    @if ($producto->promocion()->exists() && ($check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)))
                                                        <li class="pmd-card-subtitle-text blue body-text bold black">
                                                            {{ '$' . number_format((float) precioNew($producto->slug), 0, ',', '.') }}
                                                        </li>
                                                        <span
                                                            class="tachado font-weight-light ml-1">{{ '$' . number_format((float) $producto->precioventa_iva, 0, ',', '.') }}
                                                        </span>
                                                    @else
                                                        <li class="pmd-card-subtitle-text blue body-text bold black">
                                                            {{ '$' . number_format((float) precioNew($producto->slug), 0, ',', '.') }}
                                                        </li>
                                                    @endif


                                                </div>


                                            </ul>
                                        </div>


                                    </div>
                                    <!--
                          <div class="product_fav">
                            <i class="fas fa-heart"></i>
                          </div>
                        -->

                                    <form id="form" name="form" class="product_fav"
                                        action="{{ route('favoritos.store', ['product' => $producto->id, 'referencia' => $producto->referencia]) }}"
                                        method="get">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $producto->slug }}">
                                        <button type="submit" class="btn btn-transparent far fa-heart">
                                        </button>
                                    </form>


                                    <ul class="product_marks">
                                        <li class="product_mark product_discount">-25%</li>
                                        <li class="product_mark product_new">new</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <!-- Shop Page Navigation -->
                    <div class="container">
                        <div class="row">
                            {{ $productos->appends(request()->input())->links() }}
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
    @include('partials.js.slider')
    {{-- <script src="{{url('js/wNumb.js')}}"></script>
            <script src="{{url('js/nouislider.js')}}"></script>


            @if (!empty($max))
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
            @endif --}}

    <script>
        $(function() {
            $(".filters").change(function(e) {
                document.getElementsByClassName("filters").disabled = true;
                var valor = [];
                $('input.filters[type=checkbox]').each(function() {
                    if (this.checked)
                        valor.push($(this).val());
                });

                var url =
                    '{{ route('categoria.get', [
                        'cat' => $oldcat2 ?? 'null',
                        'categoria' => $idd ?? 'null',
                        'id' => $id ?? 'null',
                        'filtros' => ':filtros',
                        'search' => request()->search,
                        'marcas' => request()->marcas,
                    ]) }}';
                var parseResult = new DOMParser().parseFromString(url, "text/html");
                var parsedUrl = parseResult.documentElement.textContent;
                url = parsedUrl.replace('%3Afiltros', valor);
                window.location.href = url
            });

            $(".brands").change(function(e) {
                document.getElementsByClassName("brands").disabled = true;
                var valor = [];

                $('input.brands[type=checkbox]').each(function() {
                    if (this.checked)
                        valor.push($(this).val());
                });


                var url =
                    '{{ route('categoria.get', [
                        'cat' => $oldcat2 ?? 'null',
                        'id' => $id ?? 'null',

                        'categoria' => $idd ?? 'null',
                        'marcas' => ':marcas',
                        'filtros' => request()->filtros,
                        'search' => request()->search,
                    ]) }}';

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
                valor.push(ini, end);
                var url =
                    '{{ route('categoria.get', [
                        'cat' => $oldcat2 ?? 'null',
                        'id' => $id ?? 'null',

                        'categoria' => $idd ?? 'null',
                        'filtros' => request()->filtros,
                        'marcas' => request()->marcas,
                        'search' => request()->search,
                        'strict' => request()->strict,
                        'range' => ':price',
                    ]) }}';
                var parseResult = new DOMParser().parseFromString(url, "text/html");
                var parsedUrl = parseResult.documentElement.textContent;
                url = parsedUrl.replace('%3Aprice', valor)
                window.location.href = url
            });



        });
    </script>

<script type="text/javascript">
  var usuario="{{Auth::check() ? Auth::user()->email : 'Usuario no logueado'}}"
  var categoria= "{{$idd}}"

</script>


<!-- add or no pixel code-->
    @if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'ver_contenido_categoria')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'ver_contenido_categoria')->first()->code !!}
        @endif
    @endif

@endsection

@endsection
