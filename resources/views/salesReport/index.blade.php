@extends('layouts.app')
@section('content')

<center class="m-3">
    <p style="font-size: 40px;font-weight:bold;">
        <i class="fa-regular fa-file-lines"></i> SALES REPORT
    </p>
</center>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<div class="row">
    <div class="col-md">
        @if (Session::has('fail'))
        <div class="alert alert-danger">
            <ul>
                @foreach (Session::get('fail') as $session)
                <li>{{$session}}</li>
                @endforeach
                {{-- <li>{!! \Session::get('fail') !!}</li> --}}
            </ul>
        </div>
        @endif
    </div>
</div>
<form class="row g-3 needs-validation" action="{{route('salesReport.searchReport')}}" method="GET" novalidate>
    <div class="card-body shadow">
        <div class="row m-2">
            <div class="col-md-3">
                <label for="" style="font-size: 20px;font-weight:bold;">Account Name</label>
                <select class="form-select" name="account_id" id="supplierSelect">
                    <option value="" selected disabled>---------------Select Account--------------</option>
                    @foreach ($account as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for=""><span style="font-size: 20px;font-weight:bold;">Sales Type</span> (click to
                    select)</label>
                <select class="form-select" id="sales_type" name="sales_type[]" multiple>
                    <option value="" disabled>Select Sales Type</option>
                    <option value="DEBIT">DEBIT</option>
                    <option value="CREDIT">CREDIT</option>

                </select>
            </div>
            <div class="col-md-2">
                <label for="" style="font-size: 20px;font-weight:bold;">From Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">From</span>
                    <input type="date" name="fromDate" class="form-control" placeholder="Date" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-2">
                <label for="" style="font-size: 20px;font-weight:bold;">To Date</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">To</span>
                    <input type="date" id="toDate" name="toDate" class="form-control" placeholder="Date"
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-1" style="margin-top:38px">
                <button class="btn btn-primary"><i class="fa-regular fa-magnifying-glass"></i> Search</button>
            </div>
        </div>
    </div>
</form>
<div class="card shadow">

</div>
<div class="card shadow">
    <table class="table">
        <thead>
            <th>SN</th>
            <th>Date</th>
            <th>Invoice No</th>
            <th>Customer Name</th>
            <th>Amount</th>
            <th>Remark</th>
        </thead>
        @php $i=0; @endphp
        <tbody>
            @if ($sales)

            @forelse ($sales as $row)

            <tr>
                <td>{{++$i}}</td>
                <td>{{$row->sales_date}}</td>
                <td>{{$row->invoice_number}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->net_amount}}</td>
                <td>{{$row->sales_type}}</td>
            </tr>
            @empty
            <div class="alert alert-danger m-2 ">
                No data found
            </div>
            @endforelse


            @endif


        </tbody>
        <tr>
            @if($sum)

            <td colspan="4" class="fw-bold">Total</td>
            <td class="fw-bold" colspan="2">Rs.{{$sum}}</td>
            @else
            <td colspan="4" class="fw-bold">Total</td>
            <td class="fw-bold" colspan="2">Rs.{{0}}</td>
            @endif
        </tr>

    </table>
</div>


@section('salesReport')
<script>

    $('#sales_type,#supplierSelect').select2(
        {
        theme: "bootstrap-5",
        }
    );
        // * Alert Animation //
        $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
        $(this).remove();
        });
      
</script>
@endsection
@endsection