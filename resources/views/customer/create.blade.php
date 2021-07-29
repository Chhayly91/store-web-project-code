@extends('layouts.master')
@section('content')


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Create Customer</h1>

                <!-- forms -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('customer.create') }}" method="post" class="row">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="customer_name" class="">Customer Name</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name">

                                @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone" class="">Phone</label>
                                <input type="text" class="form-control" name="phone[]">
                                <span id="phone"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary" style="margin-top: 30px" id="addPhone">+</button>
                                <button type="button" class="btn btn-danger" style="margin-top: 30px" id="deletePhone">-</button>
                            </div>

                            <button type="submit" class="btn btn-primary" name="save" style="height: 38px; margin-top: 15px;margin-left: 10px">Save</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection
