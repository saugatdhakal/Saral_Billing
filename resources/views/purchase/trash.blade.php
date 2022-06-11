@extends('layouts.app')
@section('content')
<div class="card-body">
    <center>
        <h1><i class="fa-solid fa-trash-list"></i> Purchase Trash</h1>
    </center>
</div>
<div class="row">
    <div class="col-md-6">
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
<hr>
<table class="table table-striped table-bordered  yajra-datatable" width="100%">
    <thead>
        <tr>
            <th width="5%">SN</th>
            <th>Supplier Name</th>
            <th>Invoice No</th>
            <th>Transaction date</th>
            <th>Bill Date</th>
            <th>Bill No</th>
            <th>Lr No</th>
            <th>Net Amount</th>
            <th width="9%">Action</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>


<div class="modal fade" id="purchaseModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i> Purchase Deatils
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- body start --}}
                <div class="row mb-3">
                    <div class="col-sm-4"><b>Purchase Status:</b></div>
                    <div class="col-sm-5"><span id="purchase_status" class="badge bg-warning"></span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4"><b>Purchase Type:</b></div>
                    <div class="col-sm-5"><span id="purchase_type" class="badge badge-dark"></span></div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Invoice No:</b></div>
                    <div class="col-sm-5">
                        <p id="invoice_no"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Supplier Name:</b></div>
                    <div class="col-sm-5">
                        <p id="supplier_name"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Transaction Date:</b></div>
                    <div class="col-sm-5">
                        <p id="transaction_date"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Bill Date:</b></div>
                    <div class="col-sm-5">
                        <p id="bill_date"><strong></strong></p>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-sm-4"><b>Bill No:</b></div>
                    <div class="col-sm-5">
                        <p id="bill_no"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>LR NO:</b></div>
                    <div class="col-sm-5">
                        <p id="lr_no"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Gst:</b></div>
                    <div class="col-sm-5">
                        <p id="gst"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Net Amount:</b></div>
                    <div class="col-sm-5">
                        <p style="font-weight:bold;font-size:20px" id="net_amount"></p>
                    </div>
                </div>
                {{-- body stop --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="close" style="color: black;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section('purchase.trashAjax')
<script>
    $(function(){
// YajraBox-Datatable
    var table =$('.yajra-datatable').DataTable({
    lengthMenu: [
    [ 30, 40, 50, -1 ],
    [ '30 rows', '40 rows', '50 rows', 'Show all' ]
    ],
    processing:true,
    serverSide:true,
    ajax:"{{route('purchase.trashAjax')}}",
    columns:[
    {data: 'DT_RowIndex'},
    {data: 'name'},
    {data: 'invoice_number' },
    {data: 'transaction_date'},
    {data: 'bill_date'},
    {data: 'bill_no'},
    {data: 'lr_no'},
    {data: 'net_amount'},
    {
    data: 'action',orderable: true, searchable: true,
    },
    ]
    });
});

$('body').on('click', '.viewPurchase', function () {
var btnId = $(this).attr("id");
// alert(btnId);
$('#purchaseModel').modal('toggle');
$.get("/purchase/moduleView/"+btnId , function (data) {
// console.log('hello');
$('#purchase_status').html(data.status);
$('#purchase_type').html(data.purchase_type);
$('#supplier_name').html(data.name);
$('#invoice_no').html(data.invoice_number);
$('#transaction_date').html(data.transaction_date);
$('#bill_date').html(data.bill_date);
$('#bill_no').html(data.bill_no);
$('#lr_no').html(data.lr_no);
$('#gst').html(data.gts);
$('#net_amount').html(data.net_amount);
}
);
});
$('.close').click(function () {
$('#purchaseModel').modal('toggle');
});

//Restore Deleted Data
$('body').on('click', '.restoreTrash', function (e){

e.preventDefault();
var btnId = $(this).attr("id");
    swal({
    title: "Are you sure?",
    text: "Do you want to restore data!!",
    icon: "info",
    buttons: true,
    dangerMode: false,
})
.then((result) => {

    if (result) {
    $.ajax({
        type: "POST",
        url:'/purchase/restorePurchase/'+btnId,
        data: {
            "_token":$('input[name="_token"]').val(),
            "id":btnId,
        },
        success: function(data){
            // alert(data);
            if(data == "DataRestore"){
                swal(" Your Data has been restore!!", {
                icon: "success",
                }).then((result)=>{
                location.reload();
                });
            }

        }
    })  
    }

});
});
//Category Permanent Delete
$('body').on('click', '.deletePurchase', function () {
var btnId = $(this).attr("id");
swal({
title: "Are you sure?",
text: "Data will be permanently deleted !!",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {

if (willDelete) {
$.ajax({
type: "DELETE",
url:"/purchase/trashDelete/"+btnId,
data: {
"_token":$('input[name="_token"]').val(),
"id":btnId,
},
success: function(data){
    if(data == "DeleteSuccess"){
        swal(" Your data is permanently deleted!!", {
        icon: "success",
        }).then((willDelete)=>{
        location.reload();
    });
    }else{
        swal(" Sorry this Supplier Can't be deleted!!", {
        icon: "error",
        })
    }

}
})
}

});

});
</script>
@endsection


@endsection