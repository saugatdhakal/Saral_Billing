@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="m-2">
    <h1>
        &#160 <u> Transport Dashboard</u>
    </h1>
</div>
<div class="row m-2 mt-3">
    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            <div class="card-body text-success">
                <h1>
                    1
                </h1>
            </div>
            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
                <h5>Total Transport</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            <div class="card-body text-success">
                <h1>
                    1
                </h1>
            </div>
            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
                <h5>Total Transport</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            <div class="card-body text-success">
                <h1>
                    1
                </h1>
            </div>
            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
                <h5>Total Transport</h5>
            </div>
        </div>
    </div>
</div>

    <div class="row mb-3 p-0 mt-2 mr-3">

        <div class="col-md-12 clearfix ">
            <a class="float-right" href="{{route('transport.create')}}">
                <button type="button" class="btn btn-outline-primary">
                    <i class="fa fa-user" aria-hidden="true"></i> Add Transport
                </button>
            </a>



            <a class="float-right mr-2" href="{{route('transport.trash')}}">
                <button type="button" class="btn btn-outline-danger">
                    <i class="fas fa-user-times"></i> Trash Transport
                </button>
            </a>
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
        Supplier List
    </div>

    <div class="card-body">
        
        <table class="table table-striped table-bordered  yajra-datatable" width="100%">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Remark</th>
                    <th width="9%">Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </div>
</div>
{{-- Bootstrap model --}}
<div class="modal fade" id="transportModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i> Transport Deatils
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- body start --}}
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Name:</b></div>
                    <div class="col-sm-5">
                        <p id="names"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Address:</b></div>
                    <div class="col-sm-5">
                        <p id="address"></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Contact Number:</b></div>
                    <div class="col-sm-5">
                        <p id="number"><strong></strong></p>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-sm-4"><b>Remark:</b></div>
                    <div class="col-sm-5">
                        <p id="remark"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Created By:</b></div>
                    <div class="col-sm-5">
                        <p id="created_by"><strong></strong></p>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Updated By:</b></div>
                    <div class="col-sm-5">
                        <p id="updated_by"><strong></strong></p>
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
</div>
{{-- Model end --}}
@section('transport.index')
<script>
    $(function(){
            // YajraBox-Datatable
            var table =$('.yajra-datatable').DataTable({
            lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
              processing:true,
              serverSide:true,
              ajax:"{{route('transport.yajraTableIndex')}}",
              columns:[
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'address' },
                {data: 'contact_number'},
                {data: 'remark'},
                {
                    data: 'action',orderable: true, searchable: true,
                },
              ] 
            });

           
    });
    // Mode View Details of Tranport
    $('body').on('click', '.viewTransport', function () {
    
    var btnId = $(this).attr("id");
    // alert(btnId);
    $('#transportModel').modal('toggle');
    $.get("/transport/view/Model/"+btnId , function (data) {
     $('#names').html(data.name);
     $('#address').html(data.address);
     $('#number').html(data.contact_number);
     $('#remark').html(data.remark);
     $('#created_by').html(data.creator.name);
    $('#updated_by').html(data.editor.name);
    }
    );
    });
    $('.close').click(function () {
    $('#transportModel').modal('hide');
    });
    
    $('body').on('click', '.deleteTransport', function () {
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
        url:"/transport/"+btnId,
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