@extends('welcome')
@section('content')

<!-- Home -->
<div class="rev_slider_wrapper mt-important">
    <!-- the ID here will be used in the inline JavaScript below to initialize the slider -->
    <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.8" >
        <ul id="slider-content">
            <!-- MINIMUM SLIDE STRUCTURE -->

            <li data-transition='boxfade'>

                <img class="img-opacity" src="{{ asset('img/store-banner-toys-950.jpg') }}">
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
                    <h1 class="mayus"></h1>
                </div>

            </div>
        </li>

        <li data-transition='boxfade'>

            <img class="img-opacity" src="{{ asset('img/banner-lising.jpg') }}">
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
                <h1 class="mayus"></h1>
            </div>

        </div>
    </li>


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
                        <div class="footer_title mayus">CATEGORÍAS</div>
                        <ul class="sidebar_categories">

                            <li><a href="#">Alimentación</a></li>

                            <li><a href="#">Bebé 0 a 12 meses</a></li>
                            <li><a href="#">Ciencia · Experimentos</a></li>
                            <li><a href="#">Deporte y Scooterss</a></li>
                            <li><a href="#">Juegos de mesa</a></li>
                            <li><a href="#">Juegos de rol</a></li>
                            <li><a href="#">Libros</a></li>
                            <li><a href="#">Manualidades</a></li>
                            <li><a href="#">Mobiliario y decoración</a></li>
                            <li><a href="#">Morrales, loncheras y termos</a></li>
                            <li><a href="#">Música</a></li>
                            <li><a href="#">Primera infancia</a></li>
                            <li><a href="#">Rompecabezas</a></li>
                            <li><a href="#">Títeres y muñecos</a></li>
                            <li><a href="#">Trenes y carros</a></li>
                            <li><a href="#">Teens</a></li>
                        </ul>
                    </div>


                    <div class="sidebar_section mt-5">
                        <div class="footer_title mayus ">más vendidos</div>
                        <ul class="brands_list">
                            <li class="row no-gutters h-100">

                                <div class="col-lg-12">

                                    <a href="#" class="d-flex pt-3 pb-3 border-bottom-custom">
                                        <img src="{{ asset('img/dinosaurio-tyrannosaurus-rex-skeleton-4m.jpg') }}" class="top-image img-fluid">

                                        <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                                            <ul>
                                                <li class="top-sub pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                                                {{--<li class="top-sub pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>--}}
                                                <li class="top-sub pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                                            </ul>
                                        </div>

                                    </a>
                                </div>

                                <div class="col-lg-12">

                                    <a href="#" class="d-flex pt-3 pb-3 border-bottom-custom">
                                        <img src="{{ asset('img/dinosaurio-adn-t-rex_8827_full.jpg') }}" class="top-image img-fluid">

                                        <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                                            <ul>
                                                <li class="top-sub pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                                                {{--<li class="top-sub pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>--}}
                                                <li class="top-sub pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                                            </ul>
                                        </div>

                                    </a>
                                </div>

                                <div class="col-lg-12">

                                    <a href="#" class="d-flex pt-3 pb-3">
                                        <img src="{{ asset('img/kit-de-geologia-para-excavar_7262_full.jpg') }}" class="top-image img-fluid">

                                        <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                                            <ul>
                                                <li class="top-sub pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                                                {{--<li class="top-sub pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>--}}
                                                <li class="top-sub pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                                            </ul>
                                        </div>

                                    </a>
                                </div>

                            </li>

                        </ul>
                    </div>

                    {{--
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <div id="slider-range" class="slider_range"></div>
                            <p>Range: </p>
                            <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle color_subtitle">Color</div>
                        <ul class="colors_list">
                            <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                            <li class="color"><a href="#" style="background: #000000;"></a></li>
                            <li class="color"><a href="#" style="background: #999999;"></a></li>
                            <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                            <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                            <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                        </ul>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            <li class="brand"><a href="#">Apple</a></li>
                            <li class="brand"><a href="#">Beoplay</a></li>
                            <li class="brand"><a href="#">Google</a></li>
                            <li class="brand"><a href="#">Meizu</a></li>
                            <li class="brand"><a href="#">OnePlus</a></li>
                            <li class="brand"><a href="#">Samsung</a></li>
                            <li class="brand"><a href="#">Sony</a></li>
                            <li class="brand"><a href="#">Xiaomi</a></li>
                        </ul>
                    </div>
                    --}}
                </div>

            </div>





            <div class="col-lg-10 ">

                <!-- Shop Content -->



                <div class="shop_content ">

                    <div class="product_grid">
                        <div class="product_grid_border"></div>

{{--
                        <!-- Product Item -->
                        <div class="product_item is_new">
                           <div class="pmd-card pmd-card-default pmd-z-depth">
                            <!-- Card media -->
                            <div class="pmd-card-media">
                                <img class="img-fluid" src="{{asset('img/bear.jpg')}}">
                            </div>
                            <!-- Card header -->
                            <div class="pmd-card-title">
                                <ul>
                                    <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                                    <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                                    <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                                </ul>
                            </div>
                        </div>
                        <div class="product_fav"><i class="fas fa-heart"></i></div>


                    </div>


                    <div class="product_item is_new">
                       <div class="pmd-card pmd-card-default pmd-z-depth">
                        <!-- Card media -->
                        <div class="pmd-card-media">
                            <img class="img-fluid" src="{{asset('img/bear.jpg')}}">
                        </div>
                        <!-- Card header -->
                        <div class="pmd-card-title">
                            <ul>
                                <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                                <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                                <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_fav"><i class="fas fa-heart"></i></div>


                </div>
                <!-- Product Item -->
                <div class="product_item is_new">
                   <div class="pmd-card pmd-card-default pmd-z-depth">
                    <!-- Card media -->
                    <div class="pmd-card-media">
                        <img class="img-fluid" src="{{asset('img/bear.jpg')}}">
                    </div>
                    <!-- Card header -->
                    <div class="pmd-card-title">
                        <ul>
                            <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                            <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                            <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                        </ul>
                    </div>
                </div>
                <div class="product_fav"><i class="fas fa-heart"></i></div>


            </div>

            <div class="product_item is_new">
               <div class="pmd-card pmd-card-default pmd-z-depth">
                <!-- Card media -->
                <div class="pmd-card-media">
                    <img class="img-fluid" src="{{asset('img/bear.jpg')}}">
                </div>
                <!-- Card header -->
                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>
            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>


        </div>
        --}}
        <!-- Product Item -->
        <div class="product_item">
            <!--<div class="product_border"></div>-->

            <img class="img-fluid" src="{{ asset('img/1.jpg') }}" alt="">

            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue category-text">Alimentación</li>
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













    </div>
</div>

<!--aca-->
@include('partials.newsletter')


</div>
</div>
</div>
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
