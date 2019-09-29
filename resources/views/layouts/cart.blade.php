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

        <div class="big-title mayus mb-2">carrito <b>de compras</b> </div>

        <div class="card-body">
            <div class="table-responsive pb-2">
              <table id="myTable" class="table table-striped table-borderless mb-0 ">
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
                        <p class="">{{$product->name}}</p>
                        <p class="">{{$product->options->brand}} </p>
                    </td>
                    {{--<td class="text-center">{{$product->options->avaliable}}</td>--}}
                    <td class="text-center"><i class="fas fa-check fa-2x lightgreen"></i></td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">{{$product->options->iva}}</td>
                    <td class="text-center">
{{--
<div class="d-inline-flex">

<i class="fas fa-minus quantity-left-minus btn btn-number" data-type="minus" data-field=""></i>

<input type="text" id="quantity" name="quantity" class="form-control input-number" value="{{$product->qty}}" min="1" max="100">
<i class="fas fa-plus quantity-right-plus btn btn-number"  data-type="plus" data-field=""></i>

</div>
--}}
{{$product->qty}}
                    </td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">

                      <a href="#" class="icons">
                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="2.5em" height="3em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1040 928"><path d="M288 66q73 0 180 106l46 45 45-46q15-16 31.5-30t32.5-26 31.5-21T684 78.5t27.5-9.5 24.5-3q89 0 157 68 69 69 69 166t-69 167q-5 4-359 387-5 5-11 6.5t-10 1.5q-12 0-21-8-324-360-359-395-8-8-15.5-17.5t-14-19-12-19.5-10-20.5T74 361t-5.5-22-3.5-23-1-23q0-98 69-167 32-31 70-45.5T288 66zm0-64q-59 0-109 19T88 81q-43 43-65.5 99T0 292.5 22.5 405 88 504q9 9 49.5 53.5t91 100.5 100 111 83.5 92l34 37q27 28 66.5 28t67.5-28q354-383 358-386 88-88 88-212T938 89q-44-44-93.5-65.5T736 2q-53 0-111.5 35T513 126Q387 2 288 2z" fill="black"/></svg>
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
<script src="{{url('js/qty.js')}}"></script>



@endsection

@endsection
