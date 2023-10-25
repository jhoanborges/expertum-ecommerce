
<?php $__env->startSection('content'); ?>

<section class="tables mb-5">
    <div class="container mb-3 border-bottom">    
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-3 border-bottom-custom"><b>Iniciar Sesión</b>
                </div>   

                <form method="POST" action="<?php echo e(route('login')); ?>" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">

                        <p class="bold black mb-0 title-text">Inicia Sesión</p>
                        <p>Ingresa con tus datos de registro</p>

                        <div class="form-group">
                            <label class="bold black mb-0 title-text">Dirección de Correo (Usuario):</label>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label class="bold black mb-0 title-text">Contraseña:</label>
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <?php if(Route::has('password.request')): ?>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('Olvidé mi contraseña. CLIC AQUÍ para reestablecerla')); ?>

                            </a>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                            <i class="fas fa-unlock-alt mr-2"></i>Ingresar</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="bold black mb-0 title-text">Soy nuevo en este sitio</p>
                        <p>Registro necesario para tramitar el pedido y emitir la factura</p>

                        <div class="form-group">
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">
                            <i class="fas fa-user mr-2"></i>Registrarme</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
</section>


<?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/auth/login.blade.php ENDPATH**/ ?>