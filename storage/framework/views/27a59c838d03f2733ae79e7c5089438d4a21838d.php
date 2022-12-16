<?php $__env->startSection('content'); ?>

<section class="tables mb-5">
    <div class="container mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-3 border-bottom-custom">REESTABLECER <b>Contraseña</b> </div>

                    <div class="card-body m-5 text-center">
                        <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('password.email')); ?>" id="form">
                            <?php echo csrf_field(); ?>
                            <div class="container">
                                <div class="row d-inline-flex ">
                                    <div class="col-sm-12 " >
                                        <div class="form-group">
                                            <label class="required bold black mb-2 title-text">Dirección de Correo (Usuario)</label>
                                                <p>Aplica para Cuentas Activadas</p>
                                            <input id="email" type="email" class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                            <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                            <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100">
                                            <?php echo e(__('CLIC AQUÍ para reestablecer')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>


    <?php $__env->startSection('extra-js'); ?>
        <script src="<?php echo e(url('js/loadingoverlay.min.js')); ?>"></script>
        <script>
            const form = document.getElementById('form');
            form.onsubmit = function(){
            $(".super_container").LoadingOverlay("show", {
            image       : "",
            fontawesomeColor: '#0076bd',
            fontawesome : "fas fa-spinner fa-spin",
            });
            };
        </script>
    <?php $__env->stopSection(); ?>

    <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>