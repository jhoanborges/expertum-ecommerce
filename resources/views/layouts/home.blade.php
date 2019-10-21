@extends('welcome')
@section('content')

<!-- Home -->
<div class="rev_slider_wrapper mt-important">
    <!-- the ID here will be used in the inline JavaScript below to initialize the slider -->
    <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.8" >
        <ul id="slider-content">
            <!-- MINIMUM SLIDE STRUCTURE -->

            @foreach ($slider as $slide)
            <li data-transition='boxfade' data-link="{{$slide->link}}" data-target="_blank" >

                <img class="img-opacity"src="{{$slide->url}}" alt="{{$slide->url}}"  >
                <!-- BEGIN TEXT LAYER -->
                <div class="tp-caption tp-resizeme large_bold_white"

                data-frames='[{"delay":0,"speed":300,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                data-x="center"
                data-y="center"
                data-hoffset="0"
                data-voffset="0"
                data-width="['auto']"
                data-height="['auto']">
                <div class="myclass text-center">
                    <h1 class="mayus">{{$slide->name}}</h1>
                </div>

            </div>
        </li>

        @if(!empty($slide->button))
        <div class="tp-caption lfb ltb start tp-resizeme"

        data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
        data-x="200"
        data-y="200"
        data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
        data-speed="1500"
        data-start="1600"
        data-easing="Power3.easeInOut"
        data-splitin="none"
        data-splitout="none"
        data-elementdelay="0.01"
        data-endelementdelay="0.1"
        data-linktoslide="next"
        style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;"><a href='{{$slide->link}}' class='largebtn solid'>{{$slide->button}}</a> </div>
        @endif

        @endforeach

    </ul>
</div>
</div>


<!-- Shop -->

<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            <div class="col-lg-2">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="row  no-gutters footer_title mayus">
                            <div class="col-sm-6 no-gutters">
                                <span>CATEGORÍAS</span>
                            </div>
                            <div class="col-sm-6 no-gutters text-right">
                                <i class="ti-search pointer"></i>
                            </div>
                        </div>
                        @if ( $categorias->count() > 0 )
                        <ul class="sidebar_categories">
                          @foreach ($categorias as $category)
                          <li>
                            <a href="{{route('categoria.get', ['cat' => $cat2   , 'categoria' => $category->slug]) }} ">{{$category->nombrecategoria}}</a>
                        </li>

                        @endforeach
                    </ul>
                    @endif
                </div>

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
                                            {{--<li class="top-sub pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>--}}
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
            </div>

        </div>





        <div class="col-lg-10 ">

            <!-- Shop Content -->



            <div class="shop_content ">

                <div class="product_grid">
                    <div class="product_grid_border"></div>

                    <!-- Product Item -->
                    @foreach ($categorias2 as $producto)
                    <div class="product_item">
                        <a href="{{route('categoria.get', ['cat' => $cat2=1   , 'categoria' => $producto->slug   ]) }} ">
                            <img class="img-fluid" src="{{image($producto->url_imagen)}}" alt="">
                            <div class="product_content">
                                <div class="pmd-card-title">
                                    <ul>
                                        <li class="pmd-card-subtitle-text blue category-text">{{$producto->nombrecategoria}}</li>
                                    </ul>
                                </div>
                            </div>

                            <ul class="product_marks">
                                <li class="product_mark product_discount">-25%</li>
                                <li class="product_mark product_new">new</li>
                            </ul>
                        </a>
                    </div>

                    @endforeach



{{--}}

                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/2.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Bebé 0 a 12 meses</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/3.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Ciencia STEAM</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/4.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Deportes y Scooters</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>






                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/5.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>

                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/6.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>

                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/7.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>

                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/8.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/9.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/10.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/11.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/12.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/13.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/14.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/15.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>


                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/16.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>



                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/16.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>



                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/17.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>



                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/18.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>



                    <div class="product_item">
                        <!--<div class="product_border"></div>-->

                        <img class="img-fluid" src="{{ asset('img/19.jpg') }}" alt="">

                        <div class="product_content">

                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue category-text">Excava Tiranosaurio</li>
                                </ul>
                            </div>


                        </div>

                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>
                    --}}










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
@include('partials.js.slider')
<script>
    $(document).ready(function() {
       $( ".pmd-card" ).hover(
        function() {
            $(this).addClass('shadow').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow');
        }
        );
// document ready
});
</script>
@endsection

@endsection
