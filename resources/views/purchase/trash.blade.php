@extends('layouts.app')
@section('content')

<div class="card-body">
    <center>
        <h1> Purchase Trash</h1>
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
<div class="card mb-4 m-2">
    <div class="card-header">
        <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="tdue" focusable="false" data-prefix="fas"
            data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
            <path fill="currentColor"
                d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
            </path>
        </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
        Product List
    </div>

    <div class="card-body">

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

    </div>
</div>
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
alert(data);
if(data == "DeleteSuccess"){
swal(" Your data is permanently deleted!!", {
icon: "success",
}).then((willDelete)=>{
location.reload();
});
}

}
})
}

});

});
</script>
@endsection


@endsection