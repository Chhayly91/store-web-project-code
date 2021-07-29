@extends('layouts.master')
@section('content')


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Create new Product</h1>

                <!-- forms -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('product.create') }}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="product_name" class="">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name">

                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price" class="">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price">

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary col-md-2" name="save" style="height: 38px; margin-top: 30px">Save</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection
