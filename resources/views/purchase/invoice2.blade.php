@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="float-right mt-3">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            <div class="btn-group" role="group" aria-label="...">
                {{-- pdf --}}
                
                <button type="button" id="pdfs" class="btn btn btn-danger" style="font-size:19px;"><i
                        class="fa-solid fa-file-pdf"></i>&#160PDF</button></a>
                &#160; &#160;
                {{-- printing --}}
                <a href="{{route('Purchase.print',['id'=>$purchase->id])}}" target="_blank">
                    <button type="button" class="btn btn btn-secondary" style="font-size:19px;"><i
                            class="fa-solid fa-print"></i>&#160Print</button></a>
            </div>

        </div>

    </div>
    @php
    $names = strtoupper($config->name);


    @endphp
    <div id="invoice">
        <center>
            <p style="font-size:45px;font-weight:bold;margin-left:5%;margin-bottom:0%; padding:0%">{{$names}} SOFTWARE
            </p>
            <p style="font-size:17px;margin:0%; padding:0%">{{$config->address}}</p>
            <p>Contact No : <span>{{$config->contact_number}}</span> , Email : <span>{{$config->email}}</span></p>
            <p style="font-size:25px; font-weight:bold;margin:0%; padding:0%;   ">PURCHASE DIRECT #
                {{$purchase->invoice_number}}</p>
        </center>
        <div class="row">
            <div class="col-md-3" style="font-size:17px;">
                Name : <span> {{$purchase->supplier->name}}</span>
            </div>
            <div class="col-6 p-0 m-0">

            </div>
            <div class="col-md-3" style="font-size:17px;">
                Bill Date : <span>{{$purchase->bill_date}}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" style="font-size:17px;">
                Address : <span> {{$purchase->supplier->address}}</span>
            </div>
            <div class="col-6"></div>
            <div class="col-md-3" style="font-size:17px;">
                Transaction Date : <span>{{$purchase->transaction_date}}</span>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 " style="font-size:17px;">
                LR NO : <span> {{$purchase->lr_no}}</span>
            </div>
            <div class="col-6"></div>
            <div class="col-md-3" style="font-size:17px;">
                Bill No : <span>{{$purchase->bill_no}}</span>
            </div>
        </div>
        <hr style="border: 1px dashed  #000000;" />
        <table class="table  stockTable" width="100%" style="border-style:dashed 15x;">
            <thead>
                <tr>
                    <th width="5%">SN</th>
                    <th width="30%">Product Name</th>
                    <th>Batch No</th>
                    <th width="10%">Unit</th>
                    <th width="13%">Rate</th>
                    <th width="15%">Amount</th>
                    <th width="10%">Wholesale</th>
                    <th width="5%">Discount(%)</th>
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
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <table>
                    <tr>
                        <td style="font-size:19px;font-weight:bold;">Sub Amount : </td>
                        <td style="font-size:19px;font-weight:bold;">
                            @if ($purchase->total_amount == 0)
                            0
                            @else
                            Rs. {{$purchase->total_amount}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:19px;font-weight:bold;">Discount Amount : </td>
                        <td style="font-size:19px;font-weight:bold;">
                            @if ($purchase->discount_amount == 0)
                            0
                            @else
                            Rs. {{$purchase->discount_amount}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:19px;font-weight:bold;">Rounding : </td>
                        <td style="font-size:19px;font-weight:bold;">
                            @if ($purchase->rounding == 0)
                            0
                            @else
                            Rs. {{$purchase->rounding}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:19px;font-weight:bold;">Extra Charge : </td>
                        <td style="font-size:19px;font-weight:bold;">
                            @if ($purchase->extra_charges == 0)
                            0
                            @else
                            Rs. {{$purchase->extra_charges}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:19px;font-weight:bold;">Net Amount : </td>
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
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                INTO WORDS : {{strtoupper( intoWords($purchase->net_amount))}}
            </div>
        </div>
        <hr style="border: 2px dashed  black;" />
    </div>
</div>
@section('invoice2')
<script type="text/javascript">

</script>
</head>
@endsection
@endsection