$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#product_name').autocomplete({
        source : '/product/search',
        select :function (event, ui) {
            event.preventDefault();
            $('#productID').val(ui.item.id);
            $('#product_name').val(ui.item.value);
            $('#price').val(ui.item.price);
        }
    });

    $('#customer').autocomplete({
        source : '/order/search',
        select :function (event, ui) {
            event.preventDefault();
            $('#customer_id').val(ui.item.id);
            $('#customer').val(ui.item.value);
        }
    });

});
