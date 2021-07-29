@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Create new Receipt</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="" action="{{ route('order.processUpdate') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-2 pr-1 pl-0">
                    <div class="card shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="form-group col-md-5 mr-1">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" name="date" value="{{ date("Y-m-d", strtotime($invoice->created_at)) }}">
                                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="hidden" id="customer_id" name="customer_id" value="{{ $invoice->customerID }}">
                                    <label for="customer">Customer:</label>
                                    <input type="text" class="form-control" id="customer" name="customer_name" value="{{ $invoice->customer_name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2 pr-1 pl-0">
                    <div class="card shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="form-group col-md-5 mr-1">
                                    <label for="date">Payment Status:</label>
                                    <select name="payment_status" class="form-control">
                                        @if($invoice->payment_status == 1)
                                            <option value="1">Paid</option>
                                            <option value="2">Not yet Paid</option>
                                        @elseif($invoice->payment_status ==2)
                                            <option value="2">Not yet Paid</option>
                                            <option value="1">paid</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card shadow h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">

                            <input type="hidden" class="form-control" id="productID">

                            <div class="form-group pr-3 col-md-3">
                                <label for="product_name" class="mr-2">Product Name</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Fill up by id or name">
                            </div>

                            <div class="form-group pr-3 col-md-3">
                                <label for="price" class="mr-2">Price</label>
                                <input type="text" class="form-control" id="price">
                            </div>

                            <div class="form-group pr-3 col-md-3">
                                <label for="qty" class="mr-2">QTY</label>
                                <input type="text" class="form-control" id="qty">
                            </div>
                            <button type="button" class="btn btn-primary" id="add" style="margin-top: 14px">Add</button>
                            <div class="table-responsive">
                                <table class="table table-bordered mt-4" id="table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0?>
                                    @foreach($invoice->items as $item)
                                        <tr class="invoice-item">
                                            <td>{{ ++$i }}</td>
                                            <input type="hidden" name="addnew[]" value="1" class="form-control productID">
                                            <input type="hidden" name="productID[]" value="{{ $item->productID }}" class="form-control productID">
                                            <td><input type="text" name="product_name[]" value="{{ $item->name }}" class="form-control product_name" required></td>
                                            <td><input type="text" name="price[]" value="{{ $item->price }}" class="form-control price" required></td>
                                            <td><input type="text" name="qty[]" value="{{ $item->qty }}" class="form-control qty" required></td>
                                            <td><input type="text" name="total[]" value="{{ $item->total }}" class="form-control total"></td>
                                            <td class="text-center">
                                                <div class="btn btn-danger btn-circle del" id="{{ $item->id }}"><i class="fas fa-trash"></i></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Grand Total</th>
                                        <th>
                                            <input type="text" name="grand_total" class="form-control" id="grand-total" value="{{ $invoice->grand_total }}">
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <!-- /.container-fluid -->
@endsection


