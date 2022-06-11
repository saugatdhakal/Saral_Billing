@extends('layouts.app')
@section('content')

<div class="card-body">
    <center>
        <h1> Sales Return Trash</h1>
    </center>
</div>
<hr>
<table class="table table-striped table-bordered  yajra-datatable" width="100%">
    <thead>
        <tr>
            <th width="5%">SN</th>
            <th>Customer Name</th>
            <th>Invoice No</th>
            <th>Transaction date</th>
            <th>Sales Return Date</th>
            <th>Net Amount</th>
            <th width="9%">Action</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>
@section('category.trash')
<script>
    $(function(){
// YajraBox-Datatable
    var table=$('.yajra-datatable').DataTable({
        lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        processing:true,
        serverSide:true,
        ajax:"{{route('salesReturn.trashAjaxIndex')}}",
        columns:[
            {data: 'DT_RowIndex'},
            {data: 'name'},
            {data: 'invoice_number' },
            {data: 'transaction_date'},
            {data: 'sales_return_date'},
            {data: 'net_amount'},
            {
            data: 'action',orderable: true, searchable: true,
            },
        ]
    });
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
        url:'/salesReturn/restoreTrash/'+btnId,
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
$('body').on('click', '.deleteSaleReturn', function () {
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
url:"/saleReturn/deleteTrash/"+btnId,
data: {
"_token":$('input[name="_token"]').val(),
"id":btnId,
},
success: function(data){
// alert(data);
if(data == "DeleteSuccess"){
    swal(" Your is permanently deleted!!", {
    icon: "success",
    }).then((willDelete)=>{
    location.reload();
    });
}else{
    swal(" Sorry this Sales Can't be deleted!!", {
    icon: "error",
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