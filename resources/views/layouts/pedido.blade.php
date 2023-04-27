@extends('welcome')
@section('extra-css')
@endsection

@section('content')

    <div id="pedidos-component"
data-heart="{{ asset('img/heart.png') }}"
data-trash="{{ asset('img/trash.png') }}"
data-cart="{{ asset('img/cart-white.png') }}"
></div>

@endsection
