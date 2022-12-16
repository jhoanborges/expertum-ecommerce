<?php $__env->startSection('content'); ?>

<div class="container mb-3">

     <?php if($producto->count()>0): ?>

  <div class="row">
    <div class="col-lg-12">
      <div class="big-title mayus mb-4 store_title "><b>Favoritos</b> </div>
    </div>
  </div>

<?php endif; ?>
  <?php $__empty_1 = true; $__currentLoopData = $producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

  <div class="row">

    <div class="container h-100  mb-3 borders">
      <div class="row align-items-center h-100 p-2">
        <div class="col-sm-2 mx-auto text-center">
         <a href="<?php echo e(route('product.show' , ['product'=>$product->slug] )); ?>" title="<?php echo e($product->nombre_producto); ?>">
          <img src="<?php echo e($product->hasManyImagenes->first()->urlimagen); ?>" class="img-fluid">
        </a>
      </div>
      <div class="col-sm-5 p-4">
        <h5 class="text-justify"><?php echo e($product->nombre_producto); ?></h5>
        <h3 class="bold m-0">$ <?php echo e(formatPrice( intval( precioNew($product->slug) ) )); ?></h3>
      </div>

      <div class="col-sm-5 p-3 text-center">
        <div class="d-inline-flex">

          <form action="<?php echo e(route('favoritos.swicht', $product->slug)); ?>" method="POST" class="form-prevent">
            <?php echo e(csrf_field()); ?>

            <button type="submit"  class="btn favorite-button mr-3 bg-white black pr-2 pl-2">
              Agregar al carrito
            </button>
          </form>
          <button type="button" onclick="window.location='<?php echo e(route('product.show' , ['product'=>$product->slug] )); ?>'" title="<?php echo e($product->nombre_producto); ?>'" class="btn btn-primary pr-2 pl-2 mr-3">
            Ver artículo
          </button>
          <form action="<?php echo e(route('favoritos.destroy', ['id' => $product->slug])); ?>" method="POST" class="form-prevent">
            <?php echo e(csrf_field()); ?>

            <button type="submit" class="btn-transparent" title="Eliminar">
              <img src="<?php echo e(asset('img/trash.png')); ?>" class="img-fluid " width="35">

            </button>
          </form>
        </div>
      </div>

    </div>

  </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<section class="p-5">
  <div class="container p-5">
    <div class="row text-center">
      <div class="col-lg-12">
        <div class="big-title mayus mb-3 ">No tienes<b> favoritos</b> </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
</div>


<?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('extra-js'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/layouts/favoritos.blade.php ENDPATH**/ ?>