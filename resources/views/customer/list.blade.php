@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">All Customers</h1>

        <!-- table -->
        <div class="card shadow mb-4">
            {{--                    <div class="card-header py-3">--}}
            {{--                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>--}}
            {{--                    </div>--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th class="text-center">
                                <span>Phone Number</span>
                            </th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0?>
                        @foreach($customers as $customer)
                            <tr id="{{ $customer->id }}">
                                <td>{{ ++$i }}</td>
                                <td class="customer_name">{{ $customer->name }}</td>
                                <td class="phone text-center" id="phone{{ $customer->id }}">
                                    @foreach($customer->phoneNumbers as $phoneNumber)
                                        <div id="row{{ $phoneNumber->id }}">{{ $phoneNumber->phone_number }}</div>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle"> <button type="button" class="btn btn-primary btn-circle editCustomer" data-toggle="modal" data-target="#productModal" data-backdrop="static" data-keyboard="false" id="{{ $customer->id }}"><i class="fas fa-edit"></i></button> | <a href="{{ route('customer.delete', $customer->id) }}" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
