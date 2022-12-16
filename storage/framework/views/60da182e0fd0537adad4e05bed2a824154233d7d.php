<?php if( ! $sliders->isEmpty() ): ?>

     <div class="rev_slider_wrapper">
 
            <!-- the ID here will be used in the JavaScript below to initialize the slider -->
            <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.5">
                <!-- BEGIN SLIDES LIST -->
        <ul id="slider-content">
                    <!-- MINIMUM SLIDE STRUCTURE -->
                              <!-- SLIDE 1 -->

   <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
                  <li data-transition="boxfade" data-link="<?php echo e($slide->link); ?>" data-target="" data-slideindex="back">
 
                        <img src="<?php echo e($slide->url); ?>" alt="<?php echo e($slide->url); ?>" class="rev-slidebg">

         <div class="tp-caption fadeout"
         data-frames='[{"delay":0,"speed":1500,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="10"
                          data-y="10"
                          data-speed="500"
                          data-start="1200"
                          data-easing="Circ.easeInOut"
                          style=" font-size:70px; font-weight:800; color:#ffffff;"><?php echo e($slide->name); ?><span style=" color:#000;"></span> 

          </div>


                      <!-- LAYER NR. 2 -->
            <div class="tp-caption black_thin_blackbg_30 customin ltl tp-resizeme"

              data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"x:right;skX:-85px;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="100"
                          data-y="100" 
                          data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                          data-speed="1500"
                          data-start="1000"
                          data-easing="Power4.easeInOut"
                          data-splitin="none"
                          data-splitout="none"
                          data-elementdelay="0.01"
                          data-endelementdelay="0.1"
                          data-endspeed="1000"
                          data-endeasing="Power4.easeIn"
                          style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap; color:#ffffff; font-size:18px; font-weight:500;"><?php echo e($slide->descripcion); ?> </div>
            
            <!-- LAYER NR. 4 -->
             <?php if(!empty($slide->button)): ?>
            <div class="tp-caption lfb ltb start tp-resizeme"

            data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="200"
                          data-y="200"
                          data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                          data-speed="1500"
                          data-start="1600"
                          data-easing="Power3.easeInOut"
                          data-splitin="none"
                          data-splitout="none"
                          data-elementdelay="0.01"
                          data-endelementdelay="0.1"
                          data-linktoslide="next"
                          style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;"><a href='<?php echo e($slide->link); ?>' class='largebtn solid'><?php echo e($slide->button); ?></a> </div>
<?php endif; ?>

                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                 
 
                </ul><!-- END SLIDES LIST -->
 
            </div><!-- END SLIDER CONTAINER -->
 
        </div><!-- END SLIDER CONTAINER WRAPPER-->

           <?php endif; ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/partials/slider.blade.php ENDPATH**/ ?>