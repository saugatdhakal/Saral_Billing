@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-3">
            <h1 class="mt-4">Saral Dashboard</h1>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4 mt-4">
            <h2>
                <span style="float: right" id='ct6'></span>
            </h2>


        </div>
    </div>


    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">SALES </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('sale.index')}}">View Details</a>
                    <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">PURCHASE</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('purchase.index')}}">View Details</a>
                    <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">USERS</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('user')}}">View Details</a>
                    <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">STOCKS</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('stock.index')}}">View Details</a>
                    <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="angle-right" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
                            </path>
                        </svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Revenue of months --}}
    @php
    $revenuesMonth = DB::table('sale_items')
    ->where('created_at', '>', now()->subDays(30)->endOfDay())
    ->get('profit_total');

    $revenuesDay = DB::table('sale_items')
    ->where('created_at', '>', today())
    ->get('profit_total');

    $revenuesYear = DB::table('sale_items')
    ->where('created_at', '>', now()->subDays(360)->endOfDay())
    ->get('profit_total');
    $salesToday =DB::table('sales')
    ->where('created_at', '>', today())
    ->get(['net_amount']);
    $salesCount = $salesToday->count();
    @endphp
    <div class="row" style="margin-bottom:20px; margin-top:10;">
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: rgb(8, 0, 255);">
                <div class="card-body">
                    <center>
                        <p style="color:white;font-size:17px;">
                            TOTAL SALES TODAY
                        </p>
                        <p style="color:white;font-size:25px;">
                            {{$salesCount
                            }}
                        </p>
                    </center>
                </div>

            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: rgb(149, 0, 255);">
                <div class="card-body">
                    <center>
                        <p style="color:white;font-size:17px;;">
                            MONTH REVENUES
                        </p>
                        <p style="color:white;font-size:25px;">
                            Rs. {{nepaliCurrencyFormate($revenuesMonth->sum('profit_total'))
                            }}
                        </p>
                    </center>
                </div>

            </div>
        </div>


        {{-- Revenue of day --}}
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: rgb(255, 0, 153);">
                <div class="card-body">
                    <center>
                        <p style="color:white;font-size:17px;;">
                            DAY REVENUES
                        </p>
                        <p style="color:white;font-size:25px;">
                            Rs. {{nepaliCurrencyFormate($revenuesDay->sum('profit_total'))
                            }}
                        </p>
                    </center>
                </div>

            </div>
        </div>


        {{-- Total Revenue Year --}}
        <div class="col-xl-3 col-md-6">
            <div class="card" style="background-color: rgb(255, 128, 0);">
                <div class="card-body">
                    <center>
                        <p style="color:white;font-size:17px;">
                            YEAR REVENUES
                        </p>
                        <p style="color:white;font-size:25px;">
                            Rs. {{nepaliCurrencyFormate($revenuesYear->sum('profit_total'))
                            }}
                        </p>
                    </center>
                </div>

            </div>
        </div>
    </div>
    <div>
        @php
        $data =DB::table('sales')
        ->where('created_at', '>', now()->subDays(30)->endOfDay())
        ->get(['net_amount']);
        $data1 =DB::table('sales')
        ->where('created_at', '>', now()->subDays(30)->endOfDay())
        ->where('sales_type','DEBIT')
        ->get(['net_amount']);
        $data2 =DB::table('sales')
        ->where('created_at', '>', now()->subDays(30)->endOfDay())
        ->where('sales_type','CREDIT')
        ->get(['net_amount']);

        $debitCount = $data1->count();
        $creditCount =$data2->count();

        $sum = $data->sum('net_amount');
        $count = $data->count();
        @endphp
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <!-- <i class="fas fa-chart-area me-1"></i> Font Awesome fontawesome.com -->
                        <i class="fa-solid fa-badge-dollar"></i> Sales Of Months
                    </div>
                    <div class="card-body">
                        <table class="" width="100%">
                            <tr style="border-bottom: 1px solid black;">
                                <td style="font-size:19px;font-weight:bold;">
                                    Number of Sales
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{$count}}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <td style="font-size:19px;font-weight:bold;">
                                    Credit Sales
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{$creditCount}}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <td style="font-size:19px;font-weight:bold;">
                                    Debit Sales
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{$debitCount}}
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:19px;font-weight:bold;">
                                    Total Sales
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{nepaliCurrencyFormate($sum)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @php
            $datas =DB::table('purchases')
            ->where('transaction_date', '>', now()->subDays(30)->endOfDay())
            ->get(['net_amount']);


            $PurchaseNet = $datas->sum('net_amount');
            $Purchasecount = $datas->count();
            @endphp
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <!-- <i class="fas fa-chart-bar me-1"></i> Font Awesome fontawesome.com -->
                        <i class="fa-solid fa-industry-windows"></i> Purchase Of Months
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <tr style="border-bottom: 1px solid black;">
                                <td style="font-size:19px;font-weight:bold;">
                                    Number of Purchase
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{$Purchasecount}}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:19px;font-weight:bold;">
                                    Total Purchase
                                </td>
                                <td style="font-size:19px;font-weight:bold;">
                                    {{nepaliCurrencyFormate($PurchaseNet)}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @php
        $sales = DB::table('sales')
        ->where('sales.deleted_by',NULL)
        ->join('accounts','sales.account_id','=','accounts.id')
        ->select(['sales.id','sales.invoice_number','sales.transaction_date','sales.sales_date','sales.net_amount','sales.sales_type','sales.paymode','accounts.name','sales.status'])
        ->orderBy('sales.sales_date','desc')
        ->limit(10)
        ->get();
        @endphp
        <div class="card mb-4">
            <div class="card-header">
                <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas"
                    data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
                    </path>
                </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
                Recent Sales Transaction
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">SN</th>
                            <th>Customer Name</th>
                            <th>Invoice No</th>
                            <th>Transaction date</th>
                            <th>Sales Date</th>
                            <th>Net Amount</th>
                            <th>Sale Type</th>
                            <th>Payment mode</th>
                        </tr>
                    </thead>
                    @php $i=0 @endphp
                    <tbody>
                        @foreach ($sales as $row)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$row->name}}</td>
                            <td>

                                @if ($row->status =='COMPLETED' || $row->status =='RETURN')
                                <a href="{{route('sales.invoiceView',['id'=>$row->id])}}">
                                    {{$row->invoice_number}}
                                </a>
                                @elseif ($row->status =='RUNNING')
                                <a href="{{route('sales.salesItem',['id'=>$row->id])}}" style="color:green">
                                    {{$row->invoice_number}}
                                </a>
                                @endif

                            </td>
                            <td>{{$row->transaction_date}}</td>
                            <td>{{$row->sales_date}}</td>
                            <td>{{$row->net_amount}}</td>
                            <td>{{$row->paymode}}</td>
                            <td>{{$row->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @section('dashboard')
    <script>
        function display_ct6() {
    var x = new Date()
    var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
    hours = x.getHours( ) % 12;
    hours = hours ? hours : 12;
    var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear();
    x1 = x1 + " - " + hours + ":" + x.getMinutes() + ":" + x.getSeconds() + ":" + ampm;
    document.getElementById('ct6').innerHTML = x1;
    display_c6();
    }
    function display_c6(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct6()',refresh)
    }
    display_c6()
    </script>
    @endsection

    @endsection