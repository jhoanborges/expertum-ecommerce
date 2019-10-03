@extends('welcome')


@section('extra-css')

<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>
<!-- nouislider -->
<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

<link type="text/css" rel="stylesheet" href="{{asset('css/electro.css')}}"/>

@endsection

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


<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">



        <!-- row -->
        <div class="row">
            <div class="col-sm-10">
                <div class="store_title mayus mb-2">CIENCIA - <b>EXPERIMENTOS</b> </div>
                <div class="row">

                    <!-- Product main img -->
                    <div class="col-md-6">
                        <div id="product-main-img">
                            <div class="product-preview">
                                <img src="./img/product01.png" alt="">
                            </div>

                            <div class="product-preview">
                                <img src="./img/product03.png" alt="">
                            </div>

                            <div class="product-preview">
                                <img src="./img/product06.png" alt="">
                            </div>

                            <div class="product-preview">
                                <img src="./img/product08.png" alt="">
                            </div>
                        </div>


                        <!-- Product thumb imgs -->
                        <div class="col-md-12">
                            <div id="product-imgs">
                                <div class="product-preview">
                                    <img src="./img/product01.png" class="img-fluid" alt="">
                                </div>
                                <div class="product-preview">
                                    <img src="./img/product03.png" class="img-fluid" alt="">
                                </div>
                                <div class="product-preview">
                                    <img src="./img/product06.png" class="img-fluid" alt="">
                                </div>

                                <div class="product-preview">
                                    <img src="./img/product08.png" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- /Product thumb imgs -->


                    </div>
                    <!-- /Product main img -->




                    <!-- Product details -->
                    <div class="col-md-6">
                        <div class="product-details ">
                            <div class="border-bottom-custom">

                                <h2 class="product-name">Excava Tiranosaurio Rex</h2>
                                <h3 class="product-name mt-2 fs-16">4M-INDUSTRIAL</h3>
                                <h3 class="mt-2 bold">$49.000</h3>
                            </div>

{{--}}
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 Review(s) | Add your review</a>
                    </div>

                    <div>
                        <h3 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h3>
                        <span class="product-available">In Stock</span>
                    </div>   --}}
                            <div class="border-bottom-custom">

                    <p class="mt-3">Excava el esqueleto de un Tiranosaurio Rex como si fueras un palenontólogo en busca de fósiles. Contine 1 bloque de yeso con el esqueleto de un Tiranosaurio Rex de 19 cms cuando se arma, 1 herramiente para excavar, 1 pincel, 1 cartón con datos. Leer más</p>

</div>

                  <ul class="footer_list d-inline-flex mt-2">
                <li>
                    <a href="" target="_blank">
                        <img src="{{ asset('img/fb.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a>
                </li>
                <li>
                    <a href="" target="_blank">
                        <img src="{{ asset('img/ig.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a>
                </li>
                <li>
                    <a href="" target="_blank">
                        <img src="{{ asset('img/tw.png') }}" class="img-fluid mr-1 img-footer" width="40">
                    </a>
                </li>
            </ul>
                </div>
            </div>
        </div>

    </div>


    <!-- /Product details -->
    <div class="col-md-2">
        @include('partials.top')
    </div>


</div>
<!-- /row -->

<!-- Product tab -->
<div class="col-md-12">
    <div id="product-tab">
        <!-- product tab nav -->
        <ul class="tab-nav">
            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
            <li><a data-toggle="tab" href="#tab2">Details</a></li>
            <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
        </ul>
        <!-- /product tab nav -->

        <!-- product tab content -->
        <div class="tab-content">
            <!-- tab1  -->
            <div id="tab1" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <!-- /tab1  -->

            <!-- tab2  -->
            <div id="tab2" class="tab-pane fade in">
                <div class="row">
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <!-- /tab2  -->

            <!-- tab3  -->
            <div id="tab3" class="tab-pane fade in">
                <div class="row">
                    <!-- Rating -->
                    <div class="col-md-3">
                        <div id="rating">
                            <div class="rating-avg">
                                <span>4.5</span>
                                <div class="rating-stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <ul class="rating">
                                <li>
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="rating-progress">
                                        <div style="width: 80%;"></div>
                                    </div>
                                    <span class="sum">3</span>
                                </li>
                                <li>
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="rating-progress">
                                        <div style="width: 60%;"></div>
                                    </div>
                                    <span class="sum">2</span>
                                </li>
                                <li>
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="rating-progress">
                                        <div></div>
                                    </div>
                                    <span class="sum">0</span>
                                </li>
                                <li>
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="rating-progress">
                                        <div></div>
                                    </div>
                                    <span class="sum">0</span>
                                </li>
                                <li>
                                    <div class="rating-stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="rating-progress">
                                        <div></div>
                                    </div>
                                    <span class="sum">0</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /Rating -->

                    <!-- Reviews -->
                    <div class="col-md-6">
                        <div id="reviews">
                            <ul class="reviews">
                                <li>
                                    <div class="review-heading">
                                        <h5 class="name">John</h5>
                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                        <div class="review-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                    </div>
                                    <div class="review-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="review-heading">
                                        <h5 class="name">John</h5>
                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                        <div class="review-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                    </div>
                                    <div class="review-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="review-heading">
                                        <h5 class="name">John</h5>
                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                        <div class="review-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                    </div>
                                    <div class="review-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                    </div>
                                </li>
                            </ul>
                            <ul class="reviews-pagination">
                                <li class="active">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /Reviews -->

                    <!-- Review Form -->
                    <div class="col-md-3">
                        <div id="review-form">
                            <form class="review-form">
                                <input class="input" type="text" placeholder="Your Name">
                                <input class="input" type="email" placeholder="Your Email">
                                <textarea class="input" placeholder="Your Review"></textarea>
                                <div class="input-rating">
                                    <span>Your Rating: </span>
                                    <div class="stars">
                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                    </div>
                                </div>
                                <button class="primary-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Review Form -->
                </div>
            </div>
            <!-- /tab3  -->
        </div>
        <!-- /product tab content  -->
    </div>
</div>
<!-- /product tab -->

</div>
<!-- /container -->
</div>
<!-- /SECTION -->


<!--aca-->
@include('partials.newsletter')

@section('extra-js')
@include('partials.js.slider')
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/nouislider.min.js')}}"></script>
<script src="{{asset('js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

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
