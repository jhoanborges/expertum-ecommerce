

<?php $__env->startSection('content'); ?>

<div class="container mb-3 border-bottom">
  <div class="row">
    <div class="col-lg-12">
      <div class="big-title mayus mb-4 store_title "><b>CONTACTANOS:</b> </div>
    </div>
  </div>


  <form id="form" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo Honeypot::generate('my_name', 'my_time'); ?>

    <div class="row">
      <div class="col-md-6">

        <p class="bold bl
        ack mb-2 title-text">Tu opinión cuenta</p>
        <p>Dudas, inquietudes, solicitudes y sugerencias, te invitamos a contárnoslas a través de nuestras líneas de contacto. Te brindaremos toda la información, asesoría, soporte cotizaciones y demostraciones de nuestros productos y servicios</p>

        <div class="form-group">
         <ul>
          <?php if(isset($param->direccion)): ?>
          <li class="mb-2 centered-li">
            <img src="<?php echo e(asset('img/location.png')); ?>" class="img-fluid mr-1 img-footer" width="25">
            <a href="https://www.google.com/maps/place/Cl.+79b+%237-45,+Bogot%C3%A1,+Colombia/@4.6616368,-74.0531587,17z/data=!3m1!4b1!4m5!3m4!1s0x8e3f9a60d0d14bbd:0x4dd6d9d705025b1c!8m2!3d4.6616315!4d-74.05097" class="black" target="_blank">
              <?php echo e($param->direccion); ?></a>
            </li>
            <?php endif; ?>
            <?php if(isset($param->numerocontacto)): ?>

            <li class="mb-2 centered-li">
              <i class="fab fa-whatsapp light-gray mr-1" style="font-size: 1.4em;"></i>
              <a  href="https://wa.me/57<?php echo e($param->numerocontacto); ?>?text=Hola,%20estoy%20interesad@%20en%20sus%20productos.%20Me%20gustaría%20obtener%20más%20información.%20Mensaje%20enviado%20desde%20Materile%20Ecommerce." class="black" target="_blank">
                <?php echo e($param->numerocontacto); ?></a>
              </li>
              <?php endif; ?>
              <?php if(isset($param->telefono)): ?>

              <li class="mb-2 centered-li">
                <i class="fas fa-phone light-gray mr-1" style="font-size: 1.2em;"></i>
                <a href="tel:<?php echo e($param->telefono); ?>" class="black">
                  <?php echo e($param->telefono); ?></a>
                </li>
                <?php endif; ?>
                
              <?php if(isset($param->correo)): ?>

                <li class="mb-2 centered-li">
                  <i class="far fa-envelope light-gray mr-1" style="font-size: 1.2em;"></i>                    
                  <a href="mailto:<?php echo e($param->correo); ?>" class="black">
                  <?php echo e($param->correo); ?></a>
                </li>
                <?php endif; ?>

              </ul>   
            </div>
            

          </div>


          <div class="col-md-6">


            <p class="bold black mb-0 title-text">Preguntas y sugerencias</p>


            <div class="form-group mt-2">
              <label class="required bold black title-text">Nombre(s) y Apellido(s)</label>

              <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>

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
              <label class="required bold black title-text">Correo electrónico</label>

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
              <label class="required bold black title-text">Mensaje:</label>
              <textarea rows="4" id="message" class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" required></textarea>
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
                  <div class="checkbox pmd-default-theme">
                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                      <span class="ml-1"><a href="/privacidad" target="_blank"><strong>CLIC AQUÍ</strong> para consultar nuestra política de protección de datos personales</a></span>
                    </label>
                  </div>
                </div>



            <?php if(env('GOOGLE_RECAPTCHA_KEY')): ?>
            <div class="g-recaptcha"
            data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>">
          </div>
          <?php endif; ?>



          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary"><i class="fas fa-user mr-2"></i>Aceptar Política y Enviar Mensaje</button>
          </div>


        </div>

      </div>


    </form>


  </div>

  <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php $__env->startSection('extra-js'); ?>

  <script src="<?php echo e(url('js/loadingoverlay.min.js')); ?>"></script>
  <script src="<?php echo e(url('js/toastr_options.js')); ?>"></script>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
  <script>

    $(document).ready(function() {

      function clear_messages(){
        var form =  $("#form")
        form.find('.invalid-feedback').each(function(){
          $(this).remove()
        })
      }

      $("#form").on("submit", function(e){

        var recaptcha = document.forms["form"]["g-recaptcha-response"].value;
        if (recaptcha == "") {
          toastr.clear()

          const Toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
          });

          Toast.fire({
            type: 'info',
            title: 'El captcha es requerido'
          });
          return false;
        }


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var my_name= $('#my_name').val();
        var my_time=$("input[name=my_time]").val();

        var name= $('#name').val();
        var email= $('#email').val();
        var subject= $('#subject').val();
        var message= $('#message').val();

        e.preventDefault()


        var  formData = new FormData();

        formData.append( 'recaptcha', recaptcha);

        formData.append( 'my_name', my_name);
        formData.append( 'my_time', my_time);
        formData.append( 'name', name);
        formData.append( 'email', email);
        formData.append( 'subject', subject);
        formData.append( 'message', message);


        $.ajax({
          type:'POST',
          url:'<?php echo e(route('send.index')); ?>',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend:function() {

            $('.super_container').LoadingOverlay("show", {
              image       : "",
              fontawesome : "fas fa-spinner fa-spin",
              fontawesomeColor: "#00922E"
            });

          },
          success: function(response){
            clear_messages();

            toastr.clear()


            $('.super_container').LoadingOverlay("hide")
            $("#form").trigger("reset");
            toastr["success"](response.message)
          },

          error:function (xhr, ajaxOptions, thrownError){
            clear_messages();
            $('.super_container').LoadingOverlay("hide")


            toastr.clear()

            if (xhr.responseJSON.errors) {
              $.each(xhr.responseJSON.errors, function(key, value){
                console.log(value)
                toastr["error"](value)
              });

              return false;

            }
          }

        })
      });


    });
  </script>
  <?php $__env->stopSection(); ?>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/contacto.blade.php ENDPATH**/ ?>