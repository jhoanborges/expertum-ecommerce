@extends('welcome')
@section('content')
@section('extra-css')
@endsection
@include('partials.slider')


<div class="shop">
    <div class="container-fluid home-padding">
        <div class="row justify-content-center">
            @if ($show_pane == true)
                <div class="col-lg-2">
                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar d-none d-sm-block d-md-none d-lg-none d-xl-block">

                        @if (
                            $categorias->count() > 0 &&
                                ($param->categories_bar_position == 'left' || $param->categories_bar_position == 'both'))

                            <div class="sidebar_section w-100" id="sidebar_section">
                                <div class="row  no-gutters footer_title mayus">
                                    <div class="col-sm-12 no-gutters">
                                        <span>CATEGORÍAS</span>
                                        <a class="float-right" onclick="activate(); return false;">
                                            <i class="ti-search pointer"></i>
                                        </a>
                                    </div>
                                </div>
                                <input id="myInput" placeholder="Buscar"
                                    class="mt-2 search form-control fuzzy-search no-show" />

                                <ul class="sidebar_categories list pmd-scrollbar mCustomScrollbar">
                                    @if (count($categorias) > 0)
                                        @foreach ($categorias as $category)
                                            <li>
                                                <a class="category-name"
                                                    href="{{ route('categoria.get', ['cat' => $cat2 ?? 'null', 'categoria' => $category->slug ?? 'null']) }} ">{{ $category->nombrecategoria }}</a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>

                            </div>
                        @endif


                        <div class="sidebar_section mt-5">
                            @if (count($filters) > 0)
                                @include('partials.featured_filters')
                            @endif
                        </div>

                        @if ($param->show_featued_on_side == true)
                            <div class="sidebar_section mt-5">
                                @include('partials.top')
                            </div>
                        @endif

                    </div>

                </div>
            @endif



        </div>
    </div>

    @include('partials.newsletter')

</div>

@section('extra-js')
    <script src="{{ asset('js/list.min.js') }}"></script>

    @include('partials.js.slider')
    <script>
        $(document).ready(function() {
            $(".pmd-card").hover(
                function() {
                    $(this).addClass('shadow').css('cursor', 'pointer');
                },
                function() {
                    $(this).removeClass('shadow');
                }
            );
            // document ready
        });
    </script>

    <script>
        function activate() {
            $("#myInput").fadeToggle("fast", function() {});
            $('#myInput').focus();
        }

        var options = {
            valueNames: ['category-name']
        };

        var userList = new List('sidebar_section', options);
    </script>




    <script>
        $(function() {
            $(".filters").change(function(e) {
                document.getElementsByClassName("filters").disabled = true;
                var valor = [];
                $('input.filters[type=checkbox]').each(function() {
                    if (this.checked)
                        valor.push($(this).val());
                });


            });


        });
    </script>




    <!-- add or no pixel code VER CONTENIDO PRINCIPAL-->
    @if (App\Pixel::first()->pixel_id != null)
        @if (App\PixelEvents::where('type', 'ver_contenido_principal')->first()->active == true)
            {!! \App\PixelEvents::where('type', 'ver_contenido_principal')->first()->code !!}
        @endif
    @endif
@endsection
@endsection
