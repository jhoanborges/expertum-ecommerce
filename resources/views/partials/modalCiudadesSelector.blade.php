<div id="modalCiudadesSelector" class="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <form id="city-form" method="post" accept-charset="utf-8" class="">

        <div class="modal-body pb-0">

           <input type="hidden" id="hidden" name="hidden" value="">
           <input type="hidden" name="id" value="" id="id">
           <div class="row">
            <div class="col-sm-8">
               <div class="row mb-3">

                <div class="col-sm-12">
                    <h5 class="modal-title">Enviamos pedidos a estas ciudades</h5>

                    <label class="required body-text">Seleccionar la ciudad de destino</label>
                    <select name="state" id="state" class="input-text select2departamento" required>
                        <option value="">Seleccionar de la lista</option>
                        @foreach($departamentos as $dep)
                        <option value="{{$dep->id}}">{{$dep->region}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-12">
                    <select name="city" id="city" class="input-text select2ciu" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4 h-100">
            <div class="row justify-content-center align-self-center">
                <img src="{{ asset('img/ciudad.png') }}" class="img-fluid">
            </div>
        </div>

    </div>
</div>


<div class="modal-footer justify-content-start">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-plane-departure mr-2"></i>
    Guardar</button>
</div>
</form>

</div>
</div>
</div>
