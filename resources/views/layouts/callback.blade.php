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
            font-size: 20px;
            margin: 0;
        }

        .checkmark {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .error {
            color: #df1111;
        }

        .errormark {
            color: #df1111;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
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
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">)
                <i class="checkmark">✓</i>

            </div>
            <div class="my-4">

                <h1 class="">{{ $message }}</h1>
                <p>{{ $subtitle }}</p>
            </div>




            <body>
                {{-- <div class="container">
    <div class="row" style="margin-top:20px">
      <div class="col-lg-12">
        <p style="text-align:left" class="bold mt-3"> Respuesta de la Transacción </p>
      </div>
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Referencia</td>
                <td>{{$reference ?? null}}</td>
              </tr>
              <tr>
                <td >Fecha</td>
                <td>{{$date ?? null}}</td>
              </tr>
                <td>Orden</td>
                <td>{{$orderNumber ?? null}}</td>
              </tr>
              <tr>
                <td>Código de la operación</td>
                <td>{{$status ?? null}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> --}}

                <footer>
                    <div class="row mb-5 mt5">
                        <div class="container">
                            <div class="col-sm-12">
                                <img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/credibancologo.png"
                                    height="40px" style="margin-top:10px;">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            </body>

            <a href="{{ route('home') }}" class="btn btn-secondary button-rounded text-white">
                Seguir comprando</a>


        </div>

    </section>

    @include('partials.newsletter')
@section('extra-js')


@endsection
@endsection
