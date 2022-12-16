<?php $__env->startSection('content'); ?>

<div class="container mb-3 border-bottom">
  <div class="row">
    <div class="col-lg-12">
      <div class="big-title mayus mb-4 store_title mt-3 "><b>POLÍTICAS DE GARANTÍAS</b> </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <p>CONDICIONES GENERALES Y SU ACEPTACIÓN<br><br>
      <?php echo e($param->razon_social); ?> te recomienda que cuando recibas el producto adquirido, ya sea en uno de nuestros almacenes o en tu domicilio, revises que este se encuentre en perfecto estado y que corresponda a la referencia adquirida. Antes de firmar el documento de entrega y aceptación, exige tu factura o soporte de la compra. No se aceptan reclamos por faltantes, daños o golpes después de recibida la mercancía.<br><br>
      Si tienes alguna novedad o inconformidad al recibir el producto en tu domicilio, por favor regístralo en el documento de entrega y comunícalo lo más pronto posible a través de nuestras líneas de contacto:<br>
      Teléfono: <?php echo e($param->telefono); ?><br>
      Correo electrónico: <?php echo e($param->correo); ?><br>
      Formulario de contacto: <a href="<?php echo e(route('about_us')); ?>" target="_blank"> Clic Aquí </a><br><br>
      Para tramitar la garantía es necesario presentar la tirilla de pago, factura o comprobante de compra. En caso de no contar con uno de estos soportes, puedes solicitarlo a través de nuestras líneas de contacto o de forma presencial en nuestros puntos de venta.<br><br>
      La garantía ofrecida por <?php echo e($param->razon_social); ?> será sobre productos adquiridos en nuestros puntos de venta o a través de nuestras tiendas en línea. Cualquier compra de productos a personas o empresas externas no será cubierta por nuestras políticas de garantías.<br><br>
      La garantía de cualquier producto estará sujeta a un diagnóstico previo y no será procedente si el diagnóstico emitido resulta en que el defecto se debe a fuerza mayor o caso fortuito, el hecho de un tercero, el uso indebido del producto o causada por no seguir las instrucciones de instalación, uso o mantenimiento y recomendaciones indicadas en el manual del producto o en el documento de condiciones de garantía del mismo.<br><br>
      La garantía tampoco aplica en los eventos contemplados en las exclusiones que se especifiquen en las cajas de los productos o en la página de internet del fabricante.<br><br>
      Toda solicitud de garantía se atenderá en un tiempo máximo de quince (15) días hábiles siguientes a su recepción, por ello, se debe tener en cuenta que el producto se remitirá al departamento de garantías o a quien corresponda para su diagnóstico técnico y su reparación (si aplica). <br><br>
      Si resulta procedente la garantía del producto, se efectuará la reparación sin costo adicional de los defectos del bien y se suministrarán oportunamente las partes y/o repuestos requeridos.<br><br> 
      El proceso de reparación se realizará dentro de los treinta (30) días hábiles contados a partir del día siguiente a la recepción de la solicitud.<br><br>
      Si el producto no admite reparación, se procederá a la devolución del precio pagado o con la respectiva reposición.<br><br>
      En caso de solicitar reposición de un producto por garantía, este deberá ser igual al producto inicialmente adquirido y en caso de no existir referencias iguales se procederá a entregar otro producto de equivalentes características y mismo valor del producto inicialmente adquirido. No se hará reposición de un producto por otro producto de mayor valor. Si este caso se llegase a presentar y quisieras un producto de mayor valor, tendrás que asumir el excedente.<br><br>
      En los casos en los que, de acuerdo a la Ley 1480 de 2011 y al Decreto 735 de 2013, se haga necesaria la devolución de dinero, esta se llevará a cabo a través del mismo medio de pago utilizado para la compra y los tiempos de dicha devolución estarán sujetos a los tiempos razonables del trámite según corresponda.<br><br>
      En caso de repetirse la falla de un producto reparado por garantía, a elección del consumidor, se procederá a una nueva reparación, la devolución del precio pagado o al cambio del producto por otro de la misma especie, similares características o especificaciones técnicas. <br><br>
      Si el producto estuviera en un lugar diferente al de la compra, el cliente deberá asumir los costos de transporte para hacer efectiva la garantía.<br><br>
      Una vez expirado el término de la garantía legal, deberás asumir el pago de cualquier revisión, diagnóstico, reparación y/o repuesto que requiera el producto.<br><br></p>


      </div>

    </div>


  </div>

  <?php echo $__env->make('partials.newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\developerweb\ecommerce.developerweb.dev\resources\views/layouts/dev_gtias.blade.php ENDPATH**/ ?>