

<!-- Footer -->
<div class="container text-center">
    <div class="row floating-footer-button">
        <div class="col-lg-12 ">
            <button class="btn btn-secondary button-rounded"><span class="white">Suscríbete</span>
            </button>

        </div>

    </div>

</div>

<footer class="footer">

    <div class="container">
        <div class="row">



            <div class="col-lg-3 footer_col">
                <div class="footer_column text-center centered">
                   <a class="logo_h " href="index.html">
                      <img src="{{ asset('img/logo-materile.png') }}" alt="" class="img-fluid logo-bar" />
                  </a>

              </div>
          </div>


          @if (count($footer) > 0)
          @foreach ($footer as $project)
          <div class="col-lg-3">
            <div class="footer_column">
                <div class="footer_title mayus">{{$project->titulo}}</div>
<!--aca hay un tema, toda la lsita que viene del backend viene url e icono, pero en las nuevas plantillas de materile viene es una imagen asi que debo condicionar esto para que no aparezca el link, lo unico que se eme ocurrio es leer la url en busqueda de nombre de red social y asi redenderizar los componentes-->
                <ul class="footer_list">
                 @foreach($project['items'] as $project)
                    <li>
                        <a href="{{$project->url}}">
                            <i class="fas fa-chevron-right light-gray"></i>
                            {{$project->name}}
                        </a>
                    </li>

@endforeach



{{--}}
                <li>
                    <a href="{{ route('privacy') }}"  >
                        <i class="fas fa-chevron-right light-gray"></i>
                    Términos y condiciones</a>
                </li>
                <li>
                    <a href="{{ route('retracto') }}"  >
                        <i class="fas fa-chevron-right light-gray"></i>
                    Derecho de Retracto</a>
                </li>

                <li>
                    <a href="{{ route('about_us') }}">
                        <i class="fas fa-chevron-right light-gray"></i>
                    Sobre nosotros</a>
                </li>
                --}}
            </ul>
        </div>
    </div>
    @endforeach
    @endif


{{--
    <div class="col-lg-3">
        <div class="footer_column">
            <div class="footer_title mayus">tiendas materile</div>

            <ul class="footer_list">
                <li>
                    <a href="#">
                        <img src="{{ asset('img/location.png') }}" class="img-fluid mr-1 img-footer" width="20">
                        {{$param->direccion}}</a>
                    </li>


                    <li>
                        <a href="#">
                            <img src="{{ asset('img/location.png') }}" class="img-fluid mr-1 img-footer" width="20">
                        Santa Marta</a>
                    </li>
                    <li>
                        <a href="{{ asset('about_us') }}">
                            <i class="fab fa-whatsapp light-gray mr-1" style="font-size: 1.4em;"></i>
                        Contáctanos</a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="footer_column">
                <div class="footer_title mayus">síguenos en</div>
                <ul class="footer_list d-inline-flex">

                    @foreach ($redes as $red)
                    <a  target="_blank" href="{{$red->url}}" class="" width="20">
                        <div class="social-icon mt-1 mr-2">
                            <i class="{{$red->icono}} img-fluid mr-1fa-2x white"></i>
                        </div>
                    </a>
                        @endforeach
                    </ul>
                </div>
                <div class="row no-gutters mt-2">
                    <div class="col">
                        <i class="fas fa-phone-alt mr-1"></i>
                        <a class="footer-text-color" href="tel:+57{{$param->numerocontacto}}">
                            {{$param->numerocontacto}}
                        </a>
                    </div>
                    <div class="col">
                        <i class="fas fa-phone-alt mr-1"></i>

                        <a class="footer-text-color" href="tel:+57{{$param->telefono}}">
                            {{$param->telefono}}
                        </a>
                    </div>

                </div>

            </div>
}
}
--}}


</div>

<div class="row text-center mt-3">
    <div class="col-lg-12">
        <div class="footer_column">
            <div class="body-text mayus light-gray">© materile 2019</div>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class="col-lg-12">
        <div class="footer_column">
            <div class="body-text mayus ">
                <a href="https://www.expertum.co" target="_blank" class="light-gray">
                    Plataforma E-Commerce desarrollada por EXPERTUM - Tecnología & Negocios
                </a>
            </div>
        </div>
    </div>
</div>
</div>
</footer>
