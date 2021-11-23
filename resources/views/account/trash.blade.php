@extends('layouts.app')

@section('content')
<div class="card-body">
  <center>Trash </center>
</div>

<div class="card-body m-2">
        
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>SN</th>
                <th width="10%">Customer Type</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Vat Number</th>
                <th>Pan Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>SN</th>
                <th>Customer Type</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Vat Number</th>
                <th>Pan Number</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            @php $i=0; @endphp
            @foreach ($trash as $row )
            <tr>
                <td>{{++$i}}</td>
                <td>
                    @if($row->account_type == "Business")
                    <span class="badge badge-primary">Business</span> 
                    @else
                    <span class="badge badge-secondary">Individual</span>
                    @endif
                </td>
                <td>{{$row->name}}</td>
                <td>{{($row->account_type == "Business")? $row->shop_address: $row->home_address}}</td>
                <td>{{$row->contact_number_1}}</td>
                <td>{{empty($row->vat_number)? "EMPTY": $row->vat_number }}</td>
                <td>{{empty($row->pan_number)? "EMPTY":$row->pan_number}}</td>
                <td>
                    <a class="restoreTrash" id="{{$row->id}}">
                        <i class="fas fa-undo-alt fa-lg"></i>
                    </a>
                    &#160
                    &#160
                     <a class="deleteAccount" id="{{$row->id}}">
                        <i class="fas fa-trash-alt fa-lg"></i>
                    </a>
                </td>
                @endforeach
        </tbody>
    </table>

</div>
@section('account.trash')
<script>

   /// Restore Trash
   $(document).ready(function(){
        $(".restoreTrash").click(function(e){
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
                url:"trashRestore/"+btnId,
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
            // else {
            //   swal("Your imaginary file is safe!");
            // }
      });
      });
    });

    //Force delete trash account
    $(document).ready(function(){
      
      $(".deleteAccount").click(function(e){
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
                url:"trashDelete/"+btnId,
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
            // else {
            //   swal("Your imaginary file is safe!");
            // }
      });
      });
    });
       


  </script>
      
  @endsection
@endsection