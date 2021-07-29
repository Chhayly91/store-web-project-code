
$(document).ready(function () {
    var i = $('.invoice-item td:first-child').length;
    $("#add").on('click', function () {
        var productID = $('#productID').val();
        var product_name = $("#product_name").val();
        var qty = $("#qty").val();
        var price = $("#price").val();
        var total = parseFloat(qty) * parseFloat(price);
        i++;

        var table = '<tr class="invoice-item">';
        table += '<td>'+i+'</td>';
        table +='<input type="hidden" name="addnew[]" class="form-control addnew">';
        table +='<input type="hidden" name="productID[]" value="'+productID+'" class="form-control productID">';
        table +='<td><input type="text" name="product_name[]" value="'+product_name+'" class="form-control product_name" required autofocus></td>';
        table +='<td><input type="text" name="price[]" value="'+price+'" class="form-control price" required></td>';
        table +='<td><input type="text" name="qty[]" value="'+qty+'" class="form-control qty" required></td>';
        table +='<td><input type="text" name="total[]" class="form-control total" readonly value="'+total.toFixed(2)+'"></td>';
        table +='<td class="text-center"><div class=\"btn btn-danger btn-circle del  \"><i class="fas fa-trash"></i></div></td>';
        table +='</tr>';
        $("tbody").append(table);
        grandTotal();// call grand total function


        //clear form after append table
        $('#productID').val('');
        $("#product_name").val('');
        $("#price").val('');
        $("#qty").val('');
    });

    $('#table').on('click', '.del',function () {
        var total = $(this).closest('.invoice-item').find('.total').val();
        var grand_total = $('#grand-total').val() - total;
        $('#grand-total').val(grand_total);
        //$(this).closest("tr").remove();
        //delete item from database
        var item_id = $(this).attr('id');
        var checkstr =  confirm('Are you sure to delete this item?');
        if(checkstr == true){
            // delete processing are done
            $.ajax({
                url:'/order/delete_item',
                type:'post',
                data:{item_id:item_id},
                dataType:'json',
                success:function (result) {
                    console.log(result.msg);
                }
            });

            $(this).closest("tr").remove();
        }else{
            return false;
        }
    });

    //method 1 use like this $(document).on('change','.price,.qty',function(){})
    //method 2 use like this $('#table').on('change','.price,.qty',function(){})
    $(document).on('change','.price, .qty', function () {
        var invoice_item = $(this).closest('.invoice-item');
        var product_price = invoice_item.find('.price').val();
        var product_qty = invoice_item.find('.qty').val();
        var product_total = parseFloat(product_price) * parseFloat(product_qty);
        invoice_item.find('.total').val(product_total.toFixed(2));
        grandTotal();
    }).trigger('change');

    function grandTotal() {
        var grand_total = 0;
        $.each($('.total'), function() {
            var total = parseFloat($(this).val());
            grand_total += total;
        });
        return $('#grand-total').val(grand_total);
    }


});

