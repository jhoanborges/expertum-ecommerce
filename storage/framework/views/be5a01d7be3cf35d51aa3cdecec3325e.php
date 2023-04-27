<?php if( $top->count() > 0 ): ?>

<div class="sidebar_section d-none d-sm-none d-md-block">
    <div class="footer_title mayus ">Destacados</div>
    <ul class="brands_list">
        <li class="row no-gutters h-100">
<?php $__currentLoopData = $top->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-lg-12">

                <a href="<?php echo e(route('product.show' , ['slug'=>
                isset($to['slug']) ? $to['slug'] : 'null'
                 ])); ?>" class="d-flex pt-2 pb-2 border-bottom-custom">
                    <img src="<?php echo e(url(  $to->hasManyImagenes->first()->urlimagen )); ?>" class="top-image">

                    <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                        <ul>
                            <li class="top-sub pmd-card-subtitle-text blue top-text two-row"><?php echo e($to->nombre_producto); ?></li>
                            
                            <li class="top-sub pmd-card-subtitle-text blue top-text bold black"><?php echo e('$ '.number_format((float) precioNew($to->slug), 0, ',', '.'  )); ?></li>
                        </ul>
                    </div>

                </a>
            </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </li>

    </ul>
</div>

<?php endif; ?>


<?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/partials/top.blade.php ENDPATH**/ ?>