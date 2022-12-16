@extends('welcome')

@section('content')

<div class="container mb-3 border-bottom">
  	<div class="row">
    	<div class="col-lg-12">
      		<div class="big-title mayus mb-4 store_title mt-3 "><b>POLÍTICAS DE DEVOLUCIONES Y CAMBIOS</b> </div>
    	</div>
  	</div>

  	<div class="row">
    	<div class="col-md-12">

    		<p>La siguiente política de devoluciones sólo se aplica a las compras realizadas en {{$param->nombre_tienda}}<br><br>
			Si deseas hacer un cambio, devolución o solicitud de garantía de alguno de nuestros productos comprados online, puedes hacerlo a  través de nuestra página web e iniciar el proceso a través del  módulo de contáctanos.<br><br>
			{{$param->razon_social}} se reserva el derecho de aceptar los cambios, devoluciones o garantías con previo análisis del producto.<br><br> 
			CONDICIONES:<br> 
			1.	Es obligatorio presentar tu factura o número de orden.<br>
			2.	Productos vendidos en promoción o con descuento no tienen cambio.<br>
			3.	Para que tu solicitud sea aprobada se requiere que el(los) producto(s) que se pretende(n) cambiar o devolver se encuentre(n) en las mismas condiciones y características en que ha(n) sido recibido(s) y, por lo tanto, estos deberá(n) tener:<br>
			-	Su empaque original en perfecto estado (tanto en su interior como en su exterior) incluyendo instrucciones en el caso que el producto las tenga.<br> 
			-	En el caso de rompecabezas la bolsa interna en el que viene el producto dentro de la caja debe estar con su sello original sin que este fuera alterado.<br> 
			-	No debe haber sido usado.<br>
			-	No debe haber sido ensamblado o armado en el caso de los productos que requieran de esta acción.<br>
			-	No debe estar modificado o alterado de su estado original.<br>
			-	Productos de aseo personal y alimentos no tienen cambio ni derecho a retracto bajo ningún motivo.<br> 
			</p>     
      	</div>
    </div>
</div>

  @include('partials.newsletter')
  @endsection