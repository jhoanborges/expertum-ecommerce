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
                                            <div id="collapseOne" class="card-body collapse pl-0 pr-0" data-parent="#accordion" >
                                               <!-- Simple checkbox with label, checked -->
                                               <div class="checkbox pmd-default-theme mt-3">
                                                <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                    <input type="checkbox" value="">
                                                    <span>4M-Industrial</span>
                                                </label>
                                            </div>

                                            <!-- Simple checkbox with label, checked -->
                                            <div class="checkbox pmd-default-theme mt-3">
                                                <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                    <input type="checkbox" value="">
                                                    <span>HAPE</span>
                                                </label>
                                            </div>

                                            <!-- Simple checkbox with label, checked -->
                                            <div class="checkbox pmd-default-theme mt-3">
                                                <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                    <input type="checkbox" value="">
                                                    <span>POOF</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12 mb-4">
                                <div id="accordion2" class="accordion">
                                    <div class="card  no-borders">
                                        <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseTwo">
                                            <a class="card-title mayus">
                                                actividades
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="card-body collapse pl-0 pr-0" data-parent="#accordion2" >
                                           <!-- Simple checkbox with label, checked -->
                                           <div class="checkbox pmd-default-theme mt-3">
                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                <input type="checkbox" value="">
                                                <span>4M-Industrial</span>
                                            </label>
                                        </div>

                                        <!-- Simple checkbox with label, checked -->
                                        <div class="checkbox pmd-default-theme mt-3">
                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                <input type="checkbox" value="">
                                                <span>HAPE</span>
                                            </label>
                                        </div>

                                        <!-- Simple checkbox with label, checked -->
                                        <div class="checkbox pmd-default-theme mt-3">
                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                <input type="checkbox" value="">
                                                <span>POOF</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mb-4">
                            <div id="accordion3" class="accordion">
                                <div class="card  no-borders">
                                    <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseThree">
                                        <a class="card-title mayus">
                                            edades
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="card-body collapse pl-0 pr-0" data-parent="#accordion3" >
                                       <!-- Simple checkbox with label, checked -->
                                       <div class="checkbox pmd-default-theme mt-3">
                                        <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                            <input type="checkbox" value="">
                                            <span>4M-Industrial</span>
                                        </label>
                                    </div>

                                    <!-- Simple checkbox with label, checked -->
                                    <div class="checkbox pmd-default-theme mt-3">
                                        <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                            <input type="checkbox" value="">
                                            <span>HAPE</span>
                                        </label>
                                    </div>

                                    <!-- Simple checkbox with label, checked -->
                                    <div class="checkbox pmd-default-theme mt-3">
                                        <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                            <input type="checkbox" value="">
                                            <span>POOF</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-12 mb-4">
                        <div id="accordion4" class="accordion">
                            <div class="card  no-borders">
                                <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseFour">
                                    <a class="card-title mayus">
                                        precios
                                    </a>
                                </div>
                                <div id="collapseFour" class="card-body collapse pl-0 pr-0" data-parent="#accordion4" >
                                   <!-- Simple checkbox with label, checked -->
                                   <div class="checkbox pmd-default-theme mt-3">
                                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                        <input type="checkbox" value="">
                                        <span>4M-Industrial</span>
                                    </label>
                                </div>

                                <!-- Simple checkbox with label, checked -->
                                <div class="checkbox pmd-default-theme mt-3">
                                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                        <input type="checkbox" value="">
                                        <span>HAPE</span>
                                    </label>
                                </div>

                                <!-- Simple checkbox with label, checked -->
                                <div class="checkbox pmd-default-theme mt-3">
                                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                        <input type="checkbox" value="">
                                        <span>POOF</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </li>

        </ul>
    </div>

</div>

</div>





<div class="col-lg-10 ">

    <!-- Shop Content -->



    <div class="shop_content ">
        <div class="store_title mayus mb-5">CIENCIA - <b>EXPERIMENTOS</b> </div>

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
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-tyrannosaurus-rex-skeleton-4m.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-adn-t-rex_8827_full.jpg') }}" alt="">
            </div>

            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/kit-de-geologia-para-excavar_7262_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-adn-triceratops_8829_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>






        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/casa-de-munecas-mansion-happy-day_9509_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/casita-de-munecas-mansion-familiar_6817_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/coche-familiar-para-munecos_6827_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/libro-de-louise-y-sus-amigos_10020_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-mammoth-skeleton-4m.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>



        <!-- Product Item -->
        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-tyrannosaurus-rex-skeleton-4m.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-adn-t-rex_8827_full.jpg') }}" alt="">
            </div>

            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/kit-de-geologia-para-excavar_7262_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-adn-triceratops_8829_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>






        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/casa-de-munecas-mansion-happy-day_9509_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/casita-de-munecas-mansion-familiar_6817_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/coche-familiar-para-munecos_6827_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/libro-de-louise-y-sus-amigos_10020_full.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-mammoth-skeleton-4m.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>

        <!-- Product Item -->
        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-tyrannosaurus-rex-skeleton-4m.jpg') }}" alt="">
            </div>
            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>


        <div class="product_item">
            <!--<div class="product_border"></div>-->
            <div class="product-image-content w-100">

                <img class="img-fluid" src="{{ asset('img/dinosaurio-adn-t-rex_8827_full.jpg') }}" alt="">
            </div>

            <div class="product_content">

                <div class="pmd-card-title">
                    <ul>
                        <li class="pmd-card-subtitle-text blue body-text">Excava Tiranosaurio</li>
                        <li class="pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>
                        <li class="pmd-card-subtitle-text blue body-text bold black">$49.000</li>
                    </ul>
                </div>


            </div>
            <div class="product_fav"><i class="fas fa-heart"></i></div>
            <ul class="product_marks">
                <li class="product_mark product_discount">-25%</li>
                <li class="product_mark product_new">new</li>
            </ul>
        </div>








    </div>

    <!-- Shop Page Navigation -->
    {{--
    <div class="container">
        <div class="row">

            <div class="shop_page_nav d-flex text-center">
                <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
                <ul class="page_nav d-flex flex-row">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">21</a></li>
                </ul>
                <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
    --}}
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