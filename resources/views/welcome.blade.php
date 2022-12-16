
<!DOCTYPE html>
<html lang="en">
<head>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    @if(\Request::route()->getName() != 'product.show')
    {!! JsonLd::generate() !!}
    @endif


  {{--<title>{{$param->nombre_tienda}}</title>--}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="description" content="Ecommerce">-->
  <link rel='canonical' href='{{url()->current()}}' />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('extra-meta')

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="//{{$param->logo}}" />
  {{--}}
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link href="{{asset('css/fontawesome-all.min.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('pllCugins/Owarousel2-2.2.1/owl.theme.default.css')}}">
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
  <link rel="stylesheet" href="{{asset('css/toastr.css')}}" />

  <link href="{{asset('css/captions-original.css')}}" rel="stylesheet">
  <link href="{{asset('css/pmd-scrollbar.css')}}" rel="stylesheet">
  <link href="{{asset('css/floating-wpp.min.css')}}" rel="stylesheet">
  --}}

  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
/>

<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/icon?family=Material+Icons"
/>
       @if (config('app.env') == 'local')
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        @else
        <link rel="stylesheet" href="{{asset(mix('css/all.css'), true)}}">
        @endif


  @yield('extra-css')

  {{--<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">--}}
</head>

<body>

  
  <div class="super_container">
    <div id="cart-component"
    data-total="{{$total}}"
    data-productimage="{{asset('img/product.png')}}"
    ></div>

    <div id="loading">
      <div class="load-circle">
        <span class="one"></span>
      </div>
    </div>

    {{--@include('partials.header')--}}
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
    @include('partials.modalCiudadesSelector')
  </div>

@if (config('app.env') == 'local')
<script src="{{asset(mix('js/all.js'))}}"></script>
@else
<script src="{{asset(mix('js/all.js'), true)}}"></script>
@endif

@routes


  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.js')}}"></script>
  <script src="{{asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
  <script src="{{asset('plugins/easing/easing.js')}}"></script>
  <script src="{{asset('plugins/parallax-js-master/parallax.min.js')}}"></script>

  <script src="{{asset('plugins/greensock/TweenMax.min.js')}}"></script>
  <script src="{{asset('plugins/greensock/TimelineMax.min.js')}}"></script>
  <script src="{{asset('plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
  <script src="{{asset('plugins/greensock/animation.gsap.min.js')}}"></script>
  <script src="{{asset('plugins/greensock/ScrollToPlugin.min.js')}}"></script>
{{--}}

  <script src="{{asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
--}}
  <script src="{{asset('plugins/Isotope/isotope.pkgd.min.js')}}"></script>
  <script src="{{url('js/jquery.themepunch.revolution.min.js')}}"></script>
  <script src="{{url('js/jquery.themepunch.tools.min.js')}}"></script>
  <script src="{{url('js/jquery.themepunch.plugins.min.js')}}"></script>
  <script src="{{asset('js/toastr.min.js')}}"></script>
  <script src="{{asset('js/floating-wpp.min.js')}}"></script>
  <script src="{{asset('js/theme.js')}}"></script>
  <script src="{{asset('js/global.js')}}"></script>
  <script src="{{asset('js/checkbox.js')}}"></script>
  <script src="{{asset('js/jquery-migrate-1.4.1.min.js')}}"></script>

  <script src="{{asset('js/shop_custom.js')}}"></script>
  @include('sweetalert::alert')


<!-- add or no pixel MAIN code-->
@if(App\Pixel::first()->pixel_id !=null)
{!!\App\Pixel::first()->code!!} 
@endif


<!-- add custom main js-->
@foreach (App\CustomJs::where('type', 'custom_js_main')->get() as $data)
    {!! $data->code!!}
@endforeach

  @yield('extra-js')
  <script>
    (function(){

      $("#cart").on("click", function() {
        $(".shopping-cart").fadeToggle( "fast");
      });

    })();


    $(document).ready(function() {
     $('[data-toggle=dropdown]').dropdown()
      $('[data-toggle=popover]').popover();
    });
    $(window).on("load", function(){
     document.getElementById("loading").style.display = "none";
   });
 </script>


  @include('partials.js.city_selector')
@toastr_render
<div id="myDiv"></div>

<a href="{{route('about_us')}}" class="float d-flex justify-content-center btn-top-home">
  {{--<i class="fa fa-plus my-float"></i>--}}
<div class="chat-box">
  <img width="35" src="{{ asset('img/chatwhite.png') }}" class="chat-img"/>

</div>

  </a>


<script>
  $('#myDiv').floatingWhatsApp({
    phone: '57{{$param->numerocontacto}}',
    position:'right',
    popupMessage: 'Hola, ¿Necesitas ayuda? ',
    message: "{{env('WHATSAPP_CONTACT_TEXT')}}",
    showPopup: true,
    showOnIE: true,
    headerTitle: 'Estamos online;',
  /*headerColor: 'var(--blue)',
  backgroundColor: 'var(--blue)',*/
  buttonImage: '<img src="{{ asset('img/whatsapp2.svg') }}" />',
  //autoOpenTimeout:'60000',
  size:'50px',
  showPopup: false
});

</script>

{{--
{!!$schema_org!!}
{!!$graph!!}
--}}



</body>

</html>
