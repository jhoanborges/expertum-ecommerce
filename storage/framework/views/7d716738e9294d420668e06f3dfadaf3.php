
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('extra-css'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            <?php if($show_pane == true): ?>
            <div class="col-lg-2">
                <!-- Shop Sidebar -->
                <div class="shop_sidebar d-none d-sm-block d-md-none d-lg-none d-xl-block">

                   <?php if( $categorias->count() > 0
                      &&
                      ($param->categories_bar_position == 'left' ||  $param->categories_bar_position == 'both' )
                      ): ?>

                      <div class="sidebar_section w-100" id="sidebar_section">
                        <div class="row  no-gutters footer_title mayus">
                            <div class="col-sm-12 no-gutters">
                                <span>CATEGORÍAS</span>
                                <a class="float-right" onclick="activate(); return false;">
                                    <i class="ti-search pointer"></i>
                                </a>
                            </div>
                        </div>
                        <input id="myInput" placeholder="Buscar" class="mt-2 search form-control fuzzy-search no-show" />

                        <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a class="category-name" href="<?php echo e(route('categoria.get', ['cat' => $cat2   , 'id' => $category->slug])); ?> "><?php echo e($category->nombrecategoria); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>




<div class="sidebar_section mt-5">
    <?php if(count($filters) > 0): ?>
    <?php echo $__env->make('partials.featured_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endif; ?>
</div>

<?php if($param->show_featued_on_side == true): ?>

<div class="sidebar_section mt-5">
    <?php echo $__env->make('partials.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?>

                    
                </div>

            </div>
<?php endif; ?>


            <div class="col-lg-<?php echo e($show_pane == true ? 10 : 12); ?> ">
                <!-- Shop Content -->
                <div class="shop_content ">
                    <div class="product_grid">
                        <div class="product_grid_border"></div>

                        <!-- Product Item -->
                        <?php $__currentLoopData = $categorias2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="product_item">
                            <a href="<?php echo e(route('categoria.get', ['cat' => $cat2=1   , 'id' => $producto->slug   ])); ?> ">
                                <img class="img-fluid" src="<?php echo e(image($producto->url_imagen)); ?>" alt="">
                            </a>
                            <ul class="list-inline w-100">
                                <a  href="<?php echo e(route('categoria.get', ['cat' => $cat2=1   , 'id' => $producto->slug   ])); ?> ">
                                    <li class="pmd-card-subtitle-text blue body-text title-height list-inline  text-center justify-content-center align-items-center d-flex mb-0">
                                      <p class="two-row mb-0 "><?php echo e($producto->nombrecategoria); ?></p>

                                  </li>
                              </a>
                          </ul>
                          <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>


            <!--pagination-->
            <div class="container">
                <div class="row">
                    <?php echo e($categorias2->appends(request()->input() )->links()); ?>

                </div>
            </div>

        </div>




    </div>
</div>

<?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php $__env->startSection('extra-js'); ?>

<script src="<?php echo e(asset('js/list.min.js')); ?>"></script>

<?php echo $__env->make('partials.js.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function() {
        $(".pmd-card").hover(
            function() {
                $(this).addClass('shadow').css('cursor', 'pointer');
            },
            function() {
                $(this).removeClass('shadow');
            }
            );
        // document ready
    });
</script>

<script>
    function activate() {
        $("#myInput").fadeToggle("fast", function() {});
        $('#myInput').focus();
    }

    var options = {
        valueNames: ['category-name']
    };

    var userList = new List('sidebar_section', options);
</script>





<!-- add or no pixel code VER CONTENIDO PRINCIPAL-->
<?php if(App\Pixel::first()->pixel_id != null): ?>
        <?php if(App\PixelEvents::where('type', 'ver_contenido_principal')->first()->active == true): ?>
            <?php echo \App\PixelEvents::where('type', 'ver_contenido_principal')->first()->code; ?>

        <?php endif; ?>
    <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/home.blade.php ENDPATH**/ ?>