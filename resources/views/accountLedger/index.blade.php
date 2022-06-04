@extends('layouts.app')
@section('content')

<center class="m-3">
    <p style="font-size: 40px;font-weight:bold;">
        <i class="fa-regular fa-file-lines"></i> ACCOUNT LEDGER
    </p>
</center>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<form class="row g-3 needs-validation" action="{{route('accountLedger.searchLedger')}}" method="GET" novalidate>
    <div class="card-body shadow">
        <div class="row m-2">
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">Supplier Name</label>
                <select class="form-select" name="account_id" id="accountSelect">
                    <option value="" selected disabled>---------------Select Supplier--------------</option>
                    @foreach ($account as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">From Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">From</span>
                    <input type="date" name="fromDate" class="form-control" placeholder="Date" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">To Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">To</span>
                    <input type="date" name="toDate" class="form-control" id="toDate" placeholder="Date"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-1" style="margin-top:38px">
                <button class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i> Search</button>
            </div>
        </div>
    </div>
</form>
@if ($accountLedger)
<div class="row">
    <div class="card-body" style="margin-top:10px;margin-button:10px;">

        <div class="row">
            <div class="col-md-4">
                Name : {{$searchedAccount->name}}
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                Account Type : {{$searchedAccount->account_type}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Contact Number : {{$searchedAccount->contact_number_1}}
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                Account Type : {{$searchedAccount->email}}
            </div>
        </div>

    </div>
</div>

<table class="table table-striped yajra-datatable" style="margin-top:20px" width="90%">
    <thead>
        <th style="width: 10%">Date</th>
        <th>Account Description</th>
        <th style="width: 5%">Debit(Dr)</th>
        <th style="width: 5%">Credit(Cr)</th>
        <th style="width: 5%">Balance</th>
    </thead>
    <tbody>

        @php $i=0;@endphp
        @forelse ($accountLedger as $row)
        <tr>
            <td class="fw-bold">{{$row->date}}</td>
            <td class="fw-bold">{{$row->particular}} #{{$row->invoice_number}}
                <table>
                    <tbody>
                        @if ($sale)
                        @foreach ($sale as $sal)
                        @if ($sal->id == $row->sales_id)
                        @foreach ($sal->saleitems as $col)
                        <tr>
                            <td style="font-weight:normal">{{$col->product->name}}</td>
                            <td style="font-weight:normal;width:10%">{{$col->quantity}}</td>
                            <td style="font-weight:normal;width:10%">{{$col->rate}}</td>
                            <td style="font-weight:normal;width:10%">{{$col->amount}}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </td>
            <td class="fw-bold text-end ">{{$row->debit_amount}}</td>
            <td class="fw-bold text-end">{{$row->credit_amount}}</td>
            <td class="fw-bold text-end">{{$row->balance}}</td>
        </tr>
        @empty
        <div class="alert alert-danger">
            No data found
        </div>

        @endforelse
        @endif
    </tbody>
    <tfoot class="table table-bordered" style="border-top: inset">
        @if ($accountLedger)
        <td colspan="2" class="fw-bold">Total Ledger Amount</td>

        <td class="fw-bold text-end ">{{$drAmount}}</td>
        <td class="fw-bold text-end ">{{$crAmount}}</td>


        <td class="fw-bold text-end ">{{($balance)}}</td>


    </tfoot>

</table>
@endif
@section('accountLedger.create')
<script>
    // document.getElementById("toDate").valueAsDate = new Date();
    $('#accountSelect').select2(
    {
    theme: "bootstrap-5",
    
    }
    );
    // Alert
    $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
    $(this).remove();
    });
</script>
@endsection
@endsection