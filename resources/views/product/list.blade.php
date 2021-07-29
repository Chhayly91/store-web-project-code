@extends('layouts.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">All Product</h1>

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
                            <th>Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0?>
                        @foreach($products as $product)
                            <tr id="{{ $product->id }}">
                                <td>{{ ++$i }}</td>
                                <td class="name">{{ $product->Name }}</td>
                                <td class="price">{{ $product->Price }}</td>
                                <td class="text-center"> <button type="button" class="btn btn-primary btn-circle edit" data-toggle="modal" data-target="#productModal" data-backdrop="static" data-keyboard="false" id="{{ $product->id }}"><i class="fas fa-edit"></i></button> | <a href="{{ route('product.delete',$product->id) }}" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
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
