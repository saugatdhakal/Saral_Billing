@extends('layouts.app')
@section('content')
<div class="m-2">
    <center>
        <h1>
            <i class="fa-solid fa-shirt-long-sleeve"></i> Product Dashboard
        </h1>
    </center>
</div>
<div class="row mb-3 p-0 mt-2 mr-3">

    <div class="col-md-12 clearfix ">
        <a class="float-right mr-2" href="{{route('product.create')}}">
            <button type="button" id="add" class="btn btn-outline-primary float-right" data-bs-toggle="modal"
                data-bs-target="#category" autofocus>
                <i class="fa fa-user" aria-hidden="true"></i> Add Product
            </button>
        </a>
        <a class="float-right mr-2" href="{{route('product.productTrash')}}">
            <button type="button" class="btn btn-outline-danger">
                <i class="fas fa-user-times"></i> Trash Product
            </button>
        </a>
    </div>
</div>
<hr>

<table class="table table-striped table-bordered  yajra-datatable" width="100%">
    <thead>
        <tr>
            <th width="5%">SN</th>
            <th>Name</th>
            <th>Code</th>
            <th>Unit</th>
            <th>Category</th>
            <th width="9%">Action</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>

{{-- Model --}}
<div class="modal fade" id="productModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i> Product Deatils
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- body start --}}
                <div class="row mb-3">
                    <div class="col-sm-4"><b>Product Type:</b></div>
                    <div class="col-sm-5"><span id="productType" class="badge badge-dark"></span></div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Name:</b></div>
                    <div class="col-sm-5">
                        <p id="names"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Code:</b></div>
                    <div class="col-sm-5">
                        <p id="code"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Unit:</b></div>
                    <div class="col-sm-5">
                        <p id="unit"><strong></strong></p>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-sm-4"><b>Category:</b></div>
                    <div class="col-sm-5">
                        <p id="category"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Created BY:</b></div>
                    <div class="col-sm-5">
                        <p id="createdBy"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Updated BY:</b></div>
                    <div class="col-sm-5">
                        <p id="updatedBy"><strong></strong></p>
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

@section('product.index')
<script>
    $(function(){
    // YajraBox-Datatable
        var table =$('.yajra-datatable').DataTable({
            lengthMenu: [
                [ 15, 25, 50, -1 ],
                [ '15 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            processing:true,
            serverSide:true,
            ajax:"{{route('product.ajaxIndex')}}",
            columns:[
            {data: 'DT_RowIndex'},
            {data: 'name'},
            {data: 'code' },
            {data: 'unit'},
            {data: 'category'},
            {
            data: 'action',orderable: true, searchable: true,
            },
    ]
    });
    });
    $('body').on('click', '.viewProduct', function () {
        var btnId = $(this).attr("id");
        $('#productModel').modal('toggle');
        $.get("/product/"+btnId , function (data) {
        $('#productType').html(data.item_type);
        $('#names').html(data.name);
        $('#code').html(data.product_code);
        $('#unit').html(data.unit);
        $('#category').html(data.category.name);
        $('#updatedBy').html(data.editor.name);   
        $('#createdBy').html(data.creator.name);
        });
    });
    $('.close').click(function () {
    $('#productModel').modal('hide');
    });
    


    $('body').on('click', '.deleteProduct', function () {
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
            url:"/product/"+btnId,
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

</script>

@endsection

@endsection