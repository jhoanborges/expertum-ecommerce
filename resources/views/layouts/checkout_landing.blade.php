@extends('welcome')
@section('content')


<div class="jumbotron jumbotron-fluid bg-gray mt-5 mb-3">
  <div class="container text-center bg-gray">
    <h2 class="">Redireccionando...</h2>
    <i class="fas fa-spinner fa-spin fa-4x mt-3 mb-3 black"></i>
    <h4 > <button onclick="submit()" class="black btn-transparent">Haz click aquí si tu navegador no te redirige automaticamente<button></h4>
    </div>
</div>





{{--
<form id="form" method="post" action="https://checkout.payulatam.com/ppp-web-gateway-payu/" class="form-prevent">
    {{ csrf_field() }}
    <input name="merchantId"         type="hidden"  value="{{$merchantId}}">
    <input name="accountId"          type="hidden"  value="{{$accountId}}">
    <input name="description"        type="hidden"  value="{{$descripcionproducto}}">
    <input name="referenceCode"      type="hidden"  value="{{$reference}}">
    <input name="extra1"             type="hidden"  value="{{$reference}}">
    <input name="amount"             type="hidden"  value="{{$totalizacion}}">
    <input name="tax"                type="hidden"  value="{{$iva}}">
    <input name="taxReturnBase"      type="hidden"  value="{{$base_iva}}">
    <input name="currency"           type="hidden"  value="{{$moneda_name}}">
    <input name="signature"          type="hidden"  value="{{$firma}}">

    <!-- EN PRODUCCION ESTO SERIA CERO -->
    <!-- <input name="test"               type="hidden"  value="0"> -->

    <input name="buyerEmail"         type="hidden"  value="{{Auth::user()->email}}">
    <!--todas las variables adminitidas-->
    <input name="shippingAddress"    type="hidden" value="" >
    <input name="shippingCity"       type="hidden" value="" >
    <input name="shippingCountry"    type="hidden" value="" >
    <input name="lng"                type="hidden" value="" >
    <input name="payerFullName"      type="hidden" value="{{$fullname}}" >
    <input name="payerDocument"      type="hidden" value="{{$request['numero']}}" >
    <input name="mobilePhone"        type="hidden" value="{{$request['telefono']}}" >
    <input name="billingAddress"     type="hidden" value="{{$request['direccion']}}" >
    <input name="telephone"          type="hidden" value="{{$request['telefono']}}" >
    <input name="officeTelephone"    type="hidden" value="{{$request['telefono']}}" >
    <input name="algorithmSignature" type="hidden" value="" >
    <input name="billingCity"        type="hidden" value="{{$request['city']}}" >
    <input name="zipCode"            type="hidden" value="" >
    <input name="billingCountry"     type="hidden" value="" >
    <input name="buyerFullName"      type="hidden" value="{{$request['entregar']}}" >
    <input name="payerEmail"         type="hidden" value="">
    <input name="payerPhone"         type="hidden" value="">
    <input name="payerOfficePhone"   type="hidden" value="">
    <input name="payerMobilePhone"   type="hidden" value="">

    <input name="responseUrl"        type="hidden"  value="http://ecommerce.materilejuguetes.com/public/ResponsePayu.php">
    <input name="confirmationUrl"    type="hidden"  value="http://admin.materilejuguetes.com/app/Http/Controllers/ConfirmationController.php">
</form>
--}}

<form method="post" id="form" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" class="form-prevent" >
    <input name="merchantId"      type="hidden"  value="508029"   >
    <input name="accountId"       type="hidden"  value="512321" >
    <input name="description"     type="hidden"  value="{{$descripcionproducto}}"  >
    <input name="referenceCode"   type="hidden"  value="{{$reference}}" >
    <input name="extra1"          type="hidden"  value="{{$reference}}">
    <input name="amount"          type="hidden"  value="{{$totalizacion}}"   >
    <input name="tax"             type="hidden"  value="{{$iva}}"  >
    <input name="taxReturnBase"   type="hidden"  value="{{$base_iva}}" >
    <input name="currency"        type="hidden"  value="{{$moneda_name}}" >
    <input name="signature"       type="hidden"  value="{{$firma}}">
    <input name="test"            type="hidden"  value="1" >
    <input name="buyerEmail"      type="hidden"  value="{{Auth::user()->email}}">
    <input name="payerFullName"   type="hidden"  value="{{$fullname}}" >
    <input name="payerDocument"   type="hidden"  value="{{$request['numero']}}" >
    <input name="mobilePhone"     type="hidden"  value="{{$request['telefono']}}" >
    <input name="billingAddress"  type="hidden"  value="{{$request['direccion']}}" >
    <input name="telephone"       type="hidden"  value="{{$request['telefono']}}" >
    <input name="officeTelephone" type="hidden"  value="{{$request['telefono']}}" >
    <input name="billingCity"     type="hidden"  value="{{$request['city']}}" >
    <input name="buyerFullName"   type="hidden"  value="{{$request['entregar']}}" >
    <input name="responseUrl"     type="hidden"  value="http://ecommerce.materilejuguetes.com/public/ResponsePayu.php">
    <input name="confirmationUrl" type="hidden"  value="http://admin.materilejuguetes.com/app/Http/Controllers/ConfirmationController.php">
</form>




@include('partials.newsletter')
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
@endsection
@endsection
