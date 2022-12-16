@extends('welcome')
@section('content')

@if($type == 'epayco')
<div class="jumbotron jumbotron-fluid bg-gray mt-5 mb-3">
  <div class="container text-center bg-gray">
    <h2 class="">Redireccionando...</h2>
    <i class="fas fa-spinner fa-spin fa-4x mt-3 mb-3 black"></i>
    <h4 > Haz click en el boton pagar si tu navegador no te redirige automaticamente</h4>
    </div>
     <form class="text-center ">
        <script
            src="https://checkout.epayco.co/checkout.js"
            class="epayco-button"
            id="epayco"
            data-epayco-key="{{$key}}"
            data-epayco-name="{{$products_names}}"
            data-epayco-description="{{$products_names}}"
            data-epayco-currency="cop"
            data-epayco-country="co"
            data-epayco-test="{{$test}}"
            data-epayco-external="true"
            data-epayco-response="{{$response}}"
            data-epayco-confirmation="{{$confirmation}}"
            data-epayco-tax="{{$iva}}"
            data-epayco-tax-base="{{$base_iva}}"
            data-epayco-currency="{{$moneda_name}}"
            data-epayco-amount="{{$totalizacion}}"
            data-epayco-invoice="{{$reference}}"
            data-epayco-extra1="{{$reference}}"
            data-epayco-autoclick="false"
            data-epayco-email-billing="{{Auth::user()->email}}"
            data-epayco-name-billing ="{{$request['razon']}}"
            data-epayco-address-billing="{{$request['direccion']}}"
            data-epayco-mobilephone-billing ="{{$request['telefono']}}"
            data-epayco-number-doc-billing="{{$request['numero']}}"
            >          
            </script>
        </form>
    </div>
</div>
</div>


@elseif($type == 'mercadopago')

@elseif($type == 'payu')

<div class="jumbotron jumbotron-fluid bg-gray mt-5 mb-3">
  <div class="container text-center bg-gray">
    <h2 class="">Redireccionando...</h2>
    <i class="fas fa-spinner fa-spin fa-4x mt-3 mb-3 black"></i>
    <h4 > <button onclick="submit()" class="black btn-transparent">Haz click aquí si tu navegador no te redirige automaticamente<button></h4>
    </div>
</div>

<!-- PRODUCCION -->
<form id="form" method="post" action="{{$endpoint_url}}" class="form-prevent">
    {{ csrf_field() }}
    <input name="merchantId"         type="hidden"  value="{{$merchantId}}">
    <input name="accountId"          type="hidden"  value="{{$accountId}}">
    <input name="description"        type="hidden"  value="{{$reference}}">
    <input name="referenceCode"      type="hidden"  value="{{$reference}}">
    <input name="extra1"             type="hidden"  value="{{$reference}}">
    <input name="amount"             type="hidden"  value="{{$totalizacion}}">
    <input name="tax"                type="hidden"  value="{{$iva}}">
    <input name="taxReturnBase"      type="hidden"  value="{{$base_iva}}">
    <input name="currency"           type="hidden"  value="{{$moneda_name}}">
    <input name="signature"          type="hidden"  value="{{$firma}}">

    <!-- EN PRODUCCION ESTO SERIA CERO -->
    <!-- <input name="test"               type="hidden"  value="0"> -->
    <input name="test"               type="hidden"  value="{{$test}}">

    <input name="buyerEmail"         type="hidden"  value="{{Auth::user()->email}}">
    <!--todas las variables adminitidas-->
    <input name="shippingAddress"    type="hidden" value="" >
    <input name="shippingCity"       type="hidden" value="" >
    <input name="shippingCountry"    type="hidden" value="" >
    <input name="lng"                type="hidden" value="" >
    <input name="payerFullName"      type="hidden" value="{{$request['razon']}}" >
    <input name="payerDocument"      type="hidden" value="{{$request['numero']}}" >
    <input name="mobilePhone"        type="hidden" value="{{$request['telefono']}}" >
    <input name="billingAddress"     type="hidden" value="{{$request['direccion']}}" >
    <input name="telephone"          type="hidden" value="{{$request['telefono']}}" >
    <input name="officeTelephone"    type="hidden" value="{{$request['telefono']}}" >
    <input name="algorithmSignature" type="hidden" value="" >
    <input name="billingCity"        type="hidden" value="{{$request['city']}}" >
    <input name="zipCode"            type="hidden" value="" >
    <input name="billingCountry"     type="hidden" value="" >
    <input name="buyerFullName"      type="hidden" value="{{$request['razon']}}" >
    <input name="payerEmail"         type="hidden" value="">
    <input name="payerPhone"         type="hidden" value="">
    <input name="payerOfficePhone"   type="hidden" value="">
    <input name="payerMobilePhone"   type="hidden" value="">
    <input name="responseUrl"        type="hidden"  value="{{$callback_url}}">
    <input name="confirmationUrl"    type="hidden"  value="{{$return_url}}">
</form>

<!-- END PRODUCCION -->

@else
<h1>No se ha configurado el checkout. Contacte al administrador del sitio.</h1>
@endif

@section('extra-js')

<script>
    window.onload=function(){
        window.setTimeout(function() {
         submit()
     }, 4000);
    };

    function submit() {
      document.getElementById("form").submit()
  }

</script>



<script type="text/javascript">
  var usuario="{{Auth::check() ? Auth::user()->email : 'Usuario no logueado'}}"
  var total= "{{$totalizacion}}"
  var moneda= "{{$moneda_name}}"
  var numero_pedido= "{{$reference}}"

  console.log(usuario)
  console.log(total)
  console.log(moneda)
  console.log(numero_pedido)
</script>



    <!-- add or no pixel code-->
    @if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'iniciar_pago')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'iniciar_pago')->first()->code !!}
        @endif
    @endif
    
@endsection


@include('partials.newsletter')




@endsection
