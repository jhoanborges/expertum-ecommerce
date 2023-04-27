<?php $__env->startSection('extra-css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="pedidos-component"
data-heart="<?php echo e(asset('img/heart.png')); ?>"
data-trash="<?php echo e(asset('img/trash.png')); ?>"
data-cart="<?php echo e(asset('img/cart-white.png')); ?>"
></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/pedido.blade.php ENDPATH**/ ?>