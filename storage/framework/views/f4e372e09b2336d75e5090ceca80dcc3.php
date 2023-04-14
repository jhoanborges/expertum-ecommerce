  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="d-flex no-gutters">
          <div class="col">

            <ul class="right_side">

              <li>
                <a href="<?php echo e(route('home')); ?>">
                  Español
                </a>
              </li>

              
            </ul>
          </div>
          <div class="col-sm-6">


            <div class="float-right row no-gutters right_side">

              <p class="mb-0 mr-2">

                <i class="fab fa-whatsapp green" style="font-size: 1.4em;"></i>
                <a  href="https://wa.me/57<?php echo e($param->numerocontacto); ?>?text=Hola,%20estoy%20interesad@%20en%20tus%20productos.%20Me%20gustaría%20obtener%20más%20información%20acerca%20de:%20" target="_blank" class="black book ml-1 none-text body-text"><?php echo e($param->numerocontacto); ?></a>
              </p>




              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false"> <img src="<?php echo e(asset('img/account.png')); ?>" class="img-fluid header-icon">MiCuenta</a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <?php if(Auth::check()): ?>
                    <a class="nav-link" href="<?php echo e(route('logout')); ?>">Salir</a>
                    <?php else: ?>
                    <a class="nav-link" href="<?php echo e(route('login')); ?>">Entrar</a>

                    <?php endif; ?>
                  </li>

                </ul>
              </li>


              <a href="<?php echo e(route('favoritos')); ?>" class="icons">
                <img src="<?php echo e(asset('img/corazon.png')); ?>" class="img-fluid header-icon">
              </a>
              <a  data-toggle="modal" data-target="#modalCiudadesSelector"
              class="icons">
              <img src="<?php echo e(asset('img/location.png')); ?>" class="img-fluid header-icon">
            </a>

            <a href="#" class="icons" id="cart">
              <img src="<?php echo e(asset('img/cart.png')); ?>" class="img-fluid header-icon"><span class="counter"><?php echo e(Cart::instance('default')->content()->count() >0 ? Cart::instance('default')->content()->count() : null); ?></span>
            </a>

            <div class="shopping-cart">

              <?php if( Cart::instance('default')->content()->count() > 0): ?>
              <ul class="shopping-cart-items">
                <?php $__currentLoopData = Cart::instance('default')->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="clearfix d-block">
                  <a href="<?php echo e(route('product.show' , ['slug'=>
                  isset( $product->slug) ? $product->slug : 'null'
                   ])); ?>">
                    <img src="<?php echo e($product->options->imagen); ?>" class="img-fluid" alt="item1" />
                    <span class="item-name top-text"><?php echo e($product->name); ?></span>
                    

                    


                    <?php if( isset($product->options->promocion->start )
                    &&   \Carbon\Carbon::now()->between($product->options->promocion->start, $product->options->promocion->end)
                    ): ?>
                    <div class="d-flex">
                        <span class="item-name bold black">
                          <?php echo e('$' . number_format((float) $product->price, 0, ',', '.')); ?>

                        </span>

                        <span
                            class="item-name tachado font-weight-light ml-1">
                            <?php echo e('$' . number_format((float) $product->options->precioventa_iva, 0, ',', '.')); ?>

                        </span> <div class="ml-1">x <?php echo e($product->qty); ?></div>
                    </div>
                    <?php else: ?>
                    <div class="d-flex justify-content-ceter x <?php echo e($product->qty); ?>">
                        <span class="bold black">
                            <?php echo e('$' . number_format((float) precioNew($product->id), 0, ',', '.')); ?>

                        </span> <div class="ml-1">x <?php echo e($product->qty); ?></div>
                    </div>
                    <?php endif; ?>



                    <form action="<?php echo e(route('resumen.destroy', $product->rowId)); ?>" method="POST" class="trash-form">
                      <?php echo e(csrf_field()); ?>

                      <?php echo e(method_field('DELETE')); ?>

                      <button type="submit" class="btn-transparent cart-icon-trash">
                        <img src="<?php echo e(asset('img/trash.png')); ?>" class="img-fluid ">

                      </button>
                    </form>
                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php endif; ?>

              <?php if( Cart::instance('default')->content()->count() > 0): ?>


              <div class="gray-border-bottom mb-2"></div>
              <div class="shopping-cart-header ml-3 mr-3 mb-3">
                
                <div class="shopping-cart-total mt-1">
                  <span class="item-name bold black">Total</span>
                  <span class="item-name bold black"><?php echo e('$' .formatPrice($total)); ?></span>
                </div>
              </div> <!--end shopping-cart-header -->
              <div class="button-cart-container mb-2">
                <div class="mb-2 mr-2">
                  <a href="<?php echo e(route('resumen')); ?>" class="btn btn-primary checkout-button">
                    <img src="<?php echo e(asset('img/cart-white.png')); ?>" class="img-fluid header-icon">
                  Ver carrito</a>
                </div>

                <div class="mb-2 mr-2">
                  <a href="<?php echo e(route('checkout')); ?>" class="btn btn-danger checkout-button">
                    <img src="<?php echo e(asset('img/cart-white.png')); ?>" class="img-fluid header-icon">
                  Pagar $ </a>
                </div>
              </div>

              <?php else: ?>
              <div class="shopping-cart-header m-3">
                <div class="shopping-cart-total text-center">
                  <span class="item-name bold black">Carrito vacío</span>
                </div>
              </div>
              <?php endif; ?>


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
          <a class="logo_h" href="<?php echo e(route('home')); ?>">
            
            <a title="<?php echo e($param->nombre_tienda); ?>" href="<?php echo e(route('welcome')); ?>">
              <img alt="<?php echo e($param->nombre_tienda); ?>" src="//<?php echo e($param->logo); ?>" class="img-fluid logo-bar">
            </a>
          </a>
        </div>

        <div class="col-lg-4 mx-auto search-bar">
          <div class="placeholder">
                
                </div>
                <form action="<?php echo e(route('store.search')); ?>" method="get" accept-charset="utf-8">

                  <input type="text" name="search" id="search" class="form-control search button-rounded body-text" placeholder="Buscar... Palabra clave o Referencia (Enter)" value="<?php echo e(isset($search_key) ?$search_key : ''); ?>" >
                </form>
                

              </div>

            </div>






            <nav class="navbar navbar-expand-lg navbar-light w-100 justify-content-center">
              <!-- Brand and toggle get grouped for better mobile display -->
              <a class="navbar-brand logo_h hidden" href="<?php echo e(route('welcome')); ?>">
                <img  alt="<?php echo e($param->nombre_tienda); ?>" src="//<?php echo e($param->logo); ?>" class="img-fluid logo-bar" />
              </a>
              <button class="navbar-toggler floating-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
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
                    

                         <?php if( $categoriasBoot->count() > 0
                          &&
                          ($param->categories_bar_position == 'up' ||  $param->categories_bar_position == 'both' )
                         ): ?>
                         <li class="nav-item submenu dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Categorías</a>
                      <ul class="dropdown-menu">
<?php $__currentLoopData = $categoriasBoot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                          <a class="nav-link text-capitalize" href="<?php echo e(route('categoria.get', ['cat' => ($cat2 ?? 1)   , 'id' => $category->slug ?? 'null'])); ?> "><?php echo e($category->nombrecategoria); ?></a>
                        </li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                    </li>
<?php else: ?>
    <li class="nav-item <?php echo e(Route::currentRouteNamed('home') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('home')); ?>">Inicio</a>
                    </li>
                        <?php endif; ?>

<?php if(count(\App\Categoria6::all()) ): ?>
                  <?php $__currentLoopData = \App\Categoria6::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->show_on_side == true): ?>
                                <li class="nav-item submenu dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false"><?php echo e($data->nombrecategoria); ?></a>
                      <?php if(isset($allFilters)): ?>
                      <ul class="dropdown-menu">
 <?php $__currentLoopData = $data->categories($allFilters); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                          <a class="nav-link text-capitalize" href="<?php echo e(route('store.search', ['search' =>$category->nombrecategoria , 'strict' => true ])); ?>" class="no-decoration text-capitalize"><?php echo e($category->nombrecategoria); ?></a>
                        </li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                      <?php endif; ?>
                    </li>
<?php endif; ?>


                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>



                    <li class="nav-item <?php echo e(Route::currentRouteNamed('tiendas') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('tiendas')); ?>">TIENDAS</a>
                    </li>

                    <li class="nav-item <?php echo e(Route::currentRouteNamed('novedades.index') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('novedades.index')); ?>">NOVEDADES</a>
                    </li>

                    <li class="nav-item <?php echo e(Route::currentRouteNamed('ofertas.index') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('ofertas.index')); ?>">DESCUENTOS</a>
                    </li>

                    <?php if($param->show_featued_in_home == true): ?>

                    <li class="nav-item <?php echo e(Route::currentRouteNamed('masvendidos.index') ? 'active' : ''); ?>">
                      <a class="nav-link" href="<?php echo e(route('masvendidos.index')); ?>">Destacados</a>
                    </li>
                     <?php endif; ?>
                    <li class="nav-item <?php echo e(Route::currentRouteNamed('about_us') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('about_us')); ?>">Contáctanos</a>
                    </li>

                    <li class="nav-item <?php echo e(Route::currentRouteNamed('register') ? 'active' : ''); ?>">
                      <a class="nav-link mayus" href="<?php echo e(route('register')); ?>">Registro</a>
                    </li>


                    



                    </ul>
                  </div>

                    

                    </div>


                  </div>
                </nav>
              </div>
            </div>
            <div class="container mt-2">
              <?php echo e(Breadcrumbs::render()); ?>

            </div>
          </header>
          <!--================Header Menu Area =================-->
<?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/partials/navbar.blade.php ENDPATH**/ ?>