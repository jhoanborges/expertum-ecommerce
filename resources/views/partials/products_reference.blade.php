@if(\App\Parametromodelo::first()->show_products_reference == true)
<li class="pmd-card-subtitle-text blue body-text bold black">{{$producto['referencia']}}</li>
@endif