
<!DOCTYPE html>
<html lang="en">
<head>
<title>Materile Juguetes</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('img/logo-materile.png') }}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
<link href="{{asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/shop_responsive.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/card.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/google-icons.css')}}">
 <link href="{{asset('css/settings.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}" />
  <link rel="stylesheet" href="{{asset('css/flaticon.css')}}" />
 <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
  <link rel="stylesheet" href="{{asset('css/checkbox.css')}}" />

  <link href="{{asset('css/captions-original.css')}}" rel="stylesheet">

@yield('extra-css')

<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
</head>

<body>
<div class="super_container">

    <div id="loading">
    <div class="load-circle">
      <span class="one"></span>
    </div>
  </div>


 {{--@include('partials.header')--}}
 @include('partials.navbar')
@yield('content')
@include('partials.footer')
</div>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('plugins/easing/easing.js')}}"></script>
<script src="{{asset('plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>

  <script src="{{url('js/jquery.themepunch.revolution.min.js')}}"></script>
 <script src="{{url('js/jquery.themepunch.tools.min.js')}}"></script>
 <script src="{{url('js/jquery.themepunch.plugins.min.js')}}"></script>

@yield('extra-js')
  {{--<script src="{{asset('js/theme.js')}}"></script>--}}
<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/checkbox.js')}}"></script>

<script src="{{asset('js/shop_custom.js')}}"></script>
  <script >

    (function(){

  $("#cart").on("click", function() {
    $(".shopping-cart").fadeToggle( "fast");
  });

})();


$(document).ready(function() {
    $('[data-toggle=popover]').popover();
});
    $(window).on("load", function(){
     document.getElementById("loading").style.display = "none";
   });
 </script>


</body>

</html>
