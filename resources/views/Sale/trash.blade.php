@extends('layouts.app')
@section('content')
<center>
    <h1>
       <i class="fa-solid fa-cart-circle-exclamation"></i> Sales Delete
    </h1>
</center>
<hr>
{{-- Table --}}
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
@section('salesTrash')
<script>
    // YajraBox-Datatable
        var table =$('.yajra-datatable').DataTable({
        lengthMenu: [
        [ 30, 40, 50, -1 ],
        [ '30 rows', '40 rows', '50 rows', 'Show all' ]
        ],
        processing:true,
        serverSide:true,
        ajax:"{{route('sales.trashAjax')}}",
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
                url:'/sale/restoreSale/'+btnId,
                data: {
                "_token":$('input[name="_token"]').val(),
                "id":btnId,
            },
            success: function(data){
            // alert(data);
            if(data == "DataRestore"){
                swal(" Your Data has been restore!!", {
                icon: "success",})
                .then((result)=>{
                location.reload();
                });
            }
    
    }
    })
    }
    
    });
    });
    //Sales Permanent Delete
    $('body').on('click', '.deleteSale', function () {
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
    url:"/sale/trashDelete/"+btnId,
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
       swal(" Sorry this Sales Can't be deleted!!", {
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