<div id="modalCiudadesSelector" class="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <form id="city-form" method="post" accept-charset="utf-8" class="">

        <div class="modal-body pb-0">

           <input type="hidden" id="hidden" name="hidden" value="">
           <input type="hidden" name="id" value="" id="id">
           <div class="row">
            <div class="col-sm-8">
               <div class="row mb-3">

                <div class="col-sm-12">
                    <h5 class="modal-title">Enviamos pedidos a estas ciudades</h5>

                    <label class="required body-text">Seleccionar la ciudad de destino</label>
                    <select name="state" id="state" class="input-text select2departamento" required>
                        <option value="">Seleccionar de la lista</option>
                        <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->region); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-12">
                    <select name="city" id="city" class="input-text select2ciu" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 h-100">
            <div class="row justify-content-center align-self-center">
                <img src="<?php echo e(asset('img/ciudad.png')); ?>" class="img-fluid">
            </div>
        </div>

    </div>
</div>


<div class="modal-footer justify-content-start">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plane-departure mr-2"></i>
    Guardar</button>
</div>
</form>

</div>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/partials/modalCiudadesSelector.blade.php ENDPATH**/ ?>