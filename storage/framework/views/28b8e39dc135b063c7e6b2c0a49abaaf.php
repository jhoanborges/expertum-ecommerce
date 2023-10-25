

<?php $__env->startSection('extra-css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.dataTables.min.css')); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div id="cart-summary-component"
data-heart="<?php echo e(asset('img/heart.png')); ?>"
data-trash="<?php echo e(asset('img/trash.png')); ?>"
data-cart="<?php echo e(asset('img/cart-white.png')); ?>"
></div>


<!--aca-->
<?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('extra-js'); ?>
<script src="<?php echo e(url('js/loadingoverlay.min.js')); ?>"></script>

<script src="<?php echo e(url('js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('js/qty.js')); ?>"></script>




<script src="<?php echo e(url('js/axios.min.js')); ?>"></script>
<script>
  (function(){

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "10000",
      "hideDuration": "1000",
      "timeOut": "10000",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }


    const classname = document.querySelectorAll('.qtyplus')
    Array.from(classname).forEach(function(element) {
      element.addEventListener('click', function(){
        const id= element.getAttribute('data-id')

        $(".qty").LoadingOverlay("show", {
          image       : "",
          fontawesomeColor: '#008acd',
          fontawesome : "fas fa-spinner fa-spin",
          backgroundClass         : "transparent"
        });

        var current_value= $(".qty").val()

        axios.patch(`resumen/${id}`, {
          cantidad: parseInt(current_value)+1
        })
        .then(function (response) {
          $(".qty").LoadingOverlay("hide");
          window.location.href='<?php echo e(route('resumen')); ?>'
        })
        .catch(function (error) {
          console.log(error.response.data.error)
          $(".qty").LoadingOverlay("hide");
          toastr["info"](error.response.data.error)
          $(".qty").val(current_value)
        });
      })
    })


    const minusclassname = document.querySelectorAll('.qtyminus')
    Array.from(minusclassname).forEach(function(element) {
      element.addEventListener('click', function(){
        const id= element.getAttribute('data-id')
        var current_value= $(".qty").val()

        if(current_value <=1){
          return false
        }

        $(".qty").LoadingOverlay("show", {
          image       : "",
          fontawesomeColor: '#008acd',
          fontawesome : "fas fa-spinner fa-spin",
          backgroundClass         : "transparent"
        });


        axios.patch(`resumen/${id}`, {
          cantidad: parseInt(current_value)-1
        })
        .then(function (response) {
          $(".qty").LoadingOverlay("hide");
          window.location.href='<?php echo e(route('resumen')); ?>'
        })
        .catch(function (error) {
          console.log(error.response.data.error)
          $(".qty").LoadingOverlay("hide");
          toastr["info"](error.response.data.error)
          $(".qty").val(current_value)
        });
      })
    })

    const qtyclassname = document.querySelectorAll('.qty')
    Array.from(qtyclassname).forEach(function(element) {
      element.addEventListener('keyup', function(){
        const id= element.getAttribute('data-id')
        var current_value= $(".qty").val()


        $(".qty").LoadingOverlay("show", {
          image       : "",
          fontawesomeColor: '#008acd',
          fontawesome : "fas fa-spinner fa-spin",
          backgroundClass         : "transparent"
        });


        axios.patch(`resumen/${id}`, {
          cantidad: parseInt(current_value)
        })
        .then(function (response) {
          $(".qty").LoadingOverlay("hide");
          window.location.href='<?php echo e(route('resumen')); ?>'
        })
        .catch(function (error) {
          console.log(error.response.data.error)
          $(".qty").LoadingOverlay("hide");
          toastr["info"](error.response.data.error)
          $(".qty").val(current_value)
        });
      })
    })



  })();
</script>


<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/cart.blade.php ENDPATH**/ ?>