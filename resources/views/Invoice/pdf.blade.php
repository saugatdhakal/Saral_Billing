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
        table.stockTable{
        width: 100%;
        border-collapse: collapse;
        }
        table.stockTable th {
        border:2px #000000;
        border-collapse:collapse;
        border-style: dashed dashed;
        }
        .table.stockTable td,.table.stockTable th {
        padding:12px 15px;
        border:2px #000000;
        border-collapse:collapse;
        border-style: dashed none ;
        text-align: center;
        font-size:16px;
        }
        
        .amount{
        margin-left:930px;
        margin-top: 20px;
        }
        #words{
        margin-left:150px;
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
                SOFTWARE</p>
            <p style="font-size:30px;margin:0%; padding:0%;">{{$config->address}}</p>
            <p style="font-size:22px; padding:0%;">Contact No : <span>{{$config->contact_number}}</span> ,
                Email : <span>{{$config->email}}</span></p>
            <p style="font-size:25px; font-weight:bold;margin:0%; padding:0%;">PURCHASE DIRECT #
                {{$purchase->invoice_number}}</p>
        </center>
        <p class="test"><span>Name : {{$purchase->supplier->name}}</span>Bill Date : {{$purchase->bill_date}}</p>
        <p class="test"><span>Address : {{$purchase->supplier->address}}</span>Transaction Date : {{$purchase->transaction_date}}</p>
        <p class="test"><span>LR NO : {{$purchase->lr_no}}</span>Bill No : {{$purchase->bill_no}}</p>


        <hr style="border-style: dashed none;">
        <table class="table stockTable" width="100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>PRODUCT NAME</th>
                    <th>BATCH</th>
                    <th>UNIT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>WHOLESALE</th>
                    <th>DISCOUNT(%)</th>
                </tr>
            </thead>
            <tbody>
                @php $i=0 ; @endphp
                @foreach ($purchase->items as $item)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$item->product->name}}</td>
                    <td>{{empty($item->stock->batch_number)? 0 : $item->stock->batch_number}}</td>
                    <td>{{$item->product->unit}}</td>
                    <td>{{$item->rate}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->wholesale_price}}</td>
                    <td>{{$item->discount_percent}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="amount">
            <table>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">SUB AMOUNT : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($purchase->total_amount == 0)
                        0
                        @else
                        Rs. {{$purchase->total_amount}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">DISCOUNT AMOUNT : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($purchase->discount_amount == 0)
                        0
                        @else
                        Rs. {{$purchase->discount_amount}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-size:19px;font-weight:bold;">ROUNDING : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($purchase->rounding == 0)
                        0
                        @else
                        Rs. {{$purchase->rounding}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="font-size:19px;font-weight:bold;">EXTRA CHARGE : </td>
                    <td style="font-size:19px;font-weight:bold;">
                        @if ($purchase->extra_charges == 0)
                        0
                        @else
                        Rs. {{$purchase->extra_charges}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="font-size:19px;font-weight:bold;">NET AMOUNT : </td>
                    <td style="font-size:25px;font-weight:bold;">
                        @if ($purchase->discount_amount == 0 && $purchase->total_amount == 0)
                        0
                        @else
                        Rs. {{nepaliCurrencyFormate($purchase->net_amount)}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>


        <p id="words"> INTO WORDS : {{strtoupper( intoWords($purchase->net_amount))}}</p>

        <hr style="border-style: dashed none;">


    </div>
</body>

</html>