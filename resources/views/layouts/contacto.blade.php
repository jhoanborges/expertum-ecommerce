@extends('welcome')

@section('content')

<div class="container mb-3 border-bottom">
    <div class="row">
      <div class="col-lg-12">
        <div class="big-title mayus mb-4 store_title "><b>CONTÁCTANOS</b> </div>
    </div>
</div>


<form class="mb-5" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="row">
        <div class="col-md-6">

            <p class="bold black mb-2 title-text">Tu opinión cuenta</p>
            <p>Dudas, inquietudes, solicitudes y sugerencias, te invitamos a contárnoslas a través de nuestras líneas de contacto. Te brindaremos toda la información, asesoría, soporte cotizaciones y demostraciones de nuestros productos y servicios</p>

            <div class="form-group">
             <ul>
                <li class="mb-2 centered-li">
                    <img src="{{ asset('img/location.png') }}" class="img-fluid mr-1 img-footer" width="25">
                    <a href="#" class="black">
                    Cra. 26 # 65-54 Of. 401 · Bogotá, D.C.</a>
                </li>
                <li class="mb-2 centered-li">
                    <i class="fab fa-whatsapp light-gray mr-1" style="font-size: 1.4em;"></i>
                    <a href="#" class="black">
                    (315) 690 0996</a>
                </li>
                <li class="mb-2 centered-li">
                    <i class="fas fa-phone light-gray mr-1" style="font-size: 1.2em;"></i>
                    <a href="#" class="black">
                    (300) 696 7118</a>
                </li>

                <li class="mb-2 centered-li">
                    <i class="far fa-envelope light-gray mr-1" style="font-size: 1.2em;"></i>                    
                    <a href="#" class="black">
                    info@expertum.co</a>
                </li>
            </ul>   
        </div>

        <div class="form-group">
            <p class="bold black mb-0 mt-4 title-text">Horario de atención</p>

            <ul>
                <li class="mb-2 centered-li">
                    <i class="far fa-clock light-gray mr-1" style="font-size: 1.4em;"></i>

                    <a href="#" class="black">
                    8:00 am a 6:00pm · Lunes · Viernes</a>
                </li>
                <li class="mb-2 centered-li">
                    <i class="far fa-clock light-gray mr-1" style="font-size: 1.4em;"></i>
                    <a href="#" class="black">
                    10:00am a 4:00pm · Domingo : Festivos </a>
                </li>
            </ul>   
        </div>


    </div>


    <div class="col-md-6">


        <p class="bold black mb-0 title-text">Preguntas y sugerencias</p>


        <div class="form-group mt-2">
            <label class="required bold black">Nombre y Apellido</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="required bold black">Correo electrónico</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="required bold black">Mensaje:</label>
            <textarea rows="4" id="message" class="form-control @error('message') is-invalid @enderror" name="message" required></textarea>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary w-25">
            Enviar</button>
            </div>


        </div>

    </div>


</form>


</div>

@include('partials.newsletter')


@endsection
