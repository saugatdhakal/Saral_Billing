@extends('layouts.app')
@section('content')
{{-- top-level --}}
<div class="card m-2">
    <div class="card card-body shadow ">
        <div class="row mb-1">
            <div class="col-md-4" style="font-size: 17px;">
                Bill To : {{$salesReturn->name}}
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-2" style="font-size: 17px;">
                Bill Date : {{$salesReturn->sales_return_date}}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-4" style="font-size: 17px;">
                Home Address : {{$salesReturn->home_address}}
            </div>
            <div class="col-md-5 fw-bold" style="font-size: 20px;"> SALES RETURN # {{$salesReturn->invoice_number}}
            </div>
            <div class="col-md-2" style="font-size: 17px;">
                Transaction Date : {{$salesReturn->transaction_date}}
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-md-4" style="font-size: 17px;">
                Shop Addrresses : {{empty($salesReturn->shop_address)? 'EMPTY':$salesReturn->shop_address}}
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-2" style="font-size: 17px;">
                Invocie No: {{$salesReturn->invoice_number}}
            </div>
        </div>
    </div>
</div>
{{-- Error Alert --}}
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
{{-- Error on repeated product --}}
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
{{-- Input Area --}}
<form action="{{route('salesReturn.returnItemSave',['id'=>$salesReturn->id])}}" method="POST">
    @csrf
    <div class="card m-2 shadow">
        <div class="row m-2">
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label class="fw-bold" for="exampleInputEmail1">Product Name / QTY / Rate</label>
                    <select class=" form-select " id="productSelect" style="width: 100%" name="saleItem_id" autofocus>
                        <option value="" selected disabled>---Select Product -----</option>
                        @foreach ($saleItem as $row)
                        <option data-id="{{$row->unit}}" value="{{$row->id}}"> {{$row->name}} /
                            {{$row->quantity}} {{$row->unit}} / Rs.{{$row->rate}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <label class="fw-bold">Quantity</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="quantity" min="1" step="0.01"
                        placeholder="Quantity">
                    <span class="input-group-text fw-bold" id="unit">pcs</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-12" style="margin-top:24px;">
                <button type="submit" class="btn btn-primary m-2"><i class="fa-solid fa-minus"></i> Return Item</button>
            </div>

        </div>

    </div>
</form>
{{-- Tabel --}}
<div class="card m-2">
    <div class="card-body shadow">
        <table class="table table-striped dataTable" width="100%">
            <thead>
                <tr>
                    <th width="5%">SN</th>
                    <th>Product Name</th>
                    <th>Batch Number</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th width="7%">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=0;@endphp
                @foreach ($saleReturnItem as $row)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->batch_number}}</td>
                    <td>{{$row->unit}}</td>
                    <td>{{$row->quantity}}</td>
                    <td>{{$row->rate}}</td>
                    <td>{{$row->amount}}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-5">
                                <a class="delete" data-id="{{$row->id}}">
                                    <i class="fa-solid fa-trash-can-list fa-xl "></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @php
        $amount = $saleReturnItem->sum('amount');
        @endphp
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <table cellpadding="4">
                    <tr style="font-size:18px;font-weight:bold;">
                        <td>Total Amount :</td>
                        <td width="30%">
                            @if ($amount == 0)
                            0
                            @else
                            {{$amount}}
                            @endif
                        </td>
                    </tr>
                    @php
                    $roundedAmount =ceil($amount);
                    $rounded=round($roundedAmount-($amount),2);
                    @endphp
                    <tr style="font-size:18px;font-weight:bold">
                        <td>Round Up :</td>
                        <td width="30%">
                            @if ($amount == 0)
                            0
                            @else
                            {{$rounded}}
                            @endif
                        </td>
                    </tr>
                    <tr style="font-size:18px;font-weight:bold">
                        <td>Net Amount :</td>
                        <td width="30%">
                            @if ($amount == 0)
                            0
                            @else
                            {{$roundedAmount}}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Submit Button --}}
<form action="{{route('salesReturn.returnItemComplete',['id'=>$salesReturn->id])}}" method="POST">
    @csrf
    <div class="container-fluid mb-4  mt-4">
        <div class="col-4">
            <button type="submit" class="btn btn-danger" style="font-weight:bold;font-size:17px">Save</button>
            &ensp;
            <button type="button" class="btn btn-secondary" style="font-weight:bold;font-size:17px"><i
                    class="fa-regular fa-print"></i> Save and Print</button>
        </div>
    </div>
</form>

@section('salesReturn.index')
<script>
    $('#productSelect').select2(
{
theme: "bootstrap-5",
}
);
$('.dataTable').DataTable({
"bPaginate": false,
"paging": false,
});
// unit change
$("select").change(function() {
const unit= $(this).find(':selected').attr('data-id')
$('#unit').html(unit);
});

$('body').on('click', '.delete', function () {
var btnId = $(this).attr("data-id");
alert(btnId);
$.ajax({
type: "DELETE",
url:"/salesReturn/returnItemDelete/"+btnId,
data: {
"_token":$('input[name="_token"]').val(),
"id":btnId,
},
success: function(data){
window.location.reload();
}
}
);
});

// * Alert Animation //
$(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
$(this).remove();
});

</script>

@endsection
@endsection