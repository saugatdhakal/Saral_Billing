@extends('layouts.app')
@section('content')
<center class="m-3">
    <p style="font-size: 40px;font-weight:bold;">
        <i class="fa-regular fa-money-bills-simple"></i> SUPPLIER PAYMENT
    </p>
</center>
<hr>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<div style="margin-top:30px;">
    <form class="row g-3 needs-validation" action="{{route('supplier.paymentStore')}}" method="POST" novalidate>
        @csrf
        <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Supplier Name
            </div>
            <div class=" col-md-4 col-sm-12 col-lg-4">
                <select class="selects form-control form-select" style="width: 100%" id="supplierSelect"
                    name="supplier_id" autofocus>
                    <option value="" selected disabled>---Select Supplier---</option>
                    {{$rows = DB::table('Suppliers')->where('deleted_by',NULL)->get(['id','name']);}}
                    @foreach ($rows as $row)
                    <option value={{$row->id}} >{{$row->name}}</option>
                    @endforeach

                </select>
                <div class="invalid-feedback">
                    Supplier Name is Empty !!
                </div>
            </div>

        </div>
        <div class="row m-2" id="invoiceDiv" style="display: none">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Invoice Number
            </div>
            <div class=" col-md-4 col-sm-12 col-lg-4">
                <select name="purchase_id" class="form-select" id="invoice_num">

                </select>
                <div class="invalid-feedback">
                    Invoice Number is Empty !!
                </div>
            </div>

        </div>
        <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Payment Mode
            </div>
            <div class=" col-md-4 col-sm-12 col-lg-4">
                <select name="pay_mode" class="form-select" id="payModeSelect">
                    <option value="" disabled selected>---Payment Mode---</option>
                    <option value="CASH">CASH</option>
                    <option value="MOBILE BANKING">MOBILE BANKING</option>
                    <option value="BANK TRANSFER">BANK TRANSFER</option>
                    <option value="CHEQUE">CHEQUE</option>
                </select>
                <div class="invalid-feedback">
                    Payment Mode is Empty !!
                </div>
            </div>

        </div>


        <div class="row m-2">
            <div class="col-md-2 col-sm-2 m-1" style="font-family:georgia,garamond,serif;">
                Payment Date
            </div>
            <div class="col-md-4">
                <input type="date" name="payment_date" min="2022-01-01" max="2022-12-31" id="pro_code" value=""
                    class="form-control" required>
                <div class="invalid-feedback">
                    Payment Date is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Payment Amount
            </div>
            <div class="col-md-4">
                <input type="number" id="name" class="form-control" min="0" oninput="this.value = Math.abs(this.value)"
                    name="amount" placeholder="Amount" autofocus required>
                <div class="invalid-feedback">
                    Payment Amount is Empty!!
                </div>
            </div>
        </div>
        &ensp;

        <div class="row mt-4 mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-4">&ensp;&ensp;
                <button type="submit" style="font-family:georgia,garamond,serif;"
                    class="btn btn-outline-primary">Submit</button>
                &ensp;&ensp;
                <a href="{{route('product.index')}}">
                    <button type="button" style="font-family:georgia,garamond,serif;"
                        class="btn btn-outline-danger ">Cancel</button>
                </a>
            </div>
        </div>


    </form>
</div>
@section('supplierLedger.create')
<script>
    $("#supplierSelect").change(function() {
var supplier_id= $(this).val();
// console.log(product_id);
// alert(product_id);
$.ajax({
type: "GET",
url:"/supplier/invoiceSearch/"+supplier_id,
data:{supplier_id},
success: function(data) {
// console.log(data);a
$('#invoiceDiv').show();
$('#invoice_num').empty();
$.each(data,function(index,row){
console.log(row);
$('#invoice_num').append('<option  value="'+ row.id + '">'+'Invoice Number:-' +
    row.invoice_number + ' / '+'Bill Date:-'
    + row.bill_date + '</option>');

})
},
});
});

$('.selects').select2(
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