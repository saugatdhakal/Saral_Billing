@extends('layouts.app')

@section('content')

<div class="row mb-3 p-0 mt-2 mr-3">
  
  <div class="col-md-12 clearfix ">
    <a class="float-right" href="{{route('supplier.create')}}">
      <button type="button" class="btn btn-outline-primary"  >
          <i class="fa fa-user"  aria-hidden="true"></i> Add Suppliers
        </button>
      </a>
  
  
  
    <a class="float-right mr-2"  href="{{route('supplier.trash')}}">
      <button type="button" class="btn btn-outline-danger"  >
        <i class="fas fa-user-times"></i> Trash Suppliers
        </button>
      </a>
    </div>
  


</div>
<div class="card mb-4 m-2">
    <div class="card-header">
        <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="tdue" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
       Supplier List
    </div>
    <div class="card-body">
        
        <table class="table table-striped table-bordered yajra-datatable">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>remark</th>
                    <th width="9%">Action</th>
                </tr>
            </thead>
           
            <tbody>
              
            </tbody>
        </table>

    </div>

    {{-- Bootstrap model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i>  Supplier Deatils</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {{-- body start --}}
              <div class="row mb-1">
                  <div class="col-sm-4"><b>Name:</b></div>
                  <div class="col-sm-5"><p id="name"></p></div>
              </div>
              <div class="row mb-1">
                <div class="col-sm-4"><b>Address:</b></div>
                <div class="col-sm-5"><p id="address"></p></div>
                </div>
                <div class="row mb-1" >
                    <div class="col-sm-4"><b>Contact Person:</b></div>
                    <div class="col-sm-5"><p id="person"><strong></strong></p></div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-4"><b>Contact Number:</b></div>
                    <div class="col-sm-5"><p id="number"><strong></strong></p></div>
                </div>
                <div class="row mb-1" >
                  <div class="col-sm-4"><b>Email:</b></div>
                  <div class="col-sm-5"><p id="email"><strong></strong></p></div>
              </div>
              <div class="row mb-1">
                <div class="col-sm-4"><b>Remark:</b></div>
                <div class="col-sm-5"><p id="remark"><strong></strong></p></div>
             </div>
             
              {{-- body stop --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="close"style="color: black;" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      @section('supplier.index')
        <script>
          
          $(function(){
            // YajraBox-Datatable
            var table =$('.yajra-datatable').DataTable({
              processing:true,
              serverSide:true,
              ajax:"{{route('supplier.getSuppliers')}}",
              columns:[
                
                {data: 'name', name: 'name'},
                {data: 'address' ,name : 'address'},
                {data: 'contact_person' , name: 'contact_person'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'email', name: 'email'},
                {data: 'remark', name: 'remark'},
               {
                 data: 'action', name: 'action',orderable: true, searchable: true,
               },
              ]
            });
            //Delete Supplier AJAX
            $('body').on('click', '.deleteSupplier', function () {
                var btnId = $(this).attr("id");
                // alert(btnId);
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
                    url:"delete/"+btnId,
                    data: {
                      "_token":$('input[name="_token"]').val(),
                      "id":btnId,
                    },
                    success: function(data){
                    //  alert(data); 
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

            //View Suppliers AJAX

            $('body').on('click', '.viewSuppliers', function () {
              var btnId = $(this).attr("id");
                // alert(btnId);
                $('#exampleModal').modal('toggle');
                $.get("view/"+btnId , function (data) {
                    // console.log(data);
                    $('#name').html(data.name);
                    $('#address').html(data.address);
                    $('#person').html(data.contact_person);
                    $('#number').html(data.contact_number);
                    $('#email').html(data.email);
                    $('#remark').html(data.remark);




                }
            );
              });
            $('.close').click(function () {
              $('#exampleModal').modal('toggle');
            });

            // $('.viewSuppliers').click(function () {
            //     var btnId = $(this).attr("id");
            //     alert(btnId);
            // })

          });
        </script>
      @endsection

@endsection