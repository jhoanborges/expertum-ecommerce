@extends('welcome')
@section('extra-css')
<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{asset('css/electro.css')}}"/>

@endsection
@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container border-bottom-custom">



        <!-- row -->
        <div class="row border-bottom-custom">
            <div class="col-sm-10 mb-5">
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
                                <h3 class="mt-2 mb-3 bold">$49.000</h3>
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
                    <div class="d-block mb-2 mt-1">
                     <div class="row no-gutters">
                         <div class="col-sm-6">
                             Ref. 00-03221
                         </div>
                         <div class="col-sm-6">
                            <span class="float-right">Stock: 50</span>
                        </div>
                    </div>
                </div>

                <div class="border-bottom-custom">

                    <p class="mt-3">Excava el esqueleto de un Tiranosaurio Rex como si fueras un palenontólogo en busca de fósiles. Contine 1 bloque de yeso con el esqueleto de un Tiranosaurio Rex de 19 cms cuando se arma, 1 herramiente para excavar, 1 pincel, 1 cartón con datos. Leer más</p>


                    <div class="d-block mb-4 mt-1">
                     <div class="row no-gutters">
                        <div class="col-lg-3">
                            <label>Cantidad</label>
                            <div class="d-inline-block">
                                <div class="qty-box">

                                    <input type='button' value='-' class='qtyminus' field='quantity' />
                                    <input type='text' name='quantity' value='0' class='qty' />
                                    <input type='button' value='+' class='qtyplus' field='quantity' />


                                </div>
                                <a href="#" class="icons ml-2" id="cart">
                                    <img src="{{ asset('img/cart.png') }}" class="img-fluid header-icon">
                                </a>
                            </div>
                        </div>


                    </div>
                </div>




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
<div class="col-xl-2">
    @include('partials.top')
</div>


</div>
<!-- /row -->

<!-- Product tab -->

    <div class="row no-gutters ">


        <div class="col-md-12">
            <div class="mayus mb-2 fs-16 mt-3 mb-3">ESPECIFICACIONEs</div>

            <p>Edades                         8, 9, 10 y 11 años </p>
            <p> Actividades                 Jugar, experimentar</p>
            <p class="border-bottom-custom"></p>
            <p>· Edad recomendada: 8 años en adelante.</p>
            <p>· Tamaño de la caja: 17 x 22 x 6 cms </p>
            <p>· Leer ciudadosamente las instrucciones. Se requiere supervisión de un adulto. </p>
            <p>· Este producto contiene partes pequeñas. </p>
            <p>· Manténgase fuera del alcance de niños menores a la edad recomendada.</p>
        </div>

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
<script src="{{url('js/qty.js')}}"></script>

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
