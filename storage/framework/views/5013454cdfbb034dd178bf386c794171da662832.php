<?php $__env->startSection('content'); ?>

<div id="my-stores-component"
data-whatsapp="<?php echo e(env('WHATSAPP_CONTACT_LINK')); ?>"
></div>


  <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->startSection('extra-js'); ?>
  <?php $__env->stopSection(); ?>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/layouts/tiendas.blade.php ENDPATH**/ ?>