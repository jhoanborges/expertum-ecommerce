@extends('welcome')

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.dataTables.min.css')}}">

@endsection

@section('content')

 @if(Cart::content()->count()>0)
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
                  @foreach(Cart::instance('default')->content() as $product)
                  <tr>
                    <td class="text-center">
                        <a href="{{route('product.show' , ['product'=>$product->id ])}}">
                      <img width="180" class="" src="{{$product->options->imagen }}" alt="">
                      </a>

                  </td>
                  <td class="text-center" >
                        <a href="{{route('product.show' , ['product'=>$product->id ])}}">

                      <p class="mb-0">{{$product->name}}</p>
                  </a>
                      <p class="mb-0">{{$product->options->brand}} </p>
                  </td>
                  {{--<td class="text-center">{{$product->options->avaliable}}</td>--}}
                  <td class="text-center"><i class="fas fa-check fa-2x lightgreen"></i></td>
                  <td class="text-center bold black">$ {{formatPrice($product->price)}}</td>
                  <td class="text-center"> {{$product->options->iva.''.'%'  }}</td>
                  <td class="text-center">
                      <div class="qty-box">

                        <input type='button' value='-' class='qtyminus' field='quantity' />
                        <input type='text' name='quantity' value='{{$product->qty}}' class='qty'
                        data-id="{{$product->rowId}}"/>

                        <input type='button' value='+' class='qtyplus' field='quantity' />
                    </div>

                </td>
                <td class="text-center bold black">$ {{formatPrice(precioNew($product->id)) }}</td>
                <td class="text-center">

                  <form action="{{route('favoritos.swichtf', $product->rowId)}}" method="POST" class="">
                      {{csrf_field()}}

                      <button type="submit"class="icons btn-transparent" data-toggle="tooltip" data-placement="top" title="Agregar a favoritos">
                        <img src="{{ asset('img/heart.png') }}" class="img-fluid cart-icon-new">
                    </button>
                </form>


            </td>
            <td class="text-center">
{{--}}
              <a href="#" class="icons">
                <img src="{{ asset('img/trash.png') }}" class="img-fluid cart-icon-new">
            </a>
            --}}
            <form action="{{route('resumen.destroy', $product->rowId)}}" method="POST" class="">
              {{csrf_field()}}
              {{method_field('DELETE')}}

              <button type="submit"class="icons btn-transparent">
                <img src="{{ asset('img/trash.png') }}" class="img-fluid cart-icon-new">
            </button>

        </form>

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
       <span class="ml-5">${{formatPrice($sub)}}</span>
   </div>
</div>


<div class="row justify-content-end pt-2 pb-2">
    <div class="col-6 col-sm-2">
      IVA
  </div>
  <div class="col-6 col-sm-2">
     <span class="ml-5">${{formatPrice($totaliva)}}</span>

 </div>
</div>



<div class="row justify-content-end pt-2 pb-2">
  <div class="col-6 col-sm-2">
    <span class="bold">Total</span>
</div>
<div class="col-6 col-sm-2">
   <span class="ml-5 bold">${{formatPrice($total)}}</span>

</div>
</div>

</div>

<div class="container">

   <div class="row justify-content-end pt-4 pb-2">
    <a href="{{ route('checkout') }}" class="btn btn-danger checkout-button">
      <img src="{{ asset('img/cart-white.png') }}" class="img-fluid header-icon">
  Checkout</a>
</div>
</div>

</div>
</div>
</section>

@else
<section class="p-5">
  <div class="container p-5">
    <div class="row text-center">
      <div class="col-lg-12">


        <div class="big-title mayus mb-3 ">carrito <b>de compras vacío</b> </div>
    </div>
</div>
</div>
</section>
@endif



<!--aca-->
@include('partials.newsletter')

@section('extra-js')
<script src="{{url('js/loadingoverlay.min.js')}}"></script>

<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('js/qty.js')}}"></script>






@endsection

@endsection
