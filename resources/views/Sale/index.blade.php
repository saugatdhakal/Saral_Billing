@extends('layouts.app')
@section('content')
{{-- Buttons --}}
<center>
    <h1>
        <i class="fa-solid fa-cart-circle-check"></i> Sales Dashboard
    </h1>
</center>
<div class="row mb-3 p-0 mt-2 mr-3">
    <div class="col-md-12 clearfix ">
        <a class="float-right mr-2" href="{{route('sale.create')}}">
            <button type="button" id="add" class="btn btn-outline-primary float-right" data-bs-toggle="modal"
                data-bs-target="#category" autofocus>
                <i class="fa fa-user" aria-hidden="true"></i> Create Sales
            </button>
        </a>
        <a class="float-right mr-2" href="{{route('sales.trashPage')}}">
            <button type="button" class="btn btn-outline-danger">
                <i class="fas fa-user-times"></i> Trash Sales
            </button>
        </a>
    </div>
</div>
{{-- Table --}}
<hr>
<table class="table table-striped table-bordered  yajra-datatable" width="100%">
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
            <th width="9%">Action</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>
{{-- Model --}}
<div class="modal fade" id="saleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <div class="col-sm-4"><b>Sales Status:</b></div>
                    <div class="col-sm-5"><span id="sales_status" class="badge bg-warning"></span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4"><b>Sales Type:</b></div>
                    <div class="col-sm-5"><span id="sales_type" class="badge badge-dark"></span></div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Invoice No:</b></div>
                    <div class="col-sm-5">
                        <p id="invoice_no"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Account Name:</b></div>
                    <div class="col-sm-5">
                        <p id="account_name"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Transaction Date:</b></div>
                    <div class="col-sm-5">
                        <p id="transaction_date"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Sales Date:</b></div>
                    <div class="col-sm-5">
                        <p id="sales_date"><strong></strong></p>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-sm-4"><b>Total Amount:</b></div>
                    <div class="col-sm-5">
                        <p id="total_amt"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Extra Charge:</b></div>
                    <div class="col-sm-5">
                        <p id="extra_charge"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Discount Amount:</b></div>
                    <div class="col-sm-5">
                        <p id="discount_amount"><strong></strong></p>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-sm-4"><b>Net Amount:</b></div>
                    <div class="col-sm-5">
                        <p style="font-weight:bold;font-size:20px" id="net_amount"><strong></strong></p>
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
@section('sales.index')
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
    ajax:"{{route('sales.ajaxIndex')}}",
    columns:[
    {data: 'DT_RowIndex'},
    {data: 'name'},
    {data: 'invoice_number' },
    {data: 'transaction_date'},
    {data: 'sales_date'},
    {data: 'net_amount'},
    {data: 'sales_type'},
    {data: 'paymode'},
    
    {
    data: 'action',orderable: true, searchable: true,
    },
    ]
    });
    //!! Model
    $('body').on('click', '.viewSale', function () {
    var btnId = $(this).attr("id");
    // alert(btnId);
    $('#saleModel').modal('toggle');
    $.get("/sale/moduleView/"+btnId , function (data) {
    // console.log(data);
    $('#sales_status').html(data.status);
    $('#sales_type').html(data.sales_type);
    $('#account_name').html(data.name);
    $('#invoice_no').html(data.invoice_number);
    $('#transaction_date').html(data.transaction_date);
    $('#sales_date').html(data.sales_date);
    $('#total_amt').html(data.total_amount);
    $('#discount_amount').html(data.discount_amount);
    $('#extra_charge').html(data.extra_charges);
    $('#net_amount').html(data.net_amount);
    }
    );
    });
    
    //Moving into trash(soft Delete)
    $('.close').click(function () {
    $('#saleModel').modal('toggle');
    });

    $('body').on('click', '.deleteSale', function () {
    var btnId = $(this).attr("id");
    swal({
    title: "Are you sure?",
    text: "Deleted Data will move to Trash",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
    
    if (willDelete) {
    $.ajax({
    type: "DELETE",
    url:"sale/"+btnId,
    data: {
    "_token":$('input[name="_token"]').val(),
    "id":btnId,
    },
    success: function(data){
    // alert(data);
    if(data == "DeleteSuccess"){
    swal(" Your Data has been Move to Trash!!", {
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
    
    
    });


</script>
@endsection
@endsection