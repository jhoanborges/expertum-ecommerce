@extends('welcome')
@section('content')
@section('extra-css')
@endsection
@include('partials.slider')


<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            @if($show_pane == true)
            <div class="col-lg-2">
                <!-- Shop Sidebar -->
                <div class="shop_sidebar d-none d-sm-block d-md-none d-lg-none d-xl-block">

                   @if ( $categorias->count() > 0
                      &&
                      ($param->categories_bar_position == 'left' ||  $param->categories_bar_position == 'both' )
                      )

                      <div class="sidebar_section w-100" id="sidebar_section">
                        <div class="row  no-gutters footer_title mayus">
                            <div class="col-sm-12 no-gutters">
                                <span>CATEGORÍAS</span>
                                <a class="float-right" onclick="activate(); return false;">
                                    <i class="ti-search pointer"></i>
                                </a>
                            </div>
                        </div>
                        <input id="myInput" placeholder="Buscar" class="mt-2 search form-control fuzzy-search no-show" />

                        <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">
                            @foreach ($categorias as $category)
                            <li>
                                <a class="category-name" href="{{route('categoria.get', ['cat' => $cat2   , 'id' => $category->slug]) }} ">{{$category->nombrecategoria}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

{{--}}
@if (count($projects) > 0)
@foreach ($projects as $key => $project)
@include('partials.filtrosForHome', $project)
@endforeach

@endif
--}}


<div class="sidebar_section mt-5">
    @if (count($filters) > 0)
    @include('partials.featured_filters')

    @endif
</div>

@if($param->show_featued_on_side == true)

<div class="sidebar_section mt-5">
    @include('partials.top')
</div>
@endif

                    {{--
                    @if ( $top->count() > 0 )
                    <div class="sidebar_section mt-5">
                        <div class="footer_title mayus ">más vendidos</div>
                        <ul class="brands_list">
                            <li class="row no-gutters h-100">

                                @foreach ($top as $to)
                                <div class="col-lg-12">

                                    <a href="{{route('product.show' , ['product'=>$to['slug'] ])}}" class="d-flex pt-3 pb-3 border-bottom-custom">
                                        <img src="{{url(  $to->hasManyImagenes->first()->urlimagen )}}" class="top-image img-fluid">

                                        <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                                            <ul>
                                                <li class="top-sub pmd-card-subtitle-text blue body-text">{{$to->nombre_producto}}</li>
                                                <li class="top-sub pmd-card-subtitle-text blue body-text bold black">{{'$ '.number_format((float) precioNew($to->slug), 0, ',', '.'  ) }}</li>
                                            </ul>
                                        </div>

                                    </a>
                                </div>

                                @endforeach

                            </li>

                        </ul>
                    </div>
                    @endif
                    --}}
                </div>

            </div>
@endif


            <div class="col-lg-{{$show_pane == true ? 10 : 12}} ">
                <!-- Shop Content -->
                <div class="shop_content ">
                    <div class="product_grid">
                        <div class="product_grid_border"></div>

                        <!-- Product Item -->
                        @foreach ($categorias2 as $producto)
                        <div class="product_item">
                            <a href="{{route('categoria.get', ['cat' => $cat2=1   , 'id' => $producto->slug   ]) }} ">
                                <img class="img-fluid" src="{{image($producto->url_imagen)}}" alt="">
                            </a>
                            <ul class="list-inline w-100">
                                <a  href="{{route('categoria.get', ['cat' => $cat2=1   , 'id' => $producto->slug   ]) }} ">
                                    <li class="pmd-card-subtitle-text blue body-text title-height list-inline  text-center justify-content-center align-items-center d-flex mb-0">
                                      <p class="two-row mb-0 ">{{$producto->nombrecategoria}}</p>

                                  </li>
                              </a>
                          </ul>
                          <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>

                    @endforeach
                </div>
            </div>


            <!--pagination-->
            <div class="container">
                <div class="row">
                    {{$categorias2->appends(request()->input() )->links()}}
                </div>
            </div>

        </div>




    </div>
</div>

@include('partials.newsletter')

</div>

@section('extra-js')

<script src="{{asset('js/list.min.js')}}"></script>

@include('partials.js.slider')
<script>
    $(document).ready(function() {
        $(".pmd-card").hover(
            function() {
                $(this).addClass('shadow').css('cursor', 'pointer');
            },
            function() {
                $(this).removeClass('shadow');
            }
            );
        // document ready
    });
</script>

<script>
    function activate() {
        $("#myInput").fadeToggle("fast", function() {});
        $('#myInput').focus();
    }

    var options = {
        valueNames: ['category-name']
    };

    var userList = new List('sidebar_section', options);
</script>





<!-- add or no pixel code VER CONTENIDO PRINCIPAL-->
@if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'ver_contenido_principal')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'ver_contenido_principal')->first()->code !!}
        @endif
    @endif


@endsection
@endsection
