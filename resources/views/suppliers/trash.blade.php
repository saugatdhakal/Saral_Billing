@extends('layouts.app')

@section('content')

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
</div>

@section('supplier.trash')
        <script>
          
          $(function(){
            // YajraBox-Datatable
            var table =$('.yajra-datatable').DataTable({
              processing:true,
              serverSide:true,
              ajax:"{{route('supplier.getTrash')}}",
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

            //Restore Deleted Data 
            $('body').on('click', '.restoreTrash', function (e){
            
              e.preventDefault();
              var btnId = $(this).attr("id");
              // alert(btnId);
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
                url:"restoreSupplier/"+btnId,
                data: {
                  "_token":$('input[name="_token"]').val(),
                  "id":btnId,
                },
                success: function(data){
                
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

        //Force Delete Data 
        $('body').on('click', '.deleteSupplier', function (e){
        e.preventDefault();
        var btnId = $(this).attr("id");
        // alert(btnId);
            swal({
            title: "Are you sure?",
            text: "Data will be permanently Deleted",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                type: "DELETE",
                url:"trashSupplier/"+btnId,
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
            
          };
          });

            });
      });

        </script>
@endsection
@endsection