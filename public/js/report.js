$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
$(document).ready(function () {
   $('#filter_btn').on('click',function () {
       $('#print_filter').css('display','inline');
       $('#main_table').empty();
       var table='<table class="table table-bordered" width="100%" cellspacing="0" id="dataTable">\n' +
           '            <thead>\n' +
           '            <tr>\n' +
           '                <th>No</th>\n' +
           '                <th>Inv Name</th>\n' +
           '                <th>Customer Name</th>\n' +
           '                <th>Payment Status</th>\n' +
           '                <th>Date</th>\n' +
           '                <th>Total</th>\n' +
           '                <th class="text-center">Action</th>\n' +
           '            </tr>\n' +
           '            </thead>\n' +
           '            <tbody id="filter_table">\n' +
           '            <tfoot>\n' +
           '                 <tr>\n' +
           '                     <th colspan="5" class="text-right">Grand Total</th>\n' +
           '                     <th id="filter_grand_total">0</th>\n' +
           '                 </tr>'+
           '            </tbody>\n' +
           '      </table>';
       $('#main_table').append(table);
       $('#filter_table').empty();
        var filter_customer_name = $('#filter_customer_name').val();
        var filter_payment = $('#filter_payment').val();
        var filter_date_range = $('#filter_date_range').val();
        var i = $('.filter_id td:first-child').length;
        var inv = 'INV-';

        $.ajax({
           url:'/report/create',
           type:'post',
           data:{
               filter_customer_name:filter_customer_name,
               filter_payment:filter_payment,
               filter_date_range:filter_date_range
           },
            dataType:'json',
            success:function ($result) {
               if ($result!=''){
                   var payment ='';
                   var emty = '';
                   $.each($result, function (index,val) {
                       // date = val.created_at.substring(0,10);
                       if (val.payment_status == 1){
                           payment = 'Paid';
                       }else {
                           payment = 'None';
                       }

                       if (val.customer_name == null){
                           emty = '';
                       }else emty = val.customer_name;
                       var tr = '<tr class="filter_id">';
                       tr += '<td>'+ (++i) +'</td>';
                       tr += '<td>'+"INV-"+("00000"+(val.id)).slice(-5)+'</td>';
                       tr += '<td>'+ emty +'</td>';
                       tr += '<td>'+ payment +'</td>';
                       tr += '<td>'+val.created_at.substring(0,10)+'</td>';
                       tr += '<td class="filter_total">'+ val.grand_total +'</td>';
                       tr += '<td class="text-center">\n' +
                           '     <a href="/order/list/view/'+val.id+'" class="btn btn-success btn-circle"><i class="far fa-eye"></i></a>\n' +
                           '     <a href="/order/list/print/'+val.id+'" class="btn btn-secondary btn-circle"><i class="fas fa-print"></i></a>\n' +
                           ' </td>';
                       tr += '</tr>';
                       $('#filter_table').append(tr);
                       sum();//call sum function

                   });
               }else {
                   var tr = '<tr><td colspan="7" class="text-center">No Data</td></tr>';
                   $('#filter_table').append(tr);

               }
            }
        });

   });

   // $('#print_filter').on('click',function () {
   //     alert('test');
   // }) ;

   function sum() {
       var grand_total = 0;
       $.each($('.filter_total'), function() {
           var total = parseFloat($(this).text());
           grand_total += total;
       });
       return $('#filter_grand_total').text(grand_total);
   }
});
