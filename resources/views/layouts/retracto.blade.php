@extends('welcome')

@section('content')

<div class="container mb-3 border-bottom">
  <div class="row">
    <div class="col-lg-12">
      <div class="big-title mayus mb-4 store_title mt-3 "><b>DERECHO DE RETRACTO</b> </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <p>De acuerdo con El Estatuto del Consumidor, Ley 1480 de 2011, Artículo 47, se determina el derecho de retracto que tiene el comprador de un bien o servicio, en determinados casos o instancias especiales. <br><br>

        Por consiguiente, cuando las ventas son efectuadas a través de nuestro canal de comercio electrónico, {{$param->nombre_tienda}}, considerado este un método a distancia o no tradicional, el consumidor tiene derecho a solicitar, en un término de cinco (5) días siguientes a la compra, la devolución de la totalidad del dinero pagado con la consecuente devolución del producto adquirido.<br><br>

        Para ejercer el derecho de retracto, el consumidor deberá:<br>
        • Devolver el producto por los mismos medios y en las mismas condiciones en que lo recibió, sin indicaciones de uso o novedades no reportadas durante la entrega. Esto incluye accesorios, empaques originales, manuales y etiquetas.<br>
        • Asumir los costos de transporte y los demás que conlleve la devolución del bien.<br>
        • Presentar la factura de compra, original, en la que se demuestre que el producto fue comprado a través de {{$param->nombre_tienda}}<br><br>

        {{$param->razon_social}} ha dispuesto de los siguientes canales para ejercer el Derecho de Retracto:<br>
        • Dirección de domicilio, ubicada en {{$param->direccion}} {{$ciudad}}, {{$pais}}<br>
        • Dirección de correo electrónico, {{$param->correo}}<br>
        • Línea telefónica de servicio al cliente, {{$param->telefono}}<br>
        • Formulario de contacto a través de nuestro sitio web, <a href="{{ route('about_us') }}" target="_blank"> Clic Aquí</a><br><br>

        La devolución del dinero al consumidor se hará dentro de los treinta (30) días calendario desde el momento en que ejerció el derecho, a través del mismo medio utilizado para la compra. Si la compra fue pagada contraentrega, el dinero será devuelto a través de consignación y/o transferencia en la cuenta bancaria indicada y autorizada por el cliente.<br><br>

        Es importante tener en cuenta que, de acuerdo con la Ley 1480 de 2011, se exceptúan del derecho de retracto, los siguientes casos:<br>
        1. En los contratos de prestación de servicios cuya prestación haya comenzado con el acuerdo del consumidor;<br>
        2. En los contratos de suministro de bienes o servicios cuyo precio esté sujeto a fluctuaciones de coeficientes del mercado financiero que el productor no pueda controlar;<br>
        3. En los contratos de suministro de bienes confeccionados conforme a las especificaciones del consumidor o claramente personalizados;<br>
        4. En los contratos de suministro de bienes que, por su naturaleza, no puedan ser devueltos o puedan deteriorarse o caducar con rapidez;<br>
        5. En los contratos de servicios de apuestas y loterías;<br>
        6. En los contratos de adquisición de bienes perecederos;<br>
        7. En los contratos de adquisición de bienes de uso personal.<br><br>

        <strong>Consulte el contenido completo de la Ley 1480 de 2011 en </strong><a href="http://www.secretariasenado.gov.co/senado/basedoc/ley_1480_2011.html" target="_blank">https://www.secretariasenado.gov.co/senado/basedoc/ley_1480_2011.html</a> </p>


      </div>

    </div>


  </div>

  @include('partials.newsletter')
  @endsection
