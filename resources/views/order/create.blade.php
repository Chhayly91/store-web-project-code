@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Create New Purchase Order</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="" action="{{ route('order.create') }}" method="POST">
            @csrf
            <div class="row">

                <div class="col-md-6 mb-2 pr-1 pl-0">
                    <div class="card shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="form-group col-md-5 mr-1">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="hidden" id="customer_id" name="customer_id">
                                    <label for="customer">Customer:</label>
                                    <input type="text" class="form-control" id="customer" name="customer_name">
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
                                        <option value="1">paid</option>
                                        <option value="2">Note yet paid</option>
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
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Grand Total</th>
                                        <th>
                                            <input type="text" name="grand_total" class="form-control" id="grand-total" value="0">
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <!-- /.container-fluid -->
@endsection


