@if (!$sliders->isEmpty())
    {{-- @if (!$sliders == null || !empty($sliders)) --}}
    <div class="rev_slider_wrapper">

        <!-- the ID here will be used in the JavaScript below to initialize the slider -->
        <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.5">
            <!-- BEGIN SLIDES LIST -->
            <ul id="slider-content">
                <!-- MINIMUM SLIDE STRUCTURE -->
                <!-- SLIDE 1 -->

                @foreach ($sliders as $slide)
                    <li data-transition="boxfade" data-link="{{ $slide->link }}" data-target="" data-slideindex="back">

                        <img src="{{ $slide->image ?? asset('img/slider.png') }}" alt="{{ $slide->url }}"
                            class="rev-slidebg">

                        <div class="tp-caption fadeout"
                            data-frames='[{"delay":0,"speed":1500,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-x="{{ $slide->title_position_x }}" data-y="{{ $slide->title_position_y }}"
                            data-speed="500" data-start="1200" data-easing="Circ.easeInOut">
                            {!! $slide->name !!}

                        </div>


                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption black_thin_blackbg_30 customin ltl tp-resizeme"
                            data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"x:right;skX:-85px;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                            data-x="{{ $slide->description_position_x }}" data-y="{{ $slide->description_position_y }}"
                            data-speed="1500" data-start="1000" data-easing="Power4.easeInOut" data-splitin="none"
                            data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1"
                            data-endspeed="1000" data-endeasing="Power4.easeIn">{!! $slide->descripcion !!} </div>

                        <!-- LAYER NR. 4 -->
                        @if (!empty($slide->button))
                            <div class="tp-caption lfb ltb start tp-resizeme"
                                data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-x="{{ $slide->button_position_x }}" data-y="{{ $slide->button_position_y }}"
                                data-speed="1500" data-start="1600" data-easing="Power3.easeInOut" data-splitin="none"
                                data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.1"
                                data-linktoslide="next">
                                <a href='{{ $slide->link }}'
                                class='arrow-button '
                                target="{{$slide->open_in_new_window == true ? '_blank' : '_self'}}"
                                style="background-color: {{$slide->button_color}}"
                                >{!! $slide->button !!} </a>
                            </div>


                        @endif

                    </li>
                @endforeach



            </ul><!-- END SLIDES LIST -->

        </div><!-- END SLIDER CONTAINER -->

    </div><!-- END SLIDER CONTAINER WRAPPER-->

@endif
