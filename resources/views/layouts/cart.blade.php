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

        <div class="big-title mayus mb-3 border-bottom-custom">carrito <b>de compras</b> </div>

        <div class="card-body mb-3">
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
                      <p class="mb-0">{{$product->name}}</p>
                      <p class="mb-0">{{$product->options->brand}} </p>
                    </td>
                    {{--<td class="text-center">{{$product->options->avaliable}}</td>--}}
                    <td class="text-center"><i class="fas fa-check fa-2x lightgreen"></i></td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">{{$product->options->iva}}</td>
                    <td class="text-center">
                      <div class="qty-box">

                        <input type='button' value='-' class='qtyminus' field='quantity' />
                        <input type='text' name='quantity' value='0' class='qty' />
                        <input type='button' value='+' class='qtyplus' field='quantity' />
                      </div>

                    </td>
                    <td class="text-center bold black">$ {{$product->price}}</td>
                    <td class="text-center">

                      <a href="#" class="icons">
                        <img src="{{ asset('img/heart.png') }}" class="img-fluid cart-icon-new">
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

      <div class="container text-right borders">


        <div class="row justify-content-end pt-2 pb-2">
          <div class="col-6 col-sm-2">
            Sub Total
          </div>
          <div class="col-6 col-sm-2">
           <span class="ml-5">$25.000 </span>
         </div>
       </div>


       <div class="row justify-content-end pt-2 pb-2">
        <div class="col-6 col-sm-2">
          IVA
        </div>
        <div class="col-6 col-sm-2">
         <span class="ml-5">$1.000 </span>

       </div>
     </div>



     <div class="row justify-content-end pt-2 pb-2">
      <div class="col-6 col-sm-2">
        <span class="bold">Total</span>
      </div>
      <div class="col-6 col-sm-2">
       <span class="ml-5 bold">$26.000 </span>

     </div>
   </div>

 </div>

 <div class="container">

   <div class="row justify-content-end pt-4 pb-2">
    <a href="{{ route('checkout.index') }}" class="btn btn-danger checkout-button">
      <img src="{{ asset('img/cart-white.png') }}" class="img-fluid header-icon">
    Checkout</a>
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
