@extends('layouts.app')

@section('content')
<div class="card-body">
  <center>
    <h1><i class="fa-solid fa-industry-windows"></i> Supplier Trash</h1>
  </center>
</div>
<hr>
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
                  }else{
                    swal(" Sorry this Supplier Can't be deleted!!", {
                    icon: "error",
                    })
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