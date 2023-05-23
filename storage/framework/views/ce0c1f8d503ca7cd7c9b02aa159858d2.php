<div class="sidebar_section w-100" id="sidebar_section">
  <div class="row no-gutters">
    <div class="col-sm-12 no-gutters">
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($project->show_on_sidebar == true): ?>

        <div id="accordion<?php echo e($key); ?>" class="accordion">
            <div class="card  no-borders">
                <div class="card-header pointer collapsed" data-toggle="collapse" href="#collapseFilters<?php echo e($key); ?>">
                    <a class="card-title mayus">
                        <?php echo e(removeCaps($project['nombrecategoria'])); ?>

                    </a>
                </div>

                <div id="collapseFilters<?php echo e($key); ?>" class="card-body collapse pl-0 pr-0 <?php echo e(!empty($ids2)  ? 'show':null); ?> scrollable mCustomScrollbar" data-parent="#accordion<?php echo e($key); ?>" >
                   <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">

                    <?php $__currentLoopData = $project->categories($ids2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a  href="<?php echo e(route('store.search', ['search' =>$category->nombrecategoria , 'strict' => true ])); ?>" class="no-decoration text-capitalize"><?php echo e($category->nombrecategoria); ?></a>
                  </li>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      </div>
  </div>
<?php endif; ?>
  
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
</div>

<?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/partials/featured_filters.blade.php ENDPATH**/ ?>