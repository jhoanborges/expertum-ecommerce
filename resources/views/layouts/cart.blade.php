@extends('welcome')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.dataTables.min.css')}}">

@endsection

@section('content')

<section class="tables">
  <div class="container">
    <div class="row">

      <div class="col-lg-12">

        <div class="big-title mayus mb-2">carrito - <b>de compras</b> </div>

        <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-striped table-bordered">
                <thead class="borders">
                  <tr class="text-center">
                    <th class="body-text mayus bold black"></th>
                    <th class="body-text mayus bold black">Producto</th>
                    <th class="body-text mayus bold black">Disponibilidad</th>
                    <th class="body-text mayus bold black">Precio unitario</th>
                    <th class="body-text mayus bold black">iva (%)</th>
                    <th class="body-text mayus bold black">cantidad</th>
                    <th class="body-text mayus bold black">total</th>
                    <th class="body-text mayus bold transparent">edit</th>
                    <th class="body-text mayus bold transparent">edit</th>
                </tr>

                <tbody>
                    @foreach(Cart::instance('shopping')->content() as $product)
                    <tr>
                      <td class="text-center">
                          <img width="180" class="" src="{{ asset('img/dinosaurio-tyrannosaurus-rex-skeleton-4m.jpg') }}" alt="">

                      </td>
                      <td class="text-center" >
                        <span class="d-inline-block">{{$product->name}}</span>
                        <span class="d-inline-block">{{$product->options->brand}} </span>
                    </td>
                    <td class="text-center">{{$product->options->avaliable}}</td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">{{$product->options->iva}}</td>
                    <td class="text-center">{{$product->qty}}</td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">

                      <a href="#" class="icons">
                          <img src="{{ asset('img/corazon.png') }}" class="img-fluid cart-icon-new">
                      </a>
</td>
                    <td class="text-center">

                      <a href="#" class="icons">
                          <img src="{{ asset('img/trash.png') }}" class="img-fluid cart-icon-new">
                      </a>
                  </td>
              </tr>

              @endforeach

          </tbody>

      </thead>
  </table>
</div>
</div>

</div>


</div>
</div>
</section>

<!--aca-->
@include('partials.newsletter')

@section('extra-js')
<script src="{{url('js/loadingoverlay.min.js')}}"></script>

<script src="{{url('js/jquery.dataTables.min.js')}}"></script>



@endsection

@endsection
