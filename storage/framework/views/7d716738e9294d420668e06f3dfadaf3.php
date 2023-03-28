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

                        <?php if(
                            $categorias->count() > 0 &&
                                ($param->categories_bar_position == 'left' || $param->categories_bar_position == 'both')): ?>

                            <div class="sidebar_section w-100" id="sidebar_section">
                                <div class="row  no-gutters footer_title mayus">
                                    <div class="col-sm-12 no-gutters">
                                        <span>CATEGORÍAS</span>
                                        <a class="float-right" onclick="activate(); return false;">
                                            <i class="ti-search pointer"></i>
                                        </a>
                                    </div>
                                </div>
                                <input id="myInput" placeholder="Buscar"
                                    class="mt-2 search form-control fuzzy-search no-show" />

                                <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">
                                    <?php if(count($categorias) > 0): ?>
                                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a class="category-name"
                                                    href="<?php echo e(route('categoria.get', ['cat' => $cat2 ?? 'null', 'categoria' => $category->slug ?? 'null'])); ?> "><?php echo e($category->nombrecategoria); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

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




    <script>
        $(function() {
            $(".filters").change(function(e) {
                document.getElementsByClassName("filters").disabled = true;
                var valor = [];
                $('input.filters[type=checkbox]').each(function() {
                    if (this.checked)
                        valor.push($(this).val());
                });


            });


        });
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