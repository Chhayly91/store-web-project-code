<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
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
            width: 60%;
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
        #tfoot:first-child{
            text-align: right;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        @media print {
            *{
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
            }

            table{
                width: 100%;
                font-size: 18pt;
            }
            #hidePrint {
                display: none;
            }
            #sum{
                color: red;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <button type="button" onclick="window.print()" id="hidePrint" class="print">Print now</button>
    <h2 style="margin-top: 1em; padding-bottom: 0.4em">Total Report <h5>on <span id="currentDate"></span></h5></h2>
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
        <tr>
            <th colspan="3" id="tfoot">Grand Total</th>
            <th id="sum"></th>
        </tr>

    </table>
</div>
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

    //create current date
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = dd + '/' + mm + '/' + yyyy;
    document.getElementById("currentDate").innerHTML = today;
</script>
</body>
</html>
