<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saral Billing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/saral.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body onload="window.print()">

    <div class="container-fluid">

        @php
        $names = strtoupper($config->name);
        @endphp
        <div id="invoice">
            <center>
                <p style="font-size:45px;font-weight:bold;margin-left:10%;margin-bottom:0%; padding:0%">{{$names}}
                    SOFTWARE
                </p>
                <p style="font-size:17px;margin:0%; padding:0%">{{$config->address}}</p>
                <p>Contact No : <span>{{$config->contact_number}}</span> , Email : <span>{{$config->email}}</span></p>
                <p style="font-size:25px; font-weight:bold;margin:0%; padding:0%;   ">SALES DIRECT #
                    {{$sale->invoice_number}}</p>
            </center>
            <div class="row">
                <div class="col-md-3" style="font-size:17px;">
                    Name : <span> {{$sale->name}}</span>
                </div>
                <div class="col-6 p-0 m-0">

                </div>
                <div class="col-md-3" style="font-size:17px;">
                    Bill Date : <span>{{$sale->sales_date}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" style="font-size:17px;">
                    Address : <span> {{$sale->home_address}}</span>
                </div>
                <div class="col-6"></div>
                <div class="col-md-3" style="font-size:17px;">
                    Transaction Date : <span>{{$sale->transaction_date}}</span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-3 " style="font-size:17px;">
                    Sales Type : <span> {{$sale->sales_type}}</span>
                </div>
                <div class="col-6"></div>
                <div class="col-md-3" style="font-size:17px;">

                </div>
            </div>
            <hr style="border: 1px dashed  #000000;" />
            <table class="table  stockTable" width="100%">
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
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-4">
                    <table>
                        <tr>
                            <td style="font-size:19px;font-weight:bold;">Sub Amount : </td>
                            <td style="font-size:19px;font-weight:bold;">
                                @if ($sale->total_amount == 0)
                                0
                                @else
                                Rs. {{$sale->total_amount}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:19px;font-weight:bold;">Discount Amount : </td>
                            <td style="font-size:19px;font-weight:bold;">
                                @if ($sale->discount_amount == 0)
                                0
                                @else
                                Rs. {{$sale->discount_amount}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:19px;font-weight:bold;">Rounding : </td>
                            <td style="font-size:19px;font-weight:bold;">
                                @if ($sale->rounding == 0)
                                0
                                @else
                                Rs. {{$sale->rounding}}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:19px;font-weight:bold;">Extra Charge : </td>
                            <td style="font-size:19px;font-weight:bold;">
                                @if ($sale->extra_charges == 0)
                                0
                                @else
                                Rs. {{$sale->extra_charges}}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size:19px;font-weight:bold;">Net Amount : </td>
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
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    INTO WORDS : {{strtoupper( intoWords($sale->net_amount))}}
                </div>
            </div>
            <hr style="border: 2px dashed  black;" />
            <p style="float: right;">PRINTED BY : {{strtoupper( Auth::user()->name)}}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

</body>

</html>