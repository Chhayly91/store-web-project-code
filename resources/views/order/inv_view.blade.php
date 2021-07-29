<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice Bill</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Varela&display=swap" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        *{
            font-family: 'Varela', sans-serif;
        }
        .container{
            width: 62.5em;
            margin: 0 auto;
        }

        table{

            /*-webkit-transform: scaleY(0.94);*/
            /*transform: scaleY(0.94);*/
            border-collapse: collapse;
            width: 100%;
            font-size: 1.05em;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        thead th{
            background-color: #f2f2f2;
            padding-top: 12px;
            padding-bottom: 12px;
        }
        tfoot th:first-child{
            text-align: right;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

    </style>
</head>
<body>

<div class="container">
    <h2 style="margin-top: 1em;border-bottom: 1px solid #ddd; padding-bottom: 0.4em">Invoice Table</h2>
    <a href="javascript: history.go(-1)" class="btn btn-outline-success mb-2"><i class="fas fa-arrow-left"></i></a>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0?>
        @foreach($show->items as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4">Grand Total</th>
            <th>{{ $show->grand_total }}</th>
        </tr>
        </tfoot>
    </table>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
