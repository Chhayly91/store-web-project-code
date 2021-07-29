<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Invoice System</title>

    <!-- CDN Select2 style -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Date picker style-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- JQuery UI Styles -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">

    <!-- Custom styles for this page -->
    <link href="/css/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style rel="stylesheet">
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Invoice System</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Order -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Order</span>
            </a>
            <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{--                    <h6 class="collapse-header">Custom Components:</h6>--}}
                    <a class="collapse-item" href="{{ route('order.create') }}">Create</a>
                    <a class="collapse-item" href="{{ route('order.list') }}">List</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fab fa-product-hunt"></i>
                <span>Product</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/product/create') }}">Create</a>
                    <a class="collapse-item" href="{{ url('/product/list') }}">List All</a>
                </div>
            </div>
        </li>

        <!-- Nav Item Customer -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-user"></i>
                <span>Customer</span>
            </a>
            <div id="collapseCustomer" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    {{--                    <h6 class="collapse-header">Custom Components:</h6>--}}
                    <a class="collapse-item" href="{{ route('customer.create') }}">Create</a>
                    <a class="collapse-item" href="{{ route('customer.list') }}">List All</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Report -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('report.create') }}" aria-expanded="true" aria-controls="collapseTwo">
                <i class="far fa-clipboard"></i>
                <span>Report</span>
            </a>
            {{--            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
            {{--                <div class="bg-white py-2 collapse-inner rounded">--}}
            {{--                    --}}{{--                    <h6 class="collapse-header">Custom Components:</h6>--}}
            {{--                    <a class="collapse-item" href="{{ url('/invoice/create') }}">Create</a>--}}
            {{--                    --}}{{--                    <a class="collapse-item" href="#"></a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
{{--                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-primary" type="button">--}}
{{--                                <i class="fas fa-search fa-sm"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-3 d-none d-lg-inline text-gray-600 -medium">{{ Auth::user()->name }}</span>
                            <span class="text-primary"><i class="fas fa-user" style="font-size: 1.7em"></i></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
