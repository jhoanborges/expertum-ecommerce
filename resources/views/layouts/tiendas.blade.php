@extends('welcome')

@section('content')

<div id="my-stores-component"
data-whatsapp="{{env('WHATSAPP_CONTACT_LINK')}}"
></div>


  @include('partials.newsletter')

  @section('extra-js')
  @endsection

  @endsection
