@extends('layouts.app')

@section('content')
<div class="container-fuild" >
    <div class="">
        <div class="float-right mt-3">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                <div class="btn-group" role="group" aria-label="...">
                    {{-- pdf --}}
                    <a href="{{route('purchase.domPdf',['id'=>$purchase->id])}}">
                        <button type="button" id="pdfs" class="btn btn btn-danger" style="font-size:19px;"><i
                                class="fa-solid fa-file-pdf"></i>&#160PDF</button></a>
                    &#160; &#160;
                    {{-- printing --}}
                    
                        <button type="button" class="btn btn btn-secondary" onclick="printDiv('printableArea')" style="font-size:19px;"><i
                                class="fa-solid fa-print"></i>&#160Print</button>

                    &#160; &#160;
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" style="font-size:19px;" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bring-front"></i> &#160;Layout
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item"
                                    href="{{route('purchase.invoice1',['id'=>$purchase->id])}}">Layout
                                    1</a></li>
                            <li><a class="dropdown-item"
                                    href="{{route('purchase.invoice2',['id'=>$purchase->id])}}">Layout
                                    2</a></li>

                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <br>
    <br>
    <div id="printableArea">
    {{-- Header --}}
    <div class="mt-4">
        <div class="row ">
            <div style="font-size:50px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
                class="col-md-4 fw-bold">
                {{$config->name}}
            </div>
            <div class="col-md-5"></div>
            <div style="font-size:50px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
                class="col-md-2 fw-bold ">INVOICE</div>
        </div>

        <div class="row mt-1">
            <div class="row">
                <div class="col-md-4" style="font-size:25px;">
                    {{$config->address}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size:20px;">
                    Transaction Date: <span>{{$purchase->transaction_date}}</span>
                </div>
            </div>
        </div>


        <div class="row mt-1">
            <div class="row">
                <div class="col-md-4" style="font-size:20px;">
                    {{$config->contact_number}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size:20px;">
                    Invoice: <span> {{$purchase->invoice_number}}</span>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="row">
                <div style="font-size:20px;" class="col-md-4">
                    {{$config->email}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size:20px;">
                    Bill Date: <span>{{$purchase->bill_date}}</span>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="row">
                <div style="font-size:20px;" class="col-md-4">

                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size:20px;">
                    Bill No: <span>{{$purchase->bill_no}}</span>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="row">
                <div style="font-size:20px;" class="col-md-4">

                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size:20px;">
                    Lr No: <span>{{$purchase->lr_no}}</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Middle Supplier Details--}}
    <div class="mt-4 ml-2">
        <div class="row">
            <div class=" col-md-4 rectangle" style="color:white; font-size:20px;
            font-family:Roboto,Helvetica,Arial
            ">
                SUPPLIER DETAILS
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 suppDetails">
                {{$purchase->supplier->name}}
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 suppDetails">
                {{$purchase->supplier->address}}
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4 suppDetails">
                {{$purchase->supplier->contact_number}}
            </div>
        </div>
    </div>

    {{-- Product Table --}}
    <div class="mt-5" >
        <table class="table table-striped table-bordered invoice" style="" width="100%">
            <thead style="background-color:rgb(25, 47, 84);color:white;">
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
                @php $i=0; @endphp
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
        <div class="row mt-2 ml-1">
            <div class="col-md-3" style="font-size:30px;">
                <p
                    style="text-decoration: underline;font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
                    Notes:</p>
                <p> {{$purchase->remark}} </p>
            </div>
            <div class="col-md-4" style="font-size:30px;">

            </div>

            <div class="col-md-3">
                <table>
                    <tr>
                        <td style="font-size:20px;font-weight:bold;">Sub Amount : </td>
                        <td style="font-size:20px;font-weight:bold;">
                            @if ($purchase->total_amount == 0)
                            0
                            @else
                            {{$purchase->total_amount}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:20px;font-weight:bold;">Discount Amount : </td>
                        <td style="font-size:20px;font-weight:bold;">
                            @if ($purchase->discount_amount == 0)
                            0
                            @else
                            {{$purchase->discount_amount}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:20px;font-weight:bold;">Rounding : </td>
                        <td style="font-size:20px;font-weight:bold;">
                            @if ($purchase->rounding == 0)
                            0
                            @else
                            {{$purchase->rounding}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:20px;font-weight:bold;">Extra Charge : </td>
                        <td style="font-size:20px;font-weight:bold;">
                            @if ($purchase->extra_charges == 0)
                            0
                            @else
                            {{$purchase->extra_charges}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:20px;font-weight:bold;">Net Amount : </td>
                        <td style="font-size:25px;font-weight:bold;">
                            @if ($purchase->discount_amount == 0 && $purchase->total_amount == 0)
                            0
                            @else
                            {{nepaliCurrencyFormate($purchase->net_amount)}}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>

</div>
@section('invoice2')
<script>
    $('.invoice').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
    });
    function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    
    document.body.innerHTML = printContents;
    
    window.print();
    
    document.body.innerHTML = originalContents;
    }

</script>
@endsection
@endsection