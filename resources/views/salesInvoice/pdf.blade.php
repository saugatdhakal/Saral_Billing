<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saral Billing</title>
    <style type="text/css">
        .test {
            background: white;
            color: #000000;
            font-size: x-large;
            text-align: right;
            white-space: nowrap;
        }

        .test span {
            float: left;
            width: 5em;
            text-align: left;
        }

        table.stockTable {
            width: 100%;
            border-collapse: collapse;
        }

        table.stockTable th {
            border: 2px #000000;
            border-collapse: collapse;
            border-style: dashed dashed;
        }

        .table.stockTable td,
        .table.stockTable th {
            padding: 12px 15px;
            border: 2px #000000;
            border-collapse: collapse;
            border-style: dashed none;
            text-align: center;
            font-size: 16px;
        }

        .amount {
            margin-left: 930px;
            margin-top: 20px;
        }

        #words {
            margin-left: 150px;
        }
    </style>
</head>

<body>
    <div class="container">
        @php
        $names = strtoupper($config->name);
        @endphp
        <center>
            <p style="font-size:45px;font-weight:bold;margin-left:5%;margin-bottom:0%; padding:0%">{{$names}}
            </p>
            <p style="font-size:30px;margin:0%; padding:0%;">{{$config->address}}</p>
            <p style="font-size:22px; padding:0%;">Contact No : <span>{{$config->contact_number}}</span> ,
                Email : <span>{{$config->email}}</span></p>
            <p style="font-size:25px; font-weight:bold;margin:0%; padding:0%;">SALES DIRECT #
                {{$sale->invoice_number}}</p>
        </center>
        <p class="test"><span>Name : {{$sale->name}}</span>Bill Date : {{$sale->sales_date}}</p>
        <p class="test"><span>Address : {{$sale->home_address}}</span>Transaction Date : {{$sale->transaction_date}}</p>
        <p class="test"><span>Sales Type : {{$sale->sales_type}}</span>Printed By : {{Auth::user()->name}}</p>


        <hr style="border-style: dashed none;">
        <table class="table stockTable" width="100%">
            <thead>
                <tr>
                    <th width="5%">SN</th>
                    <th width="30%">Product Name</th>
                    <th>Batch No</th>
                    <th width="10%">Unit</th>
                    <th width="13%">Rate</th>
                    <th width="15%">Amount</th>
                    <th width="5%">Discount Amount</th>
                </tr>
            </thead>
            <tbody>
                @php $i=0 ; @endphp
                @foreach ($saleItem as $item)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->batch_number}}</td>
                    <td>{{$item->unit}}</td>
                    <td>{{$item->rate}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->discount_amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="amount">
            <table>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">SUB AMOUNT : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($sale->total_amount == 0)
                        0
                        @else
                        Rs. {{$sale->total_amount}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">DISCOUNT AMOUNT : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($sale->discount_amount == 0)
                        0
                        @else
                        Rs. {{$sale->discount_amount}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">ROUNDING : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($sale->rounding == 0)
                        0
                        @else
                        Rs. {{$sale->rounding}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="font-size:19px;font-weight:bold;">EXTRA CHARGE : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($sale->extra_charges == 0)
                        0
                        @else
                        Rs. {{$sale->extra_charges}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="font-size:19px;font-weight:bold;">NET AMOUNT : </td>
                    <td style="font-size:25px;font-weight:bold;">
                        @if ($sale->discount_amount == 0 && $sale->total_amount == 0)
                        0
                        @else
                        Rs. {{nepaliCurrencyFormate($sale->net_amount)}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>


        <p id="words"> INTO WORDS : {{strtoupper( intoWords($sale->net_amount))}}</p>

        <hr style="border-style: dashed none;">


    </div>
</body>

</html>