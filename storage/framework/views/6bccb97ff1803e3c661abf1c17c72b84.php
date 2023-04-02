
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo SEOMeta::generate(); ?>

    <?php echo OpenGraph::generate(); ?>

    <?php echo Twitter::generate(); ?>

    <?php if(\Request::route()->getName() != 'product.show'): ?>
    <?php echo JsonLd::generate(); ?>

    <?php endif; ?>


  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="description" content="Ecommerce">-->
  <link rel='canonical' href='<?php echo e(url()->current()); ?>' />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo $__env->yieldContent('extra-meta'); ?>

  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <link rel="shortcut icon" href="//<?php echo e($param->logo); ?>" />
  

  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
/>

<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/icon?family=Material+Icons"
/>
       <?php if(config('app.env') == 'local'): ?>

        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/all.css')); ?>">
        <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset(mix('css/all.css'), true)); ?>">
        <?php endif; ?>


  <?php echo $__env->yieldContent('extra-css'); ?>

  
</head>

<body>


  <div class="super_container">
    <div id="cart-component"
    data-total="<?php echo e($total); ?>"
    data-productimage="<?php echo e(asset('img/product.png')); ?>"
    ></div>

    <div id="loading">
      <div class="load-circle">
        <span class="one"></span>
      </div>
    </div>

    
    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.modalCiudadesSelector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>

<?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>


<?php if(config('app.env') == 'local'): ?>
<script src="<?php echo e(asset(mix('js/all.js'))); ?>"></script>
<?php else: ?>
<script src="<?php echo e(asset(mix('js/all.js'), true)); ?>"></script>
<?php endif; ?>



  <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>

  <script src="<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/easing/easing.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/parallax-js-master/parallax.min.js')); ?>"></script>

  <script src="<?php echo e(asset('plugins/greensock/TweenMax.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/greensock/TimelineMax.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/scrollmagic/ScrollMagic.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/greensock/animation.gsap.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/greensock/ScrollToPlugin.min.js')); ?>"></script>

  <script src="<?php echo e(asset('plugins/Isotope/isotope.pkgd.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery.themepunch.revolution.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery.themepunch.tools.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/jquery.themepunch.plugins.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/floating-wpp.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/theme.js')); ?>"></script>
  <script src="<?php echo e(asset('js/global.js')); ?>"></script>
  <script src="<?php echo e(asset('js/checkbox.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery-migrate-1.4.1.min.js')); ?>"></script>

  <script src="<?php echo e(asset('js/shop_custom.js')); ?>"></script>
  <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- add or no pixel MAIN code-->
<?php if(App\Pixel::first()->pixel_id !=null): ?>
<?php echo \App\Pixel::first()->code; ?>

<?php endif; ?>


<!-- add custom main js-->
<?php $__currentLoopData = App\CustomJs::where('type', 'custom_js_main')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $data->code; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php echo $__env->yieldContent('extra-js'); ?>
  <script>
    (function(){

      $("#cart").on("click", function() {
        $(".shopping-cart").fadeToggle( "fast");
      });

    })();


    $(document).ready(function() {
     $('[data-toggle=dropdown]').dropdown()
      $('[data-toggle=popover]').popover();
    });
    $(window).on("load", function(){
     document.getElementById("loading").style.display = "none";
   });
 </script>


  <?php echo $__env->make('partials.js.city_selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
@toastr_render
<div id="myDiv"></div>

<a href="<?php echo e(route('about_us')); ?>" class="float d-flex justify-content-center btn-top-home">
  
<div class="chat-box">
  <img width="35" src="<?php echo e(asset('img/chatwhite.png')); ?>" class="chat-img"/>

</div>

  </a>


<script>
  $('#myDiv').floatingWhatsApp({
    phone: '57<?php echo e($param->numerocontacto); ?>',
    position:'right',
    popupMessage: 'Hola, ¿Necesitas ayuda? ',
    message: "<?php echo e(env('WHATSAPP_CONTACT_TEXT')); ?>",
    showPopup: true,
    showOnIE: true,
    headerTitle: 'Estamos online;',
  /*headerColor: 'var(--blue)',
  backgroundColor: 'var(--blue)',*/
  buttonImage: '<img src="<?php echo e(asset('img/whatsapp2.svg')); ?>" />',
  //autoOpenTimeout:'60000',
  size:'50px',
  showPopup: false
});

</script>





</body>

</html>
<?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/welcome.blade.php ENDPATH**/ ?>