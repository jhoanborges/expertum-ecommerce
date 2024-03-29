@if ( $top->count() > 0 )

<div class="sidebar_section d-none d-sm-none d-md-block">
    <div class="footer_title mayus ">Destacados</div>
    <ul class="brands_list">
        <li class="row no-gutters h-100">
@foreach ($top->take(3) as $to)

            <div class="col-lg-12">

                <a href="{{route('product.show' , ['slug'=>
                isset($to['slug']) ? $to['slug'] : 'null'
                 ])}}" class="d-flex pt-2 pb-2 border-bottom-custom">
                    <img src="{{url(  $to->hasManyImagenes->first()->urlimagen )}}" class="top-image">

                    <div class="pmd-card-title pt-0 pb-0 pr-0 align-self-center">
                        <ul>
                            <li class="top-sub pmd-card-subtitle-text blue top-text two-row">{{$to->nombre_producto}}</li>
                            {{--<li class="top-sub pmd-card-subtitle-text blue body-text">4M-INDUSTRIAL</li>--}}
                            <li class="top-sub pmd-card-subtitle-text blue top-text bold black">{{'$ '.number_format((float) precioNew($to->slug), 0, ',', '.'  ) }}</li>
                        </ul>
                    </div>

                </a>
            </div>
@endforeach

        </li>

    </ul>
</div>

@endif


