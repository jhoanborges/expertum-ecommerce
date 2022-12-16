@extends('welcome')

@section('content')

<div class="container mb-3">

     @if($producto->count()>0)

  <div class="row">
    <div class="col-lg-12">
      <div class="big-title mayus mb-4 store_title "><b>Favoritos</b> </div>
    </div>
  </div>

@endif
  @forelse ($producto as $product)

  <div class="row">

    <div class="container h-100  mb-3 borders">
      <div class="row align-items-center h-100 p-2">
        <div class="col-sm-2 mx-auto text-center">
         <a href="{{route('product.show' , ['product'=>$product->slug] )}}" title="{{$product->nombre_producto}}">
          <img src="{{$product->hasManyImagenes->first()->urlimagen}}" class="img-fluid">
        </a>
      </div>
      <div class="col-sm-5 p-4">
        <h5 class="text-justify">{{$product->nombre_producto}}</h5>
        <h3 class="bold m-0">$ {{formatPrice( intval( precioNew($product->slug) ) )}}</h3>
      </div>

      <div class="col-sm-5 p-3 text-center">
        <div class="d-inline-flex">

          <form action="{{route('favoritos.swicht', $product->slug)}}" method="POST" class="form-prevent">
            {{csrf_field()}}
            <button type="submit"  class="btn favorite-button mr-3 bg-white black pr-2 pl-2">
              Agregar al carrito
            </button>
          </form>
          <button type="button" onclick="window.location='{{route('product.show' , ['product'=>$product->slug] )}}'" title="{{$product->nombre_producto}}'" class="btn btn-primary pr-2 pl-2 mr-3">
            Ver artículo
          </button>
          <form action="{{route('favoritos.destroy', ['id' => $product->slug])}}" method="POST" class="form-prevent">
            {{csrf_field()}}
            <button type="submit" class="btn-transparent" title="Eliminar">
              <img src="{{ asset('img/trash.png') }}" class="img-fluid " width="35">

            </button>
          </form>
        </div>
      </div>

    </div>

  </div>

</div>
@empty

<section class="p-5">
  <div class="container p-5">
    <div class="row text-center">
      <div class="col-lg-12">
        <div class="big-title mayus mb-3 ">No tienes<b> favoritos</b> </div>
      </div>
    </div>
  </div>
</section>
@endforelse
</div>


@include('partials.newsletter')
@section('extra-js')
@endsection

@endsection
