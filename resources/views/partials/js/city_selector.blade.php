<script>
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

</script>


<script>
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:"GET",
                url:"{{url('api/get-city-list')}}?state_id="+stateID,
                beforeSend: function() {

                  $('#city').prop('disabled', 'disabled');
              },
              success:function(res){


                if(res){


                    $('#city').prop('disabled', false);

                    $("#city").empty();
                    $("#city").append('<option disabled selected>Seleccione una opción</option>');
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
            var qty= $('#qty').val();
            var id= $('#id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            data = new FormData();
            data.append('state', state);
            data.append('city', city);
            data.append('qty', qty);
            data.append('id', id);
            e.preventDefault();
            $.ajax({
                url: "{{ route('select_city') }}",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                type: 'POST',

                success: function(response) {
                    $('#modalCiudadesSelector').modal('hide');
                    window.location.reload();
                    toastr.success('Ciudad seleccionada')
                    toastr.success('Producto añadito al carrito')
                },
                error: function(response) {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    toast({
                        type: 'error',
                        title: 'Error inesperado.'
                    })
                    ;
                }
            });
        });
    });
</script>
