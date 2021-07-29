</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Khmer Invoice System 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
{{--            <div class="modal-body"></div>--}}
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeader">Update Product</h4>
                <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <span id="msgModal"></span>
                <form action="{{ route('product.update') }}" method="POST" >
                    @csrf

                    <div class="form-group">
                        <div class="row" style="margin-left:2px;margin-right: 2px">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" id="forAppend">
                        <div class="row" style="margin-left:2px;margin-right: 2px">
                            <label for="price" id="priceLabel">Price:</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                    </div>
                    <div id="btnAddAppend" class="mb-2"></div>
                    <div style="border-bottom: 1px solid #b9bbbe" class="mb-2" id="modal_border"></div>
                    <input type="hidden" name="product_id" id="product_id">
                    <button class="btn btn-primary" type="button" id="submit">Update</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('js/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Jquery UI -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>

<!-- Page level plugins -->
<script src="/css/datatables/jquery.dataTables.min.js"></script>
<script src="/css/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/datatables-demo.js"></script>

<!-- Generate table script -->
<script src="{{ asset('/js/create-table.js') }}"></script>

<!-- Edit Data through Modal with Ajax -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $(document).on('click','.edit', function () {
            $('#modal_border').remove();
            var product_id = $(this).attr('id');
            $.ajax({
                url:'/product/edit',
                method:'post',
                data:{product_id:product_id},
                dataType:'json',
                success:function (data) {
                    //console.log(data);
                    $('#name').val(data.Name);
                    $('#price').val(data.Price);
                    $('#product_id').val(data.id);
                    $('#productModal').modal('show');
                }
            });
        });

        $(document).on('click','#submit', function (e) {
            e.preventDefault();

            var name = $('#name').val();
            var price = $('#price').val();
            var product_id = $('#product_id').val();

            if (!name){
                alert('please input name');
                return false;
            }
            if (!price){
                alert('please input price');
                return false;
            }

            if (name && price){
                $.ajax({
                    url:'{{ route('product.update') }}',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        product_id:product_id,
                        name:name,
                        price:price
                    },
                    success: function (result) {
                        if (result.success == 1) {
                            var msg = '<div class="alert alert-success" role="alert">'+ result.message +'</div>';
                            $('#msgModal').html(msg);
                            $('#'+result.data.id+'').find('.name').text(result.data.name);
                            $('#'+result.data.id+'').find('.price').text(result.data.price);
                        }
                    }
                });
            }
        });

        $(document).on('click','.close-btn', function () {
            $('#msgModal').html('');
        })
    });
</script>

<!-- Auto complete script -->
<script src="{{ asset('js/auto-complete.js') }}"></script>

<!-- Date and confirm script -->
<script>
    $(document).ready(function () {

        var d = new Date();
        var year = d.getFullYear();
        var month = ("0"+(d.getMonth()+1)).slice(-2);
        var day = d.getDate();
        var dateString = year+'-'+month+'-'+day;
         // alert(dateString);
        $('#date').val(dateString);

        //to prevent form submitting when we hit on the key enter
        $('form').submit(function (e) {
            if ($(document.activeElement).attr('type') == 'submit')
                return true;
            else return false;
            e.preventDefault();
        });

        //verify deleting order list
        $(document).on('click','.delete_order',function () {
            // confirm('Are you sure to delete this purchase order!!!');
            var checkstr =  confirm('Are you sure to delete this purchase order?');
            if(checkstr == true){
                // delete processing are done
                return true;
            }else{
                return false;
            }
        })

    })
</script>

<script src="{{ asset('js/customerPhoneNumber.js') }}"></script>

<!-- Edit customer info with Modal -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // $('.phone span:last-child').remove();
        var i=0;

        $(document).on('click','.editCustomer', function (e) {
            e.preventDefault();

            var customer_id = $(this).attr('id');
            $('#modalHeader').text('Update Customer');
            $('#priceLabel').text('Phone Number :');
            $('#submit').attr('id','update');
            $('.close-btn').attr('class','close close-btn2');
            $('#product_id').attr('id','customer_id');
            $('#price').remove();
            var btnAdd = '<button class="btn btn-primary" type="button" id="btnAdd">+</button>';
            $('#btnAddAppend').append(btnAdd);
            // $('#price').attr({'id':'phoneNumber','class':'form-control phoneNumber','name':'phoneNumber'});

            $.ajax({
                url:'/customer/edit',
                method:'post',
                data:{customer_id:customer_id},
                dataType:'json',
                success:function (data) {
                    //console.log(data);
                    $('#customer_id').val(data.customer.id);
                    $('#name').val(data.customer.name);
                    $.each(data.phoneNumbers, function (index,val) {
                        var input = '<div class="row" id="ro--'+val.id+'" style="margin-left:2px;margin-right:2px">';
                            input += '<input type="text" name="phoneNumber[]" class="form-control mb-2 phoneNumber col-md-10" value="'+ val.phone_number +'">';
                            input += '<div class="col-md-2"><button class="btn btn-danger btnDelete" id="'+val.id+'">-</button></div>';
                            input += '</div>';
                            input += '<input type="hidden" id="'+val.id+'" name="phone_id[]" value="'+val.id+'">';
                        $('#forAppend').append(input);
                    });

                }
            });

        });

        $(document).on('click','#btnAdd', function(e) {
            e.preventDefault();

            var input = '<div class="row" id="ro-'+(++i)+'"  style="margin-left:2px;margin-right:2px">';
            input += '<input type="text" name="phoneNumber[]" class="form-control mb-2 phoneNumber col-md-10">';
            input += '<div class="col-md-2"><button class="btn btn-danger btnDelete" id="'+i+'">-</button></div>';
            input +='<input type="hidden" id="" name="phone_id[]">';
            input += '</div>';
            $('#forAppend').append(input);

        })

        $(document).on('click','.btnDelete', function (e) {
            e.preventDefault();
            var checkstr =  confirm('Are you sure to delete this phone number?');
            if(checkstr == true){
                var phoneID = $(this).attr('id');
                $.ajax({
                    url:'/phone_number/delete',
                    method:'post',
                    data:{phoneID:phoneID},
                    // dataType:'json',
                    // success:function (data) {
                    //     console.log(data);
                    // }
                });
                $('#ro--'+phoneID+'').remove();
                $('#row'+phoneID+'').remove();
                $('#ro-'+phoneID+'').remove();
                $('#'+phoneID+'').remove();
            }else{
                return false;
            }
        });

        $(document).on('click','.close-btn2', function () {
            $('#msgModal').html('');
            $('.phoneNumber').remove();
            $('.btnDelete').remove();
            $('#btnAddAppend').empty();
            $('#btnAdd').remove();
            $('#forAppend div:not(:first-child)').remove();
            $('#forAppend input').remove();

        })

        $(document).on('click','#update', function (e) {
            e.preventDefault();

            var customer_id = $('#customer_id').val();
            var phone_id=$("input[name='phone_id[]']")
                .map(function () {
                    return $(this).val();
                }).get();
            var customer_name = $('#name').val();
            var phone_number = $("input[name='phoneNumber[]']")
                .map(function () {
                    return $(this).val();
                }).get();

            if (!customer_name){
                alert('please input name');
                return false;
            }
            for(var i=0; i<phone_number.length; i++){
                if (!phone_number[i]){
                    alert('please input phone number');
                }
            }

            if (customer_name){
                $.ajax({
                    url:'/customer/update',
                    method:'post',
                    data:{
                        phone_id:phone_id,
                        customer_id:customer_id,
                        customer_name:customer_name,
                        phone_number:phone_number
                    },
                    dataType:'json',
                    success:function (result) {
                        if (result.success == 1) {
                            var msg = '<div class="alert alert-success" role="alert">'+ result.message +'</div>';
                            $('#msgModal').html(msg);
                            $('#'+result.data.id+'').find('.customer_name').text(result.data.name);
                            $('#phone'+result.data.id+' div').remove();
                            $.each(result.phone, function (index,val) {
                                var div = '<div id="row'+val.id+'">'+val.phone_number+'</div>';
                                $('#phone'+result.data.id+'').append(div);
                            })
                        }
                    }
                });
            }

        })
    });
</script>

<!-- CDN Select2 script -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<!-- Search with select script -->
<script>
    $(document).ready(function() {
        $('.js-example-basic').select2();
    });
</script>
<!-- Date Picker Script -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--Date picker api script--}}
<script>
    $(document).ready(function () {

            $('input[name="filter_date_range"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="filter_date_range"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + '-' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="filter_date_range"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

    });
</script>

<script src="{{ asset('js/report.js') }}"></script>

</body>

</html>
