@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">All Order</h1>

        <!-- table -->
        <div class="card shadow mb-4">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{--                    <div class="card-header py-3">--}}
            {{--                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>--}}
            {{--                    </div>--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Inv Name</th>
                            <th>Customer Name</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0?>
                        @foreach($orders as $order)
                            <tr id="{{ $order->id }}">
                                <td><?php echo(++$i)?></td>
                                <td class="">{{ $id = "INV-".str_pad($order->id, 5, "0", STR_PAD_LEFT) }}</td>
                                <td class="">{{ $order->customer_name }}</td>
                                <td class="">
                                    @if($order->payment_status == 1)
                                        <span>Paid</span>

                                    @elseif($order->payment_status ==2)
                                            <span>None</span>
                                    @endif
                                </td>
                                <td>{{ date("d-M-Y", strtotime($order->created_at)) }}</td>
                                <td>{{ $order->grand_total }}</td>
                                <td class="text-center">
                                    <a href="{{ route('order.update',$order->id) }}" class="btn btn-primary btn-circle edit"><i class="fas fa-edit"></i></a> |
                                    <a href="{{ route('order.delete',$order->id) }}" class="btn btn-danger btn-circle delete_order"><i class="fas fa-trash"></i></a> |
                                    <a href="{{ route('order.view',$order->id) }}" class="btn btn-success btn-circle"><i class="far fa-eye"></i></a> |
                                    <a href="{{ route('order.print',$order->id) }}" class="btn btn-secondary btn-circle"><i class="fas fa-print"></i></a>
                                </td>
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
