<?php $__env->startSection('extra-meta'); ?>
    <meta property="og:description" content="<?php echo e($producto->descripcion); ?>" />
    <?php if(count($allImages) > 0): ?>
        <meta property="og:image" content="<?php echo e($allImages->first()->urlimagen); ?>" />
    <?php endif; ?>
    <meta property="og:url" content="<?php echo e(\URL::current()); ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:title" content="<?php echo e($producto->nombre_producto); ?>" />
    <meta property="og:image:alt" content="<?php echo e($producto->nombre_producto); ?>" />
    <meta property="fb:app_id" content="545837192560177" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('extra-css'); ?>
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/slick.css')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/nouislider.min.css')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/electro.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/lightgallery/lightgallery.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="brand" content="<?php echo e($producto->getMarcaProduct($producto->id)['nombre'] ?? null); ?>">
    <meta itemprop="name" content="<?php echo e($producto->nombre_producto); ?>">
    <meta itemprop="description" content="<?php echo e($producto->descripcion); ?>">
    <meta itemprop="productID" content="<?php echo e($producto->slug); ?>">
    <meta itemprop="url" content="<?php echo e(url()->current()); ?>">
    <meta itemprop="image" content="<?php echo e($allImages->first()->urlimagen); ?>">
    <div itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
      <span itemprop="propertyID" content="<?php echo e($producto->id); ?>"></span>
      <meta itemprop="value" content="<?php echo e($producto->slug); ?>"></meta>
    </div>
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <?php if($producto->cantidad > 0 && $producto->estado == true): ?>
      <link itemprop="availability" href="http://schema.org/InStock">
      <?php else: ?>
      <link itemprop="availability" href="http://schema.org/OutOfStock">
      <?php endif; ?>


      <?php if($producto->nuevo_usado == true): ?>
      <link itemprop="itemCondition" href="http://schema.org/NewCondition">

      <?php else: ?>
      <link itemprop="itemCondition" href="http://schema.org/UsedCondition">
      
      <?php endif; ?>


      <meta itemprop="price" content="<?php echo e('$' . number_format((float) precioNew($producto->slug), 0, ',', '.')); ?>">
      <meta itemprop="priceCurrency" content="<?php echo e($moneda->name); ?> ">
    </div>
  </div>
  
    <form action="<?php echo e(route('resumen.store')); ?>" method="POST" class="form-prevent">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="id" value="<?php echo e($producto->slug); ?>">
        <!-- SECTION -->
        <div class="section mt-1">
            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row border-bottom-custom">
                    <div class="col-sm-10 mb-5">

                        <!--<div class="store_title mayus mb-2">CIENCIA - <b>EXPERIMENTOS</b> </div>-->
                        <div class="row mt-4">

                            <!-- Product main img -->
                            <div class="col-md-6">


                                <?php if($producto->promocion()->exists() && ( \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end))): ?>
                                    <div class="icon-sale-label">
                                        <img width="60" src="<?php echo e($producto->promocion()->first()->imagen); ?>"
                                            alt="<?php echo e($producto->promocion()->first()->name); ?>" data-toggle="tooltip"
                                            data-placement="right" title="<?php echo e($producto->promocion()->first()->name); ?>}"
                                            alt="<?php echo e($producto->promocion()->first()->name); ?>">
                                    </div>
                                <?php endif; ?>


                                <div id="product-main-img">
                                    <?php if(count($allImages) > 0): ?>
                                        <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="product-preview thumbnail">
                                                <img src="<?php echo e(url($allImage->urlimagen)); ?>"
                                                    alt="<?php echo e(url($allImage->urlimagen)); ?>"
                                                    alt="<?php echo e($producto->nombre_producto); ?>">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="product-preview thumbnail">
                                            <img src="<?php echo e(image('')); ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>


                                <!-- Product thumb imgs -->
                                <div class="col-md-12 mt-1">
                                    <div id="product-imgs">
                                        <?php if(count($allImages) > 0): ?>
                                            <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="product-preview ">
                                                    <img src="<?php echo e(url($allImage->urlimagen)); ?>" class="img-fluid"
                                                        alt="<?php echo e(url($allImage->urlimagen)); ?>">
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <!--
                                        <div class="product-preview ">
                                            <img src="<?php echo e(image('')); ?>" class="img-fluid" alt="" >
                                        </div>
                                        -->
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /Product thumb imgs -->


                            </div>
                            <!-- /Product main img -->




                            <!-- Product details -->
                            <div class="col-md-6">
                                <div class="product-details ">
                                    <div class="border-bottom-custom">

                                        <h2 class="product-name"><?php echo e($producto->nombre_producto); ?></h2>
                                        <h3 class="product-name mt-2 fs-16">Marca:
                                            <?php echo e($producto->getMarcaProduct($producto->id)['nombre']); ?></h3>
                                        <div class="d-flex">




                                            <?php if($producto->promocion()->exists()
                                            &&  $check = \Carbon\Carbon::now()->between($producto->promocion()->first()->start, $producto->promocion()->first()->end)
                                            ): ?>
                                                <h3 class="bold">
                                                    <?php echo e('$' . number_format((float) precioNew($producto->slug), 0, ',', '.')); ?>

                                                </h3>

                                                <span
                                                    class="tachado font-weight-light mt-1 ml-1"><?php echo e('$' . number_format((float) $producto->precioventa_iva, 0, ',', '.')); ?>

                                                </span>
                                            <?php else: ?>
                                                <h3 class="bold">
                                                    <?php echo e('$' . number_format((float) precioNew($producto->slug), 0, ',', '.')); ?>

                                                </h3>
                                            <?php endif; ?>


                                        </div>

                                    </div>

                                    <div class="d-block mb-2 mt-1">
                                        <div class="row no-gutters ">
                                            <div class="col-sm-6">
                                                Referencia: <?php echo e($producto->referencia); ?>

                                            </div>
                                            <div class="col-sm-6">
                                                <span class="float-right">Stock:
                                                    <?php if($producto->cantidad_critica): ?>
                                                        <?php if(!$producto->cantidad == 0): ?>
                                                            <?php if($producto->cantidad_critica >= $producto->cantidad): ?>
                                                                Pocas unidades
                                                            <?php else: ?>
                                                                Disponible
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            No disponbile
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if($param->cantidad_critica): ?>
                                                            <?php if(!$producto->cantidad == 0): ?>
                                                                <?php if($param->cantidad_critica >= $producto->cantidad): ?>
                                                                    Pocas unidades
                                                                <?php else: ?>
                                                                    Disponible
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                No disponbile
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            Disponible
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-bottom-custom">
                                        <p class="mt-3 expander"><?php echo e(str_limit($producto->descripcion, 1500)); ?></p>
                                        <div class="d-block mb-4 mt-1">
                                            <div class="row no-gutters h-100">
                                                <div class="col-lg-3">
                                                    <label>Cantidad</label>
                                                    <div class="d-inline-block">

                                                        <div class="qty-box">

                                                            <input type='button' value='-' class='qtyminus'
                                                                field='quantity' data-id="<?php echo e($producto->id); ?>" />
                                                            <input type='number'
                                                                onkeyup="this.value=this.value.replace(/[^1-9]/g,'');"
                                                                name='qty' id="<?php echo e($producto->id); ?>"
                                                                value="<?php echo e(isset($qty) ? $qty : 1); ?>" class='qty'
                                                                data-id="<?php echo e($producto->id); ?>" />

                                                            <input type='button' value='+' class='qtyplus'
                                                                field='quantity' data-id="<?php echo e($producto->id); ?>" />
                                                        </div>



                                                        
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-lg-9 justify-content-end align-self-end">
                                                    <?php if($producto->cantidad <= 0 || $producto->estado == false): ?>
                                                        <button type="submit" class="btn btn-danger checkout-button">No
                                                            disponible</button>
                                                    <?php else: ?>
                                                        <button 
                                                        id="AddToCart"
                                                        type="submit" class="btn btn-primary checkout-button">
                                                            <img src="<?php echo e(asset('img/cart-white.png')); ?>"
                                                                class="img-fluid header-icon"
                                                                alt="<?php echo e($producto->nombre_producto); ?>">Comprar</button>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <ul class="footer_list d-inline-flex mt-2">
                                        <li>

                                            <a class="facebook-share-button"
                                                href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(route('product.show', ['slug_' => $producto->slug])); ?>"
                                                target="_blank">
                                                <img src="<?php echo e(asset('img/fb.png')); ?>" class="img-fluid mr-1 img-footer"
                                                    width="40" alt="<?php echo e($producto->nombre_producto); ?>">
                                            </a>
                                            
                                        </li>
                                        <li>
                                            


                                            <a class="twitter-share-button"
                                                href="https://twitter.com/intent/tweet?text=<?php echo e($producto->nombre_producto); ?> <?php echo e(route('product.show', ['slug_' => $producto->slug])); ?>"
                                                data-size="large" data-text="<?php echo e($producto->nombre_producto); ?>"
                                                data-url="<?php echo e(route('product.show', ['slug_' => $producto->slug])); ?>"
                                                data-hashtags="<?php echo e($producto->referencia); ?>,<?php echo e($producto->alias); ?>,<?php echo e($param->nombre_tienda); ?>"
                                                data-via="" data-related="twitterapi,twitter" target="_blank">
                                                <img src="<?php echo e(asset('img/tw.png')); ?>" class="img-fluid mr-1 img-footer"
                                                    width="40" alt="<?php echo e($producto->nombre_producto); ?>">
                                            </a>

                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- /Product details -->
                    <div class="col-xl-2 mb-3 pl-0 pr-0">
                        <?php echo $__env->make('partials.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>


                </div>


                <!-- /row -->

                <!-- Product tab -->
                <div class="row border-bottom-custom mt-2">
                    <div class="col-md-12">
                        <div class="mayus mb-2 fs-16 mt-3 mb-3">ESPECIFICACIONES</div>
                        <p><?php echo $producto->descripcion_larga; ?></p>
                    </div>
                </div>



                <div class="row border-bottom-custom">
                    <div class="col-md-12">
                        <div class="mayus mb-2 fs-16 mt-3 mb-3">INFORMACIÓN ADICIONAL</div>

                        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><strong><?php echo e($filter['categoria6']); ?></strong> <?php echo e($filter['categoria7']); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>



                <div class="row border-bottom-custom">
                    <div class="col-md-12 mt-2">
                        <!-- <div class="mayus mb-2 fs-16 mt-3 mb-3">INFORMACIÓN ADICIONAL</div> -->

                        <p><strong>IMPORTANTE PARA TENER EN CUENTA:</strong>
                            <br> - Producto sujeto a disponibilidad.
                            <br> - Las imágenes publicadas para este producto son ilustrativas. El producto
                            real puede variar con respecto a los colores, aspecto y sensación de la
                            representación visual en este sitio web.
                            <br> - Aunque realizamos todos nuestros esfuerzos para comprobar los precios,
                            cantidades disponibles, especificaciones de los productos y para evitar
                            errores en cada publicación, de vez en cuando se pueden presentar errores
                            de forma inadvertida. En tal caso nos reservamos el derecho de rechazar los
                            pedidos que surjan de dichos errorres y proceder con la devolución del dinero.

                        </p>

                    </div>
                </div>

            </div>

        </div>
        <!-- /product tab -->



        </div>
        <!-- /container -->
    </form>

    <!-- /SECTION -->


    <!--aca-->
    <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('extra-js'); ?>



    <?php echo $__env->make('partials.js.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.zoom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(url('js/qty.js')); ?>"></script>
    <script src="<?php echo e(url('js/jquery.expander.min.js')); ?>"></script>
    <!-- lightgallery plugins -->
    <script src="<?php echo e(url('js/lightgallery/lightgallery.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/jquery.mousewheel.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/lightgallery/lg-thumbnail.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/lightgallery/lg-fullscreen.min.js')); ?>"></script>


    <script>
        $('.expander').expander({
            slicePoint: 200,
            //widow: 2,
            expandEffect: 'show',
            expandSpeed: 0,
            collapseEffect: 'hide',
            collapseSpeed: 0,
            userCollapseText: 'Leer menos',
            expandText: 'Leer más',
            moreLinkClass: 'badge badge-pill badge-light',
            lessLinkClass: "badge badge-pill badge-light",
            //userCollapseText: '[^]'
        });
    </script>


    <script type="text/javascript">
        var image_current = null;

        $("#lightgallery").lightGallery({
            selector: '.thumbnail',
            cssEasing: 'cubic-bezier(0.680, -0.550, 0.265, 1.550)',
            download: false,
            speed: 500
        });



        $('.thumbnail').on('click', function(e) {

            var allImages = <?php echo $allImages->toJson(); ?>;
            var array = new Array();

            $.each(allImages, function(key, value) {
                array.push({
                    src: value.urlimagen,
                    thumb: value.urlimagen
                });
            });

            $(this).lightGallery({
                download: false,
                dynamic: true,
                dynamicEl: array,
                index: $(this).index(),
            })
        });
    </script>

    <?php if(!empty(Session::get('error_code')) && Session::get('error_code') == 5): ?>
        <script>
            $(function() {

                var id = '<?php echo e(Session::get('id')); ?>';
                var qty = '<?php echo e(Session::get('qty')); ?>';
                console.log(qty)
                $('.qty').val(qty);

                if (!id) {
                    var id = null;
                }
                $('#modalCiudadesSelector').modal('show');
                $('#modalCiudadesSelector').find('.modal-body #id').val(id)
            });
        </script>
    <?php endif; ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "<?php echo e($producto->nombre_producto); ?>",
  "image": "<?php echo e($allImages->first()->urlimagen); ?>",
  "description": "<?php echo e($producto->descripcion); ?>",
  "brand": {
    "@type": "Brand",
    "name": "<?php echo e($producto->getMarcaProduct($producto->id)['nombre']); ?>"
  },
  "sku": "<?php echo e($producto->referencia); ?>",
  "offers": {
    "@type": "Offer",
    "url": "<?php echo e(url()->current()); ?>",
    "priceCurrency": "<?php echo e($moneda->name); ?>",
    "price": "<?php echo e($producto->precioventa_iva); ?>",
    "priceValidUntil" : "<?php echo e(date('Y-m-d', strtotime('+1 month'))); ?>",
    "availability": "https://schema.org/InStock",
    "itemCondition": "https://schema.org/NewCondition"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "100",
    "bestRating": "100",
    "worstRating": "100",
    "ratingCount": "1",
    "reviewCount": "1"
  },
  "review": {
    "@type": "Review",
    "name": "<?php echo e($nombre_tienda); ?>",
    "reviewBody": "<?php echo e($producto->descripcion); ?>",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "100",
      "bestRating": "100",
      "worstRating": "100"
    },
    "datePublished": "<?php echo e($producto->created_at); ?>",
    "author": {"@type": "Person", "name": "<?php echo e($nombre_tienda); ?>"},
    "publisher": {"@type": "Organization", "name": "<?php echo e($nombre_tienda); ?>"}
  }
}
</script>

<script type="text/javascript">
    var moneda= "<?php echo e($moneda->name); ?>"
    var usuario="<?php echo e(Auth::check() ? Auth::user()->email : 'Usuario no logueado'); ?>"
    var referencia="<?php echo e($producto->referencia); ?>"
    var nombre="<?php echo e($producto->nombre_producto); ?>"
    var cantidad = $('.qty').val()
    var precio="<?php echo e($producto->precioventa_iva); ?>"
    
</script>

<script type="text/javascript">

console.log('moneda ' + moneda)
console.log('usuario ' + usuario)
console.log('referencia ' + referencia)
console.log('nombre ' + nombre)
console.log('cantidad ' + cantidad)
console.log('precio ' + precio)

</script>


<!-- add or no pixel code-->
<?php if(App\Pixel::first()->pixel_id != null): ?>
<?php if(App\PixelEvents::where('type', 'add_to_cart')->first()->active == true): ?>
    <?php echo \App\PixelEvents::where('type', 'add_to_cart')->first()->code; ?>

<?php endif; ?>

<?php if(App\PixelEvents::where('type', 'ver_contenido_producto')->first()->active == true): ?>
    <?php echo \App\PixelEvents::where('type', 'ver_contenido_producto')->first()->code; ?>

<?php endif; ?>



<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/layouts/product.blade.php ENDPATH**/ ?>