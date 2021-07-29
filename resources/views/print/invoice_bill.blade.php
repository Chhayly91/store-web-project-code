<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invoice Bill</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--    <link href="https://fonts.googleapis.com/css?family=Varela&display=swap" rel="stylesheet">--}}
    <style>
        *{
            font-family: 'Varela', sans-serif;
        }

        table,h2,span{

            -webkit-transform: scaleY(0.94);
            transform: scaleY(0.94);
            border-collapse: collapse;
            width: 100%;
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

        .page-break {
            page-break-after: always;
        }
        .header{
            width: 100%;
            box-sizing: border-box;
            font-size: 13px;
        }
        .header::after {
            content: "";
            clear: both;
            display: table;
        }
        .header .grid-item1{
            width: 33%;
            float: left;
        }
        .header .grid-item2{
            width: 33%;
            float: left;
            text-align: center;
            font-size: 16px;
        }
        .header .grid-item3{
            width: 33%;
            float: left;
            text-align: right;
        }
        .footer{
            margin-top: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .footer::before {
            content: "";
            clear: both;
            display: table;
        }
        .footer .col-1 {
            width: 50%;
            float: left;
        }
        .footer .col-2 {
            width: 50%;
            float: left;
            text-align: right;
        }
        /*.header .right{*/
        /*    position: absolute;*/
        /*    right: 0px;*/
        /*}*/
        /*.header div{*/
        /*    display: inline-block;*/
        /*}*/


    </style>
</head>
<body>

    <header class="header">
        <div class="grid-item1">
            <div>Phsar DermKor, Phnom Penh</div>
            <div>Inv-No : {{ $id = "INV-".str_pad($show->id, 5, "0", STR_PAD_LEFT) }}</div>
        </div>
        <div class="grid-item2"><h4>INVOICE</h4></div>
        <div class="grid-item3">
            <div>Tel: 012 211 407</div>
            <div>010 771 632</div>
            <div>Date: {{ date("d-M-Y", strtotime($show->created_at)) }}</div>
        </div>
    </header>

    <main>
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
    </main>

    <footer class="footer">
        <div class="col-1">
            <div style="margin-bottom: 5px">The Buyer</div>
            <div><strong>{{ $show->customer_name }}</strong></div>
        </div>
        <div class="col-2">The Seller</div>
    </footer>
</body>
</html>

