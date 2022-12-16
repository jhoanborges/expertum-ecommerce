@extends('welcome')
@section('content')


<style>
  .wrapper {
    padding: 40px 0;

    text-align: center;
    background: #EBF0F5;
}
h1 {
  color: #88B04B;
  font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
  font-weight: 900;
  font-size: 40px;
  margin-bottom: 10px;
}
p {
  color: #404F5E;
  font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
  font-size:20px;
  margin: 0;
}
.checkmark {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left:-15px;
}
.custom-card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
}
</style>

<section class="my-4 wrapper">
    <div class="custom-card my-2">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
    </div>
    <div class="my-4">

        <h1>Transacción exitosa</h1> 
        <p>Hemos recibido tu pago. <br/> Recibirás un correo con los detalles de tu compra.</p>
        <p># de referencia : {{$reference ?? null}}</p>
    </div>




<body>
  <header id="main-header" style="margin-top:20px">
    <div class="row">
      <div class="col-lg-12 franja">
        <img class="center-block" src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/logo1.png" style="">
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row" style="margin-top:20px">
      <div class="col-lg-8 col-lg-offset-2 ">
        <h4 style="text-align:left"> Respuesta de la Transacción </h4>
        <hr>
      </div>
      <div class="col-lg-8 col-lg-offset-2 ">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Referencia</td>
                <td id="referencia"></td>
              </tr>
              <tr>
                <td class="bold">Fecha</td>
                <td id="fecha" class=""></td>
              </tr>
              <tr>
                <td>Respuesta</td>
                <td id="respuesta"></td>
              </tr>
              <tr>
                <td>Motivo</td>
                <td id="motivo"></td>
              </tr>
              <tr>
                <td class="bold">Banco</td>
                <td class="" id="banco">
              </tr>
              <tr>
                <td class="bold">Recibo</td>
                <td id="recibo"></td>
              </tr>
              <tr>
                <td class="bold">Total</td>
                <td class="" id="total">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="row">
      <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
          <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/pagos_procesados_por_epayco_260px.png" style="margin-top:10px; float:left"> <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/credibancologo.png"
            height="40px" style="margin-top:10px; float:right">
        </div>
      </div>
    </div>
  </footer>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function getQueryParam(param) {
      location.search.substr(1)
        .split("&")
        .some(function(item) { // returns first occurence and stops
          return item.split("=")[0] == param && (param = item.split("=")[1])
        })
      return param
    }
    $(document).ready(function() {
      //llave publica del comercio

      //Referencia de payco que viene por url
      var ref_payco = getQueryParam('ref_payco');
      //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
      var urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;

      $.get(urlapp, function(response) {


        if (response.success) {

          if (response.data.x_cod_response == 1) {
            //Codigo personalizado
            alert("Transaccion Aprobada");

            console.log('transacción aceptada');
          }
          //Transaccion Rechazada
          if (response.data.x_cod_response == 2) {
            console.log('transacción rechazada');
          }
          //Transaccion Pendiente
          if (response.data.x_cod_response == 3) {
            console.log('transacción pendiente');
          }
          //Transaccion Fallida
          if (response.data.x_cod_response == 4) {
            console.log('transacción fallida');
          }

          $('#fecha').html(response.data.x_transaction_date);
          $('#respuesta').html(response.data.x_response);
          $('#referencia').text(response.data.x_id_invoice);
          $('#motivo').text(response.data.x_response_reason_text);
          $('#recibo').text(response.data.x_transaction_id);
          $('#banco').text(response.data.x_bank_name);
          $('#autorizacion').text(response.data.x_approval_code);
          $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);


        } else {
          alert("Error consultando la información");
        }
      });

    });
  </script>
</body>



    <a href="{{route('home')}}" class="btn btn-secondary button-rounded text-white">
    Seguir comprando</a>


</div>

</section>

@include('partials.newsletter')
@section('extra-js')
<script>
</script>
@endsection
@endsection
