@extends('layouts.app')
@section('content')

<center class="m-3">
    <p style="font-size: 40px;font-weight:bold;">
        <i class="fa-regular fa-file-lines"></i> SUPPLIER LEDGER
    </p>
</center>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<form class="row g-3 needs-validation" action="{{route('supplierLedger.searchLedger')}}" method="GET" novalidate>
    <div class="card-body shadow">
        <div class="row m-2">
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">Supplier Name</label>
                <select class="form-select" name="supplier_id" id="supplierSelect">
                    <option value="" selected disabled>---------------Select Supplier--------------</option>
                    @foreach ($supplier as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">From Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">From</span>
                    <input type="date" name="fromDate"  class="form-control" placeholder="Date" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">To Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">To</span>
                    <input type="date" name="toDate" class="form-control" placeholder="Date" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-1" style="margin-top:38px">
                <button class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i> Search</button>
            </div>
        </div>
    </div>
</form>
<table class="table table-striped yajra-datatable" style="margin-top:10px   " width="90%">
    <thead>
        <th style="width: 10%">Date</th>
        <th>Account Description</th>
        <th style="width: 5%">Debit(Dr)</th>
        <th style="width: 5%">Credit(Cr)</th>
        <th style="width: 5%">Balance</th>
    </thead>
    <tbody>
        @if ($supplierLedger)
        @php $i=0;@endphp
        @forelse ($supplierLedger as $row)
        <tr>
            <td class="fw-bold">{{$row->date}}</td>
            <td class="fw-bold">{{$row->purchase_type}} #{{$row->invoice_number}}
                <table>
                    <tbody>
                        @if ($purchases)
                        @foreach ($purchases as $purchase)
                        @if ($purchase->id == $row->purchase_id)
                        @foreach ($purchase->items as $col)
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
        <td colspan="2" class="fw-bold">Total Ledger Amount</td>
        
        <td class="fw-bold text-end ">{{$drAmount}}</td>
        <td class="fw-bold text-end ">{{$crAmount}}</td>
        <td class="fw-bold text-end ">{{$crAmount - $drAmount}}</td>
        
    </tfoot>
</table>

@section('supplierLedger.index')
<script>
    $('#supplierSelect').select2(
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