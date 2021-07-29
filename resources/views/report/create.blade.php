@extends('layouts.master')
@section('content')


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Report</h1>

                <!-- forms -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('report.print') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Select Customer:</label>
                                        <select class="js-example-basic form-control" name="filter_customer_name" id="filter_customer_name">
                                            <option selected hidden>-- Select Custom Name --</option>
                                            <option value="1">All</option>
                                            <option value="">No-Name</option>
                                            @foreach($uniques as $unique)
                                                @if($unique !=null)
                                                    <option value="{{ $unique }}">{{ $unique }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Payment:</label>
                                        <select class="form-control" name="filter_payment" id="filter_payment">
                                            <option selected hidden value="">-- Select Payment Status --</option>
                                            <option value="">All</option>
                                            <option value="1">Paid</option>
                                            <option value="2">None Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pick Up Date Range:</label>
                                        <input class="form-control" type="text" name="filter_date_range" id="filter_date_range" value="" placeholder="--- select date range ---">
                                    </div>
                                    <button type="button" class="btn btn-success" id="filter_btn">Filter</button>
                                    <button type="submit" class="btn btn-secondary" id="print_filter" style="display: none">Print Preview</button>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive mt-3" id="main_table">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

@endsection
