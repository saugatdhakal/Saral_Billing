@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="float-right mt-3">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <div class="btn-group" role="group" aria-label="...">
                {{-- pdf --}}
                <a href="{{route('sales.domPdf',['id'=>$sale->id])}}">
                    <button type="button" id="pdfs" class="btn btn btn-danger" style="font-size:19px;"><i
                            class="fa-solid fa-file-pdf"></i>&#160PDF</button></a>
                &#160; &#160;
                {{-- printing --}}
                <a href="{{route('sales.print',['id'=>$sale->id])}}" target="_blank">
                    <button type="button" class="btn btn btn-secondary" style="font-size:19px;"><i
                            class="fa-solid fa-print"></i>&#160Print</button></a>

                &#160; &#160;
                <a href="{{route('sales.email',['id'=>$sale->id])}}" target="_blank">
                    <button type="button" class="btn btn btn-dark" style="font-size:19px;"><i
                            class="fa-solid fa-envelope"></i>&#160Email</button></a>

                &#160; &#160;
            </div>
        </div>

    </div>
    @php
    $names = strtoupper($config->name);
    @endphp
    <div id="invoice">
        <center>
            <p style="font-size:45px;font-weight:bold;margin-left:10%;margin-bottom:0%; padding:0%">{{$names}} SOFTWARE
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
            <div class="col-md-9"></div>
            <div class="col-md-3">
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
    </div>
</div>
@section('invoice1')
<script type="text/javascript">

</script>
</head>
@endsection
@endsection