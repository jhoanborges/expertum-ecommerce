@if( ! $sliders->isEmpty() )
{{--@if(!$sliders==null || !empty($sliders) )--}}
     <div class="rev_slider_wrapper">
 
            <!-- the ID here will be used in the JavaScript below to initialize the slider -->
            <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.5">
                <!-- BEGIN SLIDES LIST -->
        <ul id="slider-content">
                    <!-- MINIMUM SLIDE STRUCTURE -->
                              <!-- SLIDE 1 -->

   @foreach ($sliders as $slide)
  
                  <li data-transition="boxfade" data-link="{{$slide->link}}" data-target="_blank" data-slideindex="back">
 
                        <img src="{{$slide->url}}" alt="{{$slide->url}}" class="rev-slidebg">

         <div class="tp-caption fadeout"
         data-frames='[{"delay":0,"speed":1500,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1500,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="10"
                          data-y="10"
                          data-speed="500"
                          data-start="1200"
                          data-easing="Circ.easeInOut"
                          style=" font-size:70px; font-weight:800; color:#fe0100;">{{$slide->name}}<span style=" color:#000;"></span> 

          </div>


                      <!-- LAYER NR. 2 -->
            <div class="tp-caption black_thin_blackbg_30 customin ltl tp-resizeme"

              data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"x:right;skX:-85px;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":2000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="100"
                          data-y="100" 
                          data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                          data-speed="1500"
                          data-start="1000"
                          data-easing="Power4.easeInOut"
                          data-splitin="none"
                          data-splitout="none"
                          data-elementdelay="0.01"
                          data-endelementdelay="0.1"
                          data-endspeed="1000"
                          data-endeasing="Power4.easeIn"
                          style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap; color:#34bcec; font-size:18px; font-weight:500;">{{$slide->descripcion}} </div>
            
            <!-- LAYER NR. 4 -->
             @if(!empty($slide->button))
            <div class="tp-caption lfb ltb start tp-resizeme"

            data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                          data-x="200"
                          data-y="200"
                          data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                          data-speed="1500"
                          data-start="1600"
                          data-easing="Power3.easeInOut"
                          data-splitin="none"
                          data-splitout="none"
                          data-elementdelay="0.01"
                          data-endelementdelay="0.1"
                          data-linktoslide="next"
                          style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;"><a href='{{$slide->link}}' class='largebtn solid'>{{$slide->button}}</a> </div>
@endif

                    </li>
                    @endforeach

                 
 
                </ul><!-- END SLIDES LIST -->
 
            </div><!-- END SLIDER CONTAINER -->
 
        </div><!-- END SLIDER CONTAINER WRAPPER-->

           @endif