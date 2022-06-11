@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-2">
        <center>
            <h1>
                <i class="fa-solid fa-truck-bolt"></i> Transport Dashboard
            </h1>
        </center>
    </div>


    <div class="row mb-3 p-0 mt-2 mr-3">

        <div class="col-md-12 clearfix ">
            <a class="float-right" href="{{route('transport.create')}}">
                <button type="button" class="btn btn-outline-primary" autofocus>
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
    <hr>
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

    {{-- Bootstrap model --}}
    <div class="modal fade" id="transportModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i> Transport
                        Deatils
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