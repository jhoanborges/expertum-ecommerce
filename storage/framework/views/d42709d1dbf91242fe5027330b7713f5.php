<?php $__env->startSection('content'); ?>

<?php $__env->startSection('extra-css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/nouislider.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/checkbox.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/roundedcheckbox.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/range-slider.css')); ?>">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Shop -->

<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            <?php if(\Route::currentRouteName() != 'store.search'): ?>
            <div class="col-lg-2">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar d-none d-sm-block d-md-none d-lg-none d-xl-block">
                    <div class="sidebar_section">
                        <ul class="brands_list mt-0">
                            <li class="row no-gutters h-100">

                                <?php if($categorias->count() > 0 && ($param->categories_bar_position == 'left' || $param->categories_bar_position == 'both')): ?>
                                    <div class="sidebar_section w-100" id="sidebar_section">
                                        <div class="row no-gutters footer_title mayus">
                                            <div class="col-sm-12 no-gutters">
                                                <span>CATEGORÍAS</span>
                                                <a class="float-right" onclick="activate(); return false;">
                                                    <i class="ti-search pointer"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input id="myInput" placeholder="Buscar"
                                            class="mt-2 search form-control fuzzy-search no-show" />


                                    </div>
                                <?php endif; ?>


                                <?php if(count($marcas)): ?>
                                    <div class="col-lg-12 mb-4">
                                        <div id="accordion" class="accordion">


                                            <div class="card no-borders">

                                                <div class="card-header pointer collapsed" data-toggle="collapse"
                                                    href="#collapseOne">
                                                    <a class="card-title mayus">
                                                        Marcas
                                                    </a>
                                                </div>
                                                <div id="collapseOne"
                                                    class="card-body collapse pl-0 pr-0 <?php echo e(!empty($checked) ? 'show' : null); ?> scrollable mCustomScrollbar"
                                                    data-parent="#accordion">
                                                    <!-- Simple checkbox with label, checked -->

                                                    <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="checkbox pmd-default-theme mt-3">
                                                            <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                                                                <input type="checkbox" value="<?php echo e($mark->id); ?>"
                                                                    class="brands"
                                                                    <?php if(!empty($checked)): ?> <?php $__currentLoopData = $checked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php echo e($filter == $mark->id ? 'checked' : null); ?>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>>

                                                                <span><?php echo e($mark->nombre); ?></span>
                                                            </label>
                                                            <span
                                                                class="badge badge-light"><?php echo e($mark->cantidad); ?></span>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(count($projects) > 0): ?>
                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('partials.filtros', $project, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>


                                <?php if(!empty($max)): ?>
                                    <div class="col-lg-12">
                                        <div class="card-title mayus">Precio</div>
                                        <div class="row">
                                            
                                            <div class="col-lg-6 mb-1 ">
                                                <input class="form-control price-form min" type="number"
                                                    value="<?php echo e(floor(floatval($min))); ?>">
                                            </div>

                                            <div class="col-lg-6 mb-1 ">
                                                <input class="form-control price-form max" type="number"
                                                    value="<?php echo e(floor(floatval($max))); ?>">
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <button
                                                    class="btn btn-primary checkout-button w-100 btn-gray white price-filter">
                                                    <i class="fas fa-filter"></i>Filtrar</button>
                                            </div>


                                        </div>
                                    </div>
                                <?php endif; ?>

                            </li>

                        </ul>
                    </div>

                </div>

            </div>

<?php endif; ?>



            <div class="col-lg-10 ">

                <!-- Shop Content -->
                <div class="shop_content ">
                    <div class="store_title mayus mb-2">
                        <?php echo e(isset($categorias_nombre['nombrecategoria']) ? $categorias_nombre['nombrecategoria'] : 'PRODUCTOS ENCONTRADOS: ' . $search_key); ?>

                    </div>

                    <div class="">
                        <div class="product_grid_border"></div>
                        <div class="row">

                            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Product Item -->
                                <div class="col-sm-3 ">
                                    <!--<div class="product_border"></div>-->
                                    <div class="product-image-content product-item text-center">
                                        <a class="product-img"
                                            href="<?php echo e(route('product.show', ['slug' => isset($producto['slug']) ? $producto['slug'] : 'null'])); ?>">

                                            <?php if($producto->hasManyImagenes->first()): ?>
                                                <img class="img-fluid"
                                                    src="<?php echo e(image($producto->hasManyImagenes->first()->urlimagen)); ?>"
                                                    alt="<?php echo e($producto['nombre_producto']); ?>">
                                            <?php else: ?>
                                                <img class="img-fluid" src="<?php echo e(image('')); ?>"
                                                    alt="<?php echo e($producto['nombre_producto']); ?>">
                                            <?php endif; ?>
                                        </a>
                                    </div>


                                    <?php if($producto->promocion()->exists() && ($check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end))): ?>
                                        <span class="icon-sale-label sale-right">
                                            <img class="img-fluid" src="<?php echo e($producto->promocion()->first()->imagen); ?>"
                                                alt="<?php echo e($producto->promocion()->first()->name); ?>" data-toggle="tooltip"
                                                data-placement="right"
                                                title="<?php echo e($producto->promocion()->first()->name); ?>">
                                        </span>
                                    <?php endif; ?>
                                    <div class="product_content">

                                        <div class="pmd-card-title">
                                            <ul class="list-inline text-center">
                                                <a
                                                href="<?php echo e(route('product.show', ['slug' => isset($producto['slug']) ? $producto['slug'] : 'null'])); ?>">
                                                    <li
                                                        class="pmd-card-subtitle-text blue body-text title-height list-inline  text-center justify-content-center align-items-center d-flex mb-0">
                                                        <p class="two-row mb-0 "><?php echo e($producto['nombre_producto']); ?>

                                                        </p>



                                                    </li>
                                                </a>

                                                <?php echo $__env->make('partials.products_reference', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                                <li class="pmd-card-subtitle-text blue body-text">
                                                    <a href="<?php echo e(route('store.search', ['search' =>
                                                     $producto->getMarcaProduct($producto->id) != null
                                                      && isset($producto->getMarcaProduct($producto->id)->nombre )
                                                      ? $producto->getMarcaProduct($producto->id)->nombre : ''
                                                    ])); ?>"
                                                        class="no-decoration bold">
                                                      <?php echo e($producto->getMarcaProduct($producto->id) != null
                                                        && isset($producto->getMarcaProduct($producto->id)->nombre )
                                                        ? $producto->getMarcaProduct($producto->id)->nombre : ''); ?>


                                                    </a>
                                                </li>

                                                <!--
                            <?php echo $__env->make('partials.products_reference', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                          -->

                                                <div class="price-box d-flex justify-content-center">
                                                    


                                                    <?php if($producto->promocion()->exists() && ($check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end))): ?>
                                                        <li class="pmd-card-subtitle-text blue body-text bold black">
                                                            <?php echo e('$' . number_format((float) precioNew($producto->slug), 0, ',', '.')); ?>

                                                        </li>
                                                        <span
                                                            class="tachado font-weight-light ml-1"><?php echo e('$' . number_format((float) $producto->precioventa_iva, 0, ',', '.')); ?>

                                                        </span>
                                                    <?php else: ?>
                                                        <li class="pmd-card-subtitle-text blue body-text bold black">
                                                            <?php echo e('$' . number_format((float) precioNew($producto->slug), 0, ',', '.')); ?>

                                                        </li>
                                                    <?php endif; ?>


                                                </div>


                                            </ul>
                                        </div>


                                    </div>
                                    <!--
                          <div class="product_fav">
                            <i class="fas fa-heart"></i>
                          </div>
                        -->

                                    <form id="form" name="form" class="product_fav"
                                        action="<?php echo e(route('favoritos.store', ['product' => $producto->id, 'referencia' => $producto->referencia])); ?>"
                                        method="get">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="id" value="<?php echo e($producto->slug); ?>">
                                        <button type="submit" class="btn btn-transparent far fa-heart">
                                        </button>
                                    </form>


                                    <ul class="product_marks">
                                        <li class="product_mark product_discount">-25%</li>
                                        <li class="product_mark product_new">new</li>
                                    </ul>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>



                    <!-- Shop Page Navigation -->
                    <div class="container">
                        <div class="row">
                            <?php echo e($productos->appends(request()->input())->links()); ?>

                        </div>
                    </div>

                </div>

                <!--aca-->


            </div>
        </div>
    </div>
    <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</div>



<?php $__env->startSection('extra-js'); ?>
    <?php echo $__env->make('partials.js.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<script type="text/javascript">
  var usuario="<?php echo e(Auth::check() ? Auth::user()->email : 'Usuario no logueado'); ?>"
  var categoria= "<?php echo e($idd); ?>"

</script>


<!-- add or no pixel code-->
    <?php if(App\Pixel::first()->pixel_id != null): ?>
        <?php if(App\PixelEvents::where('type', 'ver_contenido_categoria')->first()->active == true): ?>
            <?php echo \App\PixelEvents::where('type', 'ver_contenido_categoria')->first()->code; ?>

        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/store-clean.blade.php ENDPATH**/ ?>