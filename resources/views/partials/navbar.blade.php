  <!--================Header Menu Area =================-->
  <header class="header_area">
      <div class="top_menu">
          <div class="container">
              <div class="d-flex no-gutters">
                  <div class="col">

                      <ul class="right_side">

                          <li>
                              <a href="{{ route('home') }}">
                                  Español
                              </a>
                          </li>

                          {{-- <li>
                <a href="{{ route('home') }}">
                  English
                </a>
              </li> --}}
                      </ul>
                  </div>
                  <div class="col-sm-6">


                      <div class="float-right row no-gutters right_side">

                          <p class="mb-0 mr-2">

                              <i class="fab fa-whatsapp green" style="font-size: 1.4em;"></i>
                              <a href="https://wa.me/57{{ $param->numerocontacto }}?text=Hola,%20estoy%20interesad@%20en%20tus%20productos.%20Me%20gustaría%20obtener%20más%20información%20acerca%20de:%20"
                                  target="_blank"
                                  class="black book ml-1 none-text body-text">{{ $param->numerocontacto }}</a>
                          </p>




                          <li class="nav-item submenu dropdown">
                              <a href="#" class="nav-link" data-toggle="dropdown" role="button"
                                  aria-haspopup="true" aria-expanded="false"> <img src="{{ asset('img/account.png') }}"
                                      class="img-fluid header-icon">MiCuenta</a>
                              <ul class="dropdown-menu">
                                  <li class="nav-item">
                                      @if (Auth::check())
                                          <a class="nav-link" href="{{ route('logout') }}">Salir</a>
                                      @else
                                          <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                                      @endif
                                  </li>

                              </ul>
                          </li>


                          <a href="{{ route('favoritos') }}" class="icons">
                              <img src="{{ asset('img/corazon.png') }}" class="img-fluid header-icon">
                          </a>
                          <a data-toggle="modal" data-target="#modalCiudadesSelector" class="icons">
                              <img src="{{ asset('img/location.png') }}" class="img-fluid header-icon">
                          </a>

                          <a href="#" class="icons" id="cart">
                              <img src="{{ asset('img/cart.png') }}" class="img-fluid header-icon"><span
                                  class="counter">{{ Cart::instance('default')->content()->count() > 0? Cart::instance('default')->content()->count(): null }}</span>
                          </a>

                          <div class="shopping-cart">

                              @if (Cart::instance('default')->content()->count() > 0)
                                  <ul class="shopping-cart-items">
                                      @foreach (Cart::instance('default')->content() as $product)
                                          <li class="clearfix d-block">
                                              <a
                                                  href="{{ route('product.show', ['slug' => isset($product->slug) ? $product->slug : 'null']) }}">
                                                  <img src="{{ $product->options->imagen }}" class="img-fluid"
                                                      alt="item1" />
                                                  <span class="item-name top-text">{{ $product->name }}</span>
                                                  {{-- <span class="item-name ">{{$producto->getMarcaProduct($producto->id)['nombre'] }}</span> --}}

                                                  {{-- <span class="item-name bold black">{{$product->qty}}x
                      {{'$' .formatPrice($product->price ) }}
                    </span>
                    --}}


                                                  @if (isset($product->options->promocion->start) &&
                                                          \Carbon\Carbon::now()->between($product->options->promocion->start, $product->options->promocion->end))
                                                      <div class="d-flex">
                                                          <span class="item-name bold black">
                                                              {{ '$' . number_format((float) $product->price, 0, ',', '.') }}
                                                          </span>

                                                          <span class="item-name tachado font-weight-light ml-1">
                                                              {{ '$' . number_format((float) $product->options->precioventa_iva, 0, ',', '.') }}
                                                          </span>
                                                          <div class="ml-1">x {{ $product->qty }}</div>
                                                      </div>
                                                  @else
                                                      <div class="d-flex justify-content-ceter x {{ $product->qty }}">
                                                          <span class="bold black">
                                                              {{ '$' . number_format((float) precioNew($product->id), 0, ',', '.') }}
                                                          </span>
                                                          <div class="ml-1">x {{ $product->qty }}</div>
                                                      </div>
                                                  @endif



                                                  <form action="{{ route('resumen.destroy', $product->rowId) }}"
                                                      method="POST" class="trash-form">
                                                      {{ csrf_field() }}
                                                      {{ method_field('DELETE') }}
                                                      <button type="submit" class="btn-transparent cart-icon-trash">
                                                          <img src="{{ asset('img/trash.png') }}" class="img-fluid ">

                                                      </button>
                                                  </form>
                                              </a>
                                          </li>
                                      @endforeach
                                  </ul>
                              @endif

                              @if (Cart::instance('default')->content()->count() > 0)
                                  <div class="gray-border-bottom mb-2"></div>
                                  <div class="shopping-cart-header ml-3 mr-3 mb-3">
                                      {{-- <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span> --}}
                                      <div class="shopping-cart-total mt-1">
                                          <span class="item-name bold black">Total</span>
                                          <span class="item-name bold black">{{ '$' . formatPrice($total) }}</span>
                                      </div>
                                  </div> <!--end shopping-cart-header -->
                                  <div class="button-cart-container mb-2">
                                      <div class="mb-2 mr-2">
                                          <a href="{{ route('resumen') }}" class="btn btn-primary checkout-button">
                                              <img src="{{ asset('img/cart-white.png') }}"
                                                  class="img-fluid header-icon">
                                              Ver carrito</a>
                                      </div>

                                      <div class="mb-2 mr-2">
                                          <a href="{{ route('checkout') }}" class="btn btn-danger checkout-button">
                                              <img src="{{ asset('img/cart-white.png') }}"
                                                  class="img-fluid header-icon">
                                              Pagar $ </a>
                                      </div>
                                  </div>
                              @else
                                  <div class="shopping-cart-header m-3">
                                      <div class="shopping-cart-total text-center">
                                          <span class="item-name bold black">Carrito vacío</span>
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


                  <div class="col-lg-4 top-brand">
                      <a class="logo_h" href="{{ route('home') }}">
                          {{-- <img src="{{ asset('img/logo-materile.png') }}"  alt="" class="img-fluid logo-bar" /> --}}
                          <a title="{{ $param->nombre_tienda }}" href="{{ route('welcome') }}">
                              <img alt="{{ $param->nombre_tienda }}" src="//{{ $param->logo }}"
                                  class="img-fluid logo-bar">
                          </a>
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


                      <form action="{{ route('store.search') }}" method="get" accept-charset="utf-8">

                          <input type="text" name="search" id="search"
                              class="form-control search button-rounded body-text"
                              placeholder="Buscar... Palabra clave o Referencia (Enter)"
                              value="{{ isset($search_key) ? $search_key : '' }}">
                      </form>
                      {{-- }} <input type="text" name="search" id="search" class="form-control search ti-search" placeholder="Buscar &#xe610;"> --}}

                  </div>

              </div>



              {{-- <div id="search-component"><div> --}}



              <nav class="navbar navbar-expand-lg navbar-light w-100 justify-content-center">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <a class="navbar-brand logo_h hidden" href="{{ route('welcome') }}">
                      <img alt="{{ $param->nombre_tienda }}" src="//{{ $param->logo }}"
                          class="img-fluid logo-bar" />
                  </a>
                  <button class="navbar-toggler floating-toggler" type="button" data-toggle="collapse"
                      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                      <div class="row w-100 mr-0">
                          <div class="col-lg-12 pr-0">
                              <ul class="nav center-nav-bar p-4">
                                  {{-- }}

                    --}}

                                  @if (
                                      $categoriasBoot->count() > 0 &&
                                          ($param->categories_bar_position == 'up' || $param->categories_bar_position == 'both'))
                                      <li class="nav-item submenu dropdown">
                                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                              role="button" aria-haspopup="true"
                                              aria-expanded="false">Categorías</a>
                                          <ul class="dropdown-menu">
                                            {{--
                                              @foreach ($categoriasBoot as $category)
                                                  <li class="nav-item">
                                                      <a class="nav-link text-capitalize"
href="{{ route('categoria.get', [
    'cat' => $cat2 ?? 1,
    'id' => $category->slug ?? 'null'
]) }} ">{{ $category->nombrecategoria }}</a>
                                                  </li>
                                              @endforeach
                                              --}}
                                          </ul>
                                      </li>
                                  @else
                                      <li class="nav-item {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
                                          <a class="nav-link mayus" href="{{ route('home') }}">Inicio</a>
                                      </li>
                                  @endif

                                  @if (count(\App\Categoria6::all()))
                                      @foreach (\App\Categoria6::all() as $data)
                                          @if ($data->show_on_side == true)
                                              <li class="nav-item submenu dropdown">
                                                  <a href="#" class="nav-link dropdown-toggle"
                                                      data-toggle="dropdown" role="button" aria-haspopup="true"
                                                      aria-expanded="false">{{ $data->nombrecategoria }}</a>
                                                  @if (isset($allFilters))
                                                      <ul class="dropdown-menu">
                                                          @foreach ($data->categories($allFilters) as $category)
                                                              <li class="nav-item">
                                                                  <a class="nav-link text-capitalize"
                                                                      href="{{ route('filter.search', $category->nombrecategoria ) }}"
                                                                      class="no-decoration text-capitalize">{{ $category->nombrecategoria }}</a>
                                                              </li>
                                                          @endforeach
                                                      </ul>
                                                  @endif
                                              </li>
                                          @endif
                                      @endforeach
                                  @endif



                                  <li class="nav-item {{ Route::currentRouteNamed('tiendas') ? 'active' : '' }}">
                                      <a class="nav-link mayus" href="{{ route('tiendas') }}">TIENDAS</a>
                                  </li>

                                  <li
                                      class="nav-item {{ Route::currentRouteNamed('novedades.index') ? 'active' : '' }}">
                                      <a class="nav-link mayus" href="{{ route('novedades.index') }}">NOVEDADES</a>
                                  </li>

                                  <li
                                      class="nav-item {{ Route::currentRouteNamed('ofertas.index') ? 'active' : '' }}">
                                      <a class="nav-link mayus" href="{{ route('ofertas.index') }}">DESCUENTOS</a>
                                  </li>

                                  @if ($param->show_featued_in_home == true)
                                      <li
                                          class="nav-item {{ Route::currentRouteNamed('masvendidos.index') ? 'active' : '' }}">
                                          <a class="nav-link" href="{{ route('masvendidos.index') }}">Destacados</a>
                                      </li>
                                  @endif
                                  <li class="nav-item {{ Route::currentRouteNamed('about_us') ? 'active' : '' }}">
                                      <a class="nav-link mayus" href="{{ route('about_us') }}">Contáctanos</a>
                                  </li>

                                  <li class="nav-item {{ Route::currentRouteNamed('register') ? 'active' : '' }}">
                                      <a class="nav-link mayus" href="{{ route('register') }}">Registro</a>
                                  </li>


                                  {{--
                      <li class="nav-item {{Route::currentRouteNamed('home') ? 'active' : '' }}">
                        <a class="nav-link mayus" href="{{ route('home') }}">Categorías</a>
                      </li> --}}



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
      <div class="container mt-2">
          {{ Breadcrumbs::render() }}
      </div>
  </header>
  <!--================Header Menu Area =================-->
