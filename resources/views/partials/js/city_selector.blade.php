<script>

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "10000",
    "hideDuration": "1000",
    "timeOut": "10000",
    "extendedTimeOut": "0",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }


  $('#modalCiudadesSelector').on('show.bs.modal', function (event) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'post',
      url: "{{ route('sql_session') }}",
      dataType : 'json',
      success:function(res){
        if (res) {
          $('#modalCiudadesSelector').find('.modal-body #state').val(res.departamento.id).trigger('change')
          $('#modalCiudadesSelector').find('.modal-body #hidden').val(res.ciudad.id).trigger('change')
        }
      },
      error: function() {

      }
    })
  })

  $('#state').on('change',function(){
    var stateID = $(this).val();
    if(stateID){
      $.ajax({
        type:"GET",
        url:"{{url('api/get-city-list')}}?state_id="+stateID,
        beforeSend: function() {

          $('#city').prop('disabled', true);
        },
        success:function(res){


          if(res){


            $('#city').prop('disabled', false);

            $("#city").empty();
            $("#city").append('<option disabled selected value="">Seleccione una opción</option>');
            $.each(res,function(key,value){
              $("#city").append('<option value="'+value+'">'+key+'</option>');
            });
            if (  $('#hidden').val() ) {
              $('#modalCiudadesSelector').find('.modal-body #city').val(  $('#hidden').val() ).trigger('change')
            }

          }else{
            $('#city').prop('disabled', false);

            $("#city").empty();
          }
        }
      });
    }else{
      $('#city').prop('disabled', false);

      $("#city").empty();
    }

  });


  $(function() {
    $('#city-form').on('submit', function(e) {
      var state= $('#city-form').find('#state').val();
      var city= $('#city-form').find('#city').val();
      var qty= $('.qty').val();
      var id= $('#id').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      data = new FormData();
      data.append('state', state);
      data.append('city', city);

      if (qty ) {
        console.log(qty)
        data.append('qty', qty);
      }
      if(id){
        data.append('id', id);
        console.log(id)
      }

      e.preventDefault();

      $.ajax({
        url: "{{ route('select_city') }}",
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        type: 'POST',

        success: function(response) {
                    //window.location.reload();
                    $('#modalCiudadesSelector').modal('hide');
                    $(".modal-backdrop").hide();
                    toastr["success"]("Ciudad seleccionada")

                    //
                    //console.log(!response.selected_from_home)
                    if (!response.selected_from_home) {
                      toastr["success"]("Producto añadito al carrito")
                      setTimeout(function(){
                        window.location.reload();
                      }, 2000);
                    }
                    return false
                  },
                  error: function(response) {
 //console.log(response.responseJSON)
 console.log(Object.entries(response.responseJSON.errors));

 let result = Object.entries(response.responseJSON.errors).map(function(item, index) {
  toastr["info"](item[1][0])
  // returns the new value instead of item
});

}
});
    });
  });
</script>
