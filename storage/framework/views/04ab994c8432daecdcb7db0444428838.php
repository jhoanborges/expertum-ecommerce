
<div class="col-lg-12 mb-4">
    <div id="accordion<?php echo e($key); ?>" class="accordion">
        <div class="card  no-borders">
            <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseFilters<?php echo e($key); ?>">
                <a class="card-title mayus">
                    <?php echo e(removeCaps($project['nombrecategoria'])); ?>

                </a>
            </div>
            <div id="collapseFilters<?php echo e($key); ?>" class="card-body collapse pl-0 pr-0 <?php echo e(!empty($filtros)  ? 'show':null); ?> scrollable mCustomScrollbar" data-parent="#accordion<?php echo e($key); ?>" >
                <?php $__currentLoopData = $project->categories($ids2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="checkbox pmd-default-theme mt-3">
                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                        <input type="checkbox" value="<?php echo e($category->id); ?>" class="filters"
                        <?php if(!empty ( $filtros )): ?>
                        <?php $__currentLoopData = $filtros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($filter == $category->id ? 'checked':null); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        >
                        <span><?php echo e($category->nombrecategoria); ?></span>
                    </label>
                    <span class="badge badge-light"> <?php echo e($category->product_total($ids2)->count()); ?></span>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/partials/filtros.blade.php ENDPATH**/ ?>