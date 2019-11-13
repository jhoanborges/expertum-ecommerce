  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="d-flex no-gutters">
          <div class="col">

              <ul class="right_side">
                <li>
                  <a href="tracking.html">
                    Español
                </a>
            </li>
            <li>
              <a href="contact.html">
                English
            </a>
        </li>
    </ul>

    {{--<p>email: info@eiser.com</p>--}}

</div>
<div class="col-sm-6">


    <div class="float-right row no-gutters right_side">

     <p class="mb-0 mr-2">

      <i class="fab fa-whatsapp green" style="font-size: 1.4em;"></i>
      <a  href="tel:+573168301653" class="black book ml-1 none-text body-text">316 830 1653</a>
  </p>


  <li class="nav-item submenu dropdown">
      <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
      aria-expanded="false"> <img src="{{ asset('img/account.png') }}" class="img-fluid header-icon"></a>
      <ul class="dropdown-menu">
        <li class="nav-item">
            @if(Auth::check())
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            @else
            <a class="nav-link" href="{{ route('login') }}">Login</a>

            @endif
        </li>

    </ul>
</li>
{{--}}
  <a href="{{ route('login') }}" class="icons">
      <img src="{{ asset('img/account.png') }}" class="img-fluid header-icon">
  </a>
  --}}
  <a href="#" class="icons">
      <img src="{{ asset('img/corazon.png') }}" class="img-fluid header-icon">
  </a>

  <a  data-toggle="modal" data-target="#modalCiudadesSelector"
  class="icons">
  <img src="{{ asset('img/location.png') }}" class="img-fluid header-icon">
</a>

<a href="#" class="icons" id="cart">
  {{--<div class="circle"></div>--}}
  <img src="{{ asset('img/cart.png') }}" class="img-fluid header-icon"><span class="counter">{{
    Cart::instance('default')->content()->count() >0 ? Cart::instance('default')->content()->count() : null
}}</span>
</a>

{{--<li><a href="#" id="cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">3</span></a></li>--}}

<div class="shopping-cart">

  @if( Cart::instance('default')->content()->count() > 0)
  <ul class="shopping-cart-items">
    @foreach (Cart::instance('default')->content() as $product)
    <li class="clearfix d-block">
      <a href="{{route('product.show' , ['product'=>$product->id ])}}">
        <img src="{{$product->options->imagen }}" class="img-fluid" alt="item1" />
        <span class="item-name top-text">{{$product->name}}</span>
        {{--<span class="item-name ">{{$producto->getMarcaProduct($producto->id)['nombre'] }}</span>--}}
        <span class="item-name bold black">{{$product->qty}}x {{'$' .formatPrice(precioNew($product->id) ) }}</span>
        <form action="{{route('resumen.destroy', $product->rowId)}}" method="POST" class="trash-form">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button type="submit" class="btn-transparent cart-icon-trash">
            <img src="{{ asset('img/trash.png') }}" class="img-fluid ">

        </button>
    </form>
</a>
</li>
@endforeach
</ul>
@endif

@if( Cart::instance('default')->content()->count() > 0)




<div class="gray-border-bottom mb-2"></div>
<div class="shopping-cart-header ml-3 mr-3 mb-3">
    {{--<i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>--}}
    <div class="shopping-cart-total mt-1">
      <span class="item-name bold black">Total</span>
      <span class="item-name bold black">{{'$' .formatPrice($total) }}</span>
  </div>
</div> <!--end shopping-cart-header -->
<div class="button-cart-container mb-2">
    <div class="mb-2 mr-2">
      <a href="{{route('resumen')}}" class="btn btn-primary checkout-button">
        <img src="{{ asset('img/cart-white.png') }}" class="img-fluid header-icon">
    Ver carrito</a>
</div>

<div class="mb-2 mr-2">
  <a href="{{route('checkout')}}" class="btn btn-danger checkout-button">
    <img src="{{ asset('img/cart-white.png') }}" class="img-fluid header-icon">
Checkout</a>
</div>
</div>
@endif


</div> <!--end shopping-cart -->




</div>
</div>
</div>
</div>
</div>



<div class="main_menu">

    <div class="container text-center h-100">

      <div class="row  align-items-center h-100 mt-2 no-gutters">

       <div class="col-lg-4">
       </div>


       <div class="col-lg-4">
         <a class="logo_h top-brand" href="{{ route('home') }}">
          <img src="{{ asset('img/logo-materile.png') }}"  alt="" class="img-fluid logo-bar" />
      </a>
  </div>

  <div class="col-lg-4 mx-auto search-bar">
    <div class="placeholder">
{{--
          <label for="search" class="grayf mb-0">BUSCAR...
            <i class="ti-search search-icon">        </i>
            <span class="barra">|</span>
          </label>
          --}}
      </div>
            <form action="{{route('store.search')}}" method="get" accept-charset="utf-8">

      <input type="text" name="search" id="search" class="form-control search button-rounded body-text" placeholder="Buscar..." value="{{isset($search_key) ?$search_key : '' }}" >
  </form>
      {{--}} <input type="text" name="search" id="search" class="form-control search ti-search" placeholder="Buscar &#xe610;">--}}

  </div>

</div>






<nav class="navbar navbar-expand-lg navbar-light w-100 ">
  <!-- Brand and toggle get grouped for better mobile display -->
  <a class="navbar-brand logo_h hidden" href="index.html">
    <img src="{{ asset('img/logo-materile.png') }}" alt="" class="img-fluid logo-bar" />
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
  <div class="row w-100 mr-0">
    <div class="col-lg-12 pr-0">
      <ul class="nav center-nav-bar p-4">
        <li class="nav-item {{Route::currentRouteNamed('home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('home') }}">Inicio</a>
      </li>

      <li class="nav-item {{Route::currentRouteNamed('home') ? 'active' : '' }}">
          <a class="nav-link mayus" href="{{ route('home') }}">categorías</a>
      </li>
      <li class="nav-item ">
          <a class="nav-link mayus" href="">Ofertas</a>
      </li>
{{--
                <li class="nav-item submenu dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Ofertas</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="tracking.html">Tracking</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="elements.html">Elements</a>
                    </li>
                  </ul>
                </li>
                --}}
                <li class="nav-item dropdown">
                  <a class="nav-link" href="contact.html">MÁS VENDIDOS</a>
              </li>

              <li class="nav-item dropdown">
                  <a class="nav-link" href="contact.html">NOVEDADES</a>
              </li>


              <li class="nav-item dropdown">
                  <a class="nav-link" href="contact.html">TIENDAS</a>
              </li>



              <li class="nav-item ">
                  <a class="nav-link mayus" href="">CONTACTO</a>
              </li>


              <li class="nav-item dropdown">
                  <a class="nav-link" href="contact.html"></a>
              </li>


          </ul>
      </div>

{{--
              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-search" aria-hidden="true"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-user" aria-hidden="true"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-heart" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
              --}}

          </div>


      </div>
  </nav>
</div>
</div>
</header>
<!--================Header Menu Area =================-->
