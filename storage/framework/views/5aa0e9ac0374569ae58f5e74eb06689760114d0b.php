<?php if($paginator->hasPages()): ?>
<div class="shop_page_nav d-flex text-center justify-content-center">
 <ul class="page_nav d-flex flex-row" class="pagination" role="navigation">
    
    <?php if($paginator->onFirstPage()): ?>

    <div class="page_prev d-flex flex-column align-items-center justify-content-center"
   rel="prev" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">
        <i class="fas fa-chevron-left"></i>
    </div>

            <?php else: ?>
            
            <a class="page_prev d-flex flex-column align-items-center justify-content-center"
             href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">
                <i class="fas fa-chevron-left"></i></a>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
            <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($page == $paginator->currentPage()): ?>

            <li class="active"><span><?php echo e($page); ?></span></li>

            
            <?php else: ?>
            <li class=""><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>

            
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
            
            <a class="page_next d-flex flex-column align-items-center justify-content-center" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">
                <i class="fas fa-chevron-right"></i>
            </a>
            <?php else: ?>
            <div class="page_next d-flex flex-column align-items-center justify-content-center"
           rel="next" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">
                <i class="fas fa-chevron-right"></i>
            </div>
            
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>



<?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/vendor/pagination/bootstrap-4.blade.php ENDPATH**/ ?>