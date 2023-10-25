
<?php $__env->startSection('extra-css'); ?>
    <style>
        .card {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="container mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-title mayus mb-4 store_title"><b>FACTURACIÓN Y ENVÍO</b></div>
            </div>
        </div>


        <form class="mb-5" method="POST" action="<?php echo e(route('checkout.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="bold black title-text">DATOS DE FACTURACIÓN</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Nombre(s) y Apellido(s) / Razón Social</label>
                            <input id="razon" type="text" class="form-control <?php $__errorArgs = ['razon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="razon"
                                value="<?php echo e(old('razon', Auth::user()->name . ' ' . Auth::user()->apellidos)); ?>" required
                                autocomplete="razon" readonly="">
                            <?php $__errorArgs = ['razon'];
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
                            <label class="required bold black title-text">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="<?php echo e(old('email', Auth::user()->email)); ?>" required="required"
                                placeholder="Indica el nombre del destinarario" readonly="">

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
                            <label class="required bold black title-text">Tipo de identificación</label>
                            <select class="form-control" id="tipo_identificacion" name="tipo_identificacion"
                                required="required" readonly="">
                                <option disabled selected value="">Seleccionar tipo de identificación</option>
                                <?php $__currentLoopData = $identificacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($idf->id); ?>"
                                        <?php echo e(Auth::user()->tipo_identificacion == $idf->id ? ' selected' : ''); ?>>
                                        <?php echo e($idf->nombre); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Número de identificación</label>
                            <input id="numero" type="text" class="form-control <?php $__errorArgs = ['numero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="numero" value="<?php echo e(old('numero', Auth::user()->numeroidentificacion)); ?>" required
                                autocomplete="numero" readonly="" onkeypress="return isNumberKey(event)">
                            <?php $__errorArgs = ['numero'];
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
                            <label class="required bold black title-text">Departamento facturación</label>
                            <input id="state-1" type="text" class="form-control <?php $__errorArgs = ['state-1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="state-1" value="<?php echo e($depfacturacion); ?>" required readonly="">
                            <!--
            <select   required="required"  class="form-control state" name="state-1" id="state-1" >
                        <option disabled selected value="">Seleccionar un departamento</option>
                        <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->region); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                    -->
                            <?php $__errorArgs = ['state-1'];
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
                            <label class="required bold black title-text">Ciudad facturación</label>
                            <input id="state-2" type="text" class="form-control <?php $__errorArgs = ['state-2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="state-2" value="<?php echo e($ciufacturacion); ?>" required readonly="">
                            <!--
                        <select class="select2city2-1 form-control city" name="city-1" id="city-1" style="width: 100%" required="required">
                    </select>
                    -->
                            <?php $__errorArgs = ['stte-2'];
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
                            <label class="required bold black title-text">Dirección de facturación</label>
                            <input id="dirfacturacion" type="text"
                                class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="dirfacturacion"
                                value="<?php echo e($dirfacturacion); ?>" required readonly="">

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
                            <label class="required bold black title-text">Teléfono de faturación</label>
                            <input id="telfacturacion" type="text"
                                class="form-control <?php $__errorArgs = ['telfacturacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="telfacturacion"
                                value="<?php echo e($telfacturacion); ?>" required readonly=""
                                onkeypress="return isNumberKey(event)">

                            <?php $__errorArgs = ['telfacturacion'];
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
                        <div class="col-sm-12 form-group">
                            <label class="bold black title-text" style="color:#0076bd">DATOS PARA ENVÍO Y ENTREGA DE LA
                                MERCANCÍA:</label>
                        </div>
                    </div>








                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Entregar a: Nombre(s) y Apellido(s) </label>
                            <input type="text" class="form-control" name="entregar" id="entregar"
                                value="<?php echo e(old('entregar', Auth::user()->name . ' ' . Auth::user()->apellidos)); ?>"
                                required="required" placeholder="Indica el nombre del destinarario">
                            <?php $__errorArgs = ['entregar'];
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
                            <label class="required bold black title-text">Teléfono para entrega</label>
                            <input id="telefono" type="text"
                                class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="telefono"
                                value="<?php echo e($telfacturacion); ?>" required autofocus onkeypress="return isNumberKey(event)">

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
                            <label class="required bold black title-text">Departamento entrega</label>
                            <select required="required" class="form-control state" name="state" id="state">
                                <option disabled selected value="">Selecciona un departamento</option>
                                <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->region); ?></option>
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
                            <label class="required bold black title-text">Ciudad entrega</label>
                            <select class="select2city2 form-control city" name="city" id="city"
                                style="width: 100%" required="required" onchange="handleChangeCity(this);">
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

                        <div class="col-sm-6 form-group">
                            <label class="required bold black title-text">Dirección de entrega</label>
                            <input id="direccion" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="direccion" value="<?php echo e($dirfacturacion); ?>" required autofocus>

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

                    </div>





                    <div class="row">





                        <?php if(\App\Parametromodelo::first()->show_envio_a_cargo_de_tienda == true || \App\Parametromodelo::first()->show_envio_cargo_de_cliente == true || \App\Parametromodelo::first()->show_recoger_en_tienda == true): ?>
                            <!--show_envio_a_cargo_de_tienda-->
                            <div class="col-sm-6 form-group">
                                <label class="bold black title-text required">Selecciona la opción de envío</label>


                                <?php if($parametros->show_envio_a_cargo_de_tienda == true): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="cargo_tienda" value="cargo_tienda">
                                        <label class="form-check-label" for="cargo_tienda">
                                            Liquidar el flete y pagar en línea
                                        </label>
                                    </div>
                                <?php endif; ?>

                                <?php if($parametros->show_envio_cargo_de_cliente == true): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="cargo_cliente" value="cargo_cliente">

                                        <label class="form-check-label" for="exampleRadios2">
                                            Pago el flete contra entrega del pedido
                                        </label>


                                        <div class="form-group mt-3 mb-3" id="transportista" style="display: none">
                                            <label class="bold black title-text">Nombre de la transportadora</label>
                                            <input type="text" id="typeahead" name="transportista" autocomplete="off"
                                                placeholder="Escriba la transportadora de su preferencia"
                                                class="form-control" />
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($parametros->show_recoger_en_tienda == true): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cargos"
                                            onchange="handleChange(this);" id="recoger_tienda" value="recoger_tienda">
                                        <label class="form-check-label" for="show_recoger_en_tienda">
                                            Prefiero recoger en la tienda
                                        </label>
                                    </div>
                                <?php endif; ?>

                                <?php $__errorArgs = ['cargo'];
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
                        <?php endif; ?>

                        <div class="col-sm-12 form-group">
                            <label class="bold black title-text">Observaciones de la entrega:</label>
                            <textarea rows="2" input id="observaciones" type="text"
                                class="form-control <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="observaciones"
                                value="<?php echo e(old('observaciones')); ?>" autofocus maxlength="300">
                </textarea>
                            <?php $__errorArgs = ['observaciones'];
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
                </div>


                <div class="col-sm-12">

                    <div class="card p-2 mt-4">
                        <div class="card-content">
                            <div class="form-group text-center borders mb-0">
                                <img src="<?php echo e(asset('img/cart.png')); ?>" class="img-fluid" width="50">
                            </div>
                        </div>
                        <label class="black mr-2 ml-2 pt-2 text-right">Sub Total
                            <span type="text" name="">$<?php echo e(formatPrice(intval($total))); ?></span>
                        </label>
                        <label class="black mr-2 ml-2 text-right">Flete $<span type="text" name="flete"
                                id="flete">0</span>
                        </label>
                        <label class="bold mr-2 ml-2 black text-right pb-0 ">Total
                            <span type="text" name="total_summary"
                                id="total_summary">$<?php echo e(formatPrice(intval($total))); ?></span>
                        </label>
                    </div>
                </div>


                



                <div class="col-sm-12 form-group mt-4 mb-4 d-flex justify-content-end">
                    <button id="AddPaymentInfo" type="submit" class="btn btn-danger checkout-button">
                        Ir a Pagar $ </button>
                </div>

            </div>


        </form>


    </div>

    <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('extra-js'); ?>
    <script src="<?php echo e(url('js/loadingoverlay.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/typeahead/bootstrap3-typeahead.min.js')); ?>"></script>



    <script>
        var route = "<?php echo e(url('autocomplete-search')); ?>";

        $('#typeahead').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>


    <script>
        $(window).on("load", function() {
            console.log("window loaded");
            setTimeout(function() {
                getCheckoutSettingsForStore()

            }, 1500);

        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "<?php echo e(route('sql_session')); ?>",
                dataType: 'json',
                success: function(res) {
                    if (res) {

                        $('.state').val(res.departamento.id).trigger('change')
                        setTimeout(function() {
                            $('.city').val(res.ciudad.id).trigger('change')
                        }, 500);
                    }
                },
                error: function() {

                }
            })
        })
    </script>


    <script>
        var precio = 0;

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }



        const getCheckoutSettingsForStore = async (id) => {
            $("#loading-checkout").LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });


            await axios
                .get('<?php echo e(route('getCheckoutSettingsForStore')); ?>' )
                .then(res => {
                    let result = res.data;
                    console.log(result)

                    if (
                        result.show_envio_a_cargo_de_tienda === 1 &&
                        result.show_envio_cargo_de_cliente === 1 &&
                        result.show_recoger_en_tienda === 1
                    ) {
                        $("#cargo_tienda").prop("checked", true);

                    } else if (result.show_envio_a_cargo_de_tienda === 1) {
                        $("#cargo_tienda").prop("checked", true);
                        calcularFlete()
                    } else if (result.show_envio_cargo_de_cliente === 1) {
                        $("#cargo_cliente").prop("checked", true);
                        //set input shot
                        $('#transportista').show()
                        //$("[name='transportista']").prop("required", true)

                    } else if (result.show_recoger_en_tienda === 1) {
                        $("#recoger_tienda").prop("checked", true);
                    } else {
                        console.log('nothing]?')
                    }


                })
                .catch(error => {
                    /*
                                    

                          
                    show_envio_cargo_de_cliente: 1
                    show_recoger_en_tienda: 1
                    */
                    //console.log("error");
                    //console.log(error.response);
                    //toastr.error(error.response.data.message);
                })
                .finally(() => {
                    $("#loading-checkout").LoadingOverlay("hide", true);
                });
        };


        function handleChangeCity(city) {

            let value = city.value
            let cargo_tienda = $('#cargo_tienda').val()

            if (cargo_tienda === 'cargo_tienda') {
                calcularFlete()
            }
            //
        }

        function calcularFlete() {
            console.log('calcular flete')
            $("#flete").val(0);

            var departamento = $('.state').val();
            var ciudad = $('.city').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            if (ciudad) {
                $.ajax({
                    type: "POST",
                    data: {
                        state: departamento,
                        city: ciudad,
                    },
                    url: "<?php echo e(route('flete_value')); ?>",

                    beforeSend: function() {
                        $.LoadingOverlay("show", {
                            background: "rgba(165, 190, 100, 0.5)",
                            text: 'Calculando el valor del envío. Por favor espere...',
                            textAutoResize: true,
                            textResizeFactor: 0.2
                        });
                    },
                    success: function(res) {
                        $("#flete").html(parseInt(res).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        }))
                        var sum = parseInt('<?php echo e($total); ?>') + parseInt(res)
                        $("#total_summary").html(parseInt(sum).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        }))

                        precio = parseInt(sum).toLocaleString('de-DE', {
                            minimumFractionDigits: 0
                        })
                    },
                    complete: function() {
                        $.LoadingOverlay("hide", true);
                    }
                });
            } else {
                alert('Selecciona una ciudad')
            }
        }


        function handleChange(src) {

            console.log('metodo de envio seleccionado')

            var cargo = src.value
            console.log(cargo)

            if (cargo === 'cargo_cliente') {


                $("#flete").html(0)
                $("#total_summary").html('<?php echo e(formatPrice(intval($total))); ?>')

                //mostrar transportistas  

                $('#transportista').show()
                $("[name='transportista']").prop("required", true)

            } else if (cargo === 'recoger_tienda') {
                $("#flete").html(0)
                $("#total_summary").html('<?php echo e(formatPrice(intval($total))); ?>')
                $('#transportista').hide()
                $("[name='transportista']").prop("required", false)

            } else if (cargo === 'cargo_tienda') {

                calcularFlete()
                $('#transportista').hide()
                $("[name='transportista']").prop("required", false)

            } else {
                alert('Selecciona un método d envío.')
            }



        }
    </script>



<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
















<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\expertum-ecommerce\resources\views/layouts/checkout.blade.php ENDPATH**/ ?>