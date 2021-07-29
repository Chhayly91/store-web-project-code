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
            <div>Inv-No :</div>
        </div>
        <div class="grid-item2"><h4>INVOICE</h4></div>
        <div class="grid-item3">
            <div>Tel: 012 211 407</div>
            <div>010 771 632</div>
            <div>Date: {{ date("d-M-Y") }}</div>
        </div>
    </header>

    <main>
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Inv_ID</th>
                <th>Customer_Name</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0?>
            @foreach($reports as $report)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $id = "INV-".str_pad($report->id, 5, "0", STR_PAD_LEFT) }}</td>
                    <td>{{ $report->customer_name }}</td>
                    <td class="total">{{ $report->grand_total }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3">Grand Total</th>
                <th id="sum"></th>

            </tr>
            </tfoot>
        </table>
    </main>

    <footer class="footer">

    </footer>
    <script type="text/javascript">
        function sum() {
            var grand_total = 0;
            var total = document.getElementsByClassName('total');
            for(var i=0; i< total.length; i++){
                var sum_all = parseFloat(total[i].innerHTML);
                grand_total += sum_all;
            }
            document.getElementById('sum').innerHTML = grand_total;

        }

        window.onload = sum;
    </script>
</body>
</html>

