<!-- Footer -->
<div class="container text-center">
    <div class="row floating-footer-button">
        <div class="col-lg-12 ">
            <a class="btn btn-secondary button-rounded" href="<?php echo e(route('about_us')); ?>"><span class="white">Suscríbete</span>
            </a>
        </div>
    </div>
</div>

<footer class="footer">
    
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column text-center centered">
                    <a class="logo_h " title="<?php echo e($param->nombre_tienda); ?>" href="<?php echo e(route('welcome')); ?>">
                        <img src="//<?php echo e($param->logo); ?>" alt="" class="img-fluid logo-bar" />
                    </a>
                </div>
            </div>
          
            <?php if(count($footer) > 0): ?>
            <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3">
                <div class="footer_column">
                    <div class="footer_title mayus"><?php echo e($project->titulo); ?></div>
                    <!--aca hay un tema, toda la lsita que viene del backend viene url e icono, pero en las nuevas plantillas de materile viene es una imagen asi que debo condicionar esto para que no aparezca el link, lo unico que se eme ocurrio es leer la url en busqueda de nombre de red social y asi redenderizar los componentes-->
                    <ul class="footer_list">
                        <?php $__currentLoopData = $project['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($project->url); ?>">
                                <i class="fas fa-chevron-right light-gray"></i>
                                <?php echo e($project->name); ?>

                            </a>
                        </li>
                        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        
                        
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        
                        
                                
                                
                            </div>
                            
                            <div class="row text-center mt-3">
                                <div class="col-lg-12">
                                    <div class="footer_column">
                                        <div class="body-text mayus light-gray">©<?php echo e(\Carbon\Carbon::now()->format('Y')); ?> - <?php echo e($param->nombre_tienda); ?>  - <?php echo e($param->razon_social); ?></div>
                                    </div>
                                </div>
                            </div>
                            </p>
                            <div class="row text-center">
                                <div class="col-lg-12">
                                    <div class="footer_column">
                                        <div class="body-text ">
                                            <a href=<?php echo e(env('WEB_DEVELOPER')); ?> target="_blank" class="light-gray">Plataforma E-Commerce desarrollada por <?php echo e(env('DEVELOPER_NAME')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/partials/footer.blade.php ENDPATH**/ ?>