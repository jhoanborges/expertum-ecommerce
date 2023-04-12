
<?php $__env->startSection('content'); ?>

<div class="container mb-3 border-bottom">
    <div class="row">
        <div class="col-lg-12">
            <div class="big-title mayus mb-4 store_title"><b>FORMULARIO DE REGISTRO...</b>
            </div>
        </div>
    </div>
    
    <form class="mb-5" method="POST" action="<?php echo e(route('register')); ?>" onsubmit="return validaForm();">
    
        <?php echo csrf_field(); ?>
      <div class="row">

        <div class="col-md-9">

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <?php if(Route::has('login')): ?>
                    <a class="btn btn-link" href="<?php echo e(route('login')); ?>">
                    <?php echo e(__('Ya tengo un usuario. CLIC AQUÍ para iniciar sesión')); ?>

                    </a>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Nombre(s)</label>
                    <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required="name" autofocus>
                    <?php $__errorArgs = ['name'];
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
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Apellido(s)</label>
                    <input id="apellido" type="text" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="apellido" value="<?php echo e(old('apellido')); ?>" required="apellido" autofocus>
                    <?php $__errorArgs = ['apellido'];
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
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Tipo de identificación</label>         
                   
                    <select class="form-control" id="tipo_identificacion" name="tipo_identificacion" required="required">
                    <option disabled selected value="">Seleccione una opción</option>
                    <!--
                    <?php $__currentLoopData = $identificacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option
                    value="<?php echo e($idf->id); ?>" 
                    ><?php echo e($idf->nombre); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    -->
                    <?php $__currentLoopData = $identificacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($idf->id); ?>" <?php echo e((old("tipo_identificacion") == $idf->id ? "selected":"")); ?>><?php echo e($idf->nombre); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>      

                    <?php $__errorArgs = ['tipo_identificacion'];
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
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Número de identificación</label>
                    <input id="numeroidentificacion" type="text" class="form-control <?php $__errorArgs = ['numeroidentificacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="numeroidentificacion" value="<?php echo e(old('numeroidentificacion')); ?>" required="numeroidentificacion" onkeypress="return isNumberKey(event)">
                    <?php $__errorArgs = ['numeroidentificacion'];
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
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Departamento</label>         
                   
                    <select   required="required"  class="form-control state" name="state" id="state" >
                    <option disabled selected value="">Seleccione una opción</option>
                    <!--
                    <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->region); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    -->
                    <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dep->id); ?>" <?php echo e((old("state") == $dep->id ? "selected":"")); ?>><?php echo e($dep->region); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> 

                    <?php $__errorArgs = ['state'];
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
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Ciudad</label>         
                    <select class="select2city2 form-control city" name="city" id="city" style="width: 100%" required="required">
                    </select>             
                    <?php $__errorArgs = ['city'];
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
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Dirección</label>
                    <input id="direccion" type="text" class="form-control <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="direccion" value="<?php echo e(old('direccion')); ?>" required="direccion" autofocus>
                    <?php $__errorArgs = ['direccion'];
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
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Teléfono</label>
                    <input id="telefono" type="text" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="telefono" value="<?php echo e(old('telefono')); ?>" required="telefono" onkeypress="return isNumberKey(event)">
                    <?php $__errorArgs = ['telefono'];
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
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Dirección de correo (Usuario)</label>
                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required="email">
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
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Contraseña</label>
                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required="new-password">
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
                  <div class="col-sm-6 form-group">
                    <label class="required bold black mb-2 title-text">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="new-password">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <label class="pmd-checkbox pmd-checkbox-ripple-effect">
                      <span class="ml-1"><a href="/privacidad" target="_blank"><strong>CLIC AQUÍ</strong> para consultar nuestra política de protección de datos personales</a></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <?php if(env('GOOGLE_RECAPTCHA_KEY')): ?>
                    <div class="g-recaptcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>" data-callback="enabledSubmit">></div>
                    <!--<div class="g-recaptcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>">></div>-->
                    <?php endif; ?>
                  </div>                  
                </div>

                <div class="row">
                  <div class="col-sm-6 form-group">
                    <!--<button type="submit" name="enviar" class="btn btn-primary" id="btnSubmit" disabled=""><i class="fas fa-user mr-2"></i>Aceptar Política y Registrarme</button>-->
                    <button type="submit" name="enviar" class="btn btn-primary" id="btnSubmit"><i class="fas fa-user mr-2"></i>Aceptar Política y Registrarme</button>
                  </div>
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

  function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }


    $(document).ready(function() {
      function clear_messages(){
        var form =  $("#form")
        form.find('.invalid-feedback').each(function(){
          $(this).remove()
        })
      }


      /*
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

        //var my_name= $('#my_name').val();
        //var my_time=$("input[name=my_time]").val();

        var name= $('#name').val();
        var apellido= $('#apellido').val();
        var tipo_identificacion= $('#tipo_identificacion').val();
        var numeroidentificacion= $('#numeroidentificacion').val();

        var state = $('#state').val();
        var city = $('#city').val();
        var direccion = $('#direccion').val();

        var telefono= $('#telefono').val();
        var email= $('#email').val();
        var password= $('#password').val();
        var passwordconfirm= $('#password-confirm').val();
        //var message= $('#password-confirm').val();

        e.preventDefault()


        var  formData = new FormData();

        formData.append( 'recaptcha', recaptcha);

        formData.append( 'name', name);
        formData.append( 'apellido', apellido);
        formData.append( 'tipo_identificacion', tipo_identificacion);
        formData.append( 'numeroidentificacion', numeroidentificacion);

        formData.append( 'state', state);
        formData.append( 'city', city);
        formData.append( 'direccion', direccion);


        formData.append( 'telefono', telefono);
        formData.append( 'email', email);
        formData.append( 'password', password);
        formData.append( 'password-confirm', passwordconfirm);


        $.ajax({
          type:'POST',
          url:'<?php echo e(route('register')); ?>',
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
            //alert(response);
            //console.log(response);
        
            //alert()->success('¡Enhorabuena!','Tu cuenta ha sido creada exitosamente. Hemos enviado un correo electrónico a ' .$request->email.'');

            if (response == 'ok'){
                var testVar = "Cuenta creada exitosamente. Para comprobar que " + email + " es tu dirección de correo, te hemos enviado un mensaje de confirmación. " +
                "Si no lo encuentras en la BANDEJA DE ENTRADA, te sugerimos revisar en la carpeta SPAM" ;
                Swal.fire(testVar).then(function() {
                  window.location = "<?php echo e(route('home')); ?>";
                    });
            }
            else{
                var testVar = "No se ha podido crear el usuario. Es posible que ya exista en la base de datos. Intenta reestablecer contraseña." ;
                Swal.fire(testVar).then(function() {
                });
            }


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
      */


    });


    function validaForm() {
      if ($('#password').val() !=  $('#password-confirm').val()){
        //alert("Confirmación de contraseña inválida");
        toastr["error"]('Confirmación de contraseña inválida');
        return false;
      }

      var response = grecaptcha.getResponse();

      if(response.length == 0){
        //alert("Captcha no verificado")
        var testVar = "reCAPTCHA no válido." ;
          Swal.fire(testVar).then(function() {
        });           
        return false;
      } else {
        //alert("Captcha verificado");

      }      
      return true;
      

      //$('#password').val();
      //$('#password-confirm').val();


       /*
       var response = grecaptcha.getResponse();

        if(response.length == 0){
          //alert("Captcha no verificado")
          var testVar = "reCAPTCHA no válido." ;
            Swal.fire(testVar).then(function() {
          });           
          return false;
        } else {
          //alert("Captcha verificado");

        }
        */
    }


    /*
    function enabledSubmit(response) {
      alert("que pasa");
      //document.getElemenstByName("enviar")[0].disabled = false;
      document.getElemenstById("btnSubmit").disabled = false;
    }
    */

      
    

  </script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/auth/register.blade.php ENDPATH**/ ?>