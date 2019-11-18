jQuery(document).ready(function(){
    $('.qtyplus').click(function(e){
        e.preventDefault();
        id = $(this).attr('data-id');
        var currentVal = parseInt($('#'+id).val());
        if (!isNaN(currentVal)) {
            // Increment
            $('#'+id).val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('#'+id).val(0);
        }
    });

    $(".qtyminus").click(function(e) {
        e.preventDefault();
        id = $(this).attr('data-id');
        var currentVal = parseInt($('#'+id).val());
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('#'+id).val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('#'+id).val(1);
        }
    });
});





