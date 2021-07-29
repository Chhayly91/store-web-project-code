@extends('layouts.master')
@section('content')

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h3 class="h4 mb-4 text-gray-800">Dashboard</h3>

                <!-- table -->
                <div class="card shadow mb-4">
                    {{--                    <div class="card-header py-3">--}}
                    {{--                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>--}}
                    {{--                    </div>--}}
                    <div class="card-body">
                        <!-- Content Row -->
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div><a class="font-weight-bold text-primary mb-1 text-uppercase" href="{{ route('order.create') }}" style="font-size: 0.8em">Make Order</a></div>
                                                <div><a class="mb-0 font-weight-bold text-primary text-uppercase" href="{{ route('order.list') }}" style="font-size: 0.8em">Manage Order</a></div>
                                            </div>
                                            <div class="col-auto">
{{--                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>--}}
                                                <i class="fa fa-shopping-cart fa-2x text-gray-300"  aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div><a class="font-weight-bold text-success mb-1 text-uppercase" href="{{ route('product.create') }}" style="font-size: 0.8em">Create Product</a></div>
                                                <div><a class="mb-0 font-weight-bold text-success text-uppercase" href="{{ route('product.list') }}" style="font-size: 0.8em">Manage Product</a></div>
                                            </div>
                                            <div class="col-auto">
{{--                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>--}}
                                                <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div><a class="font-weight-bold text-warning mb-1 text-uppercase" href="{{ route('customer.create') }}" style="font-size: 0.8em">create customer</a></div>
                                                <div><a class="mb-0 font-weight-bold text-warning text-uppercase" href="{{ route('customer.list') }}" style="font-size: 0.8em">Manage customer</a></div>
                                            </div>
                                            <div class="col-auto">
{{--                                                <i class="fas fa-comments fa-2x text-gray-300"></i>--}}
                                                <i class="fas fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"></div>
                                                <div class="row no-gutters align-items-center">
                                                    <a class="font-weight-bold text-info mb-1 text-uppercase" href="{{ route('report.create') }}" style="font-size: 0.8em">create report</a>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->


@endsection
