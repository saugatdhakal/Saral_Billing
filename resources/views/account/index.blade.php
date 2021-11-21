@extends('layouts.app')

@section('content')
@if(Session::has('success'))
    <script>
        swal("Customer Updated!", "{{Session::get('success')}}", "success");
    </script>
    {{-- {{Session::get('success')}} --}}
@endif
<div class="row m-2 mt-3">

    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            

            <div class="card-body text-success">
              <h1>
                  <center>{{$count}}</center>
              </h1>
            </div>

            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);background-color:yellow;"><h5>Total Customer</h5></div>
          </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            

            <div class="card-body text-success">
              <h1>
                  <center>{{$countBusiness}}</center>
              </h1>
            </div>

            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);"><h5>Business Customer</h5></div>
          </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            

            <div class="card-body text-success">
              <h1>
                  <center>{{$countIndividual}}</center>
              </h1>
            </div>

            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);"><h5>Individual Customer</h5></div>
          </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow mb-3" style="max-width: 18rem;">
            

            <div class="card-body text-success">
              <h1>
                  <center>{{$count}}</center>
              </h1>
            </div>

            <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);"><h5>New Customer</h5></div>
          </div>
    </div>
    
    
</div>
<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
    You are currently using <strong>BETA VERISON !!</strong> Features will be added in future .
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<div class="card mb-4 m-2">
    <div class="card-header">
        <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="tdue" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
       Customer List
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-5"></div>
            <div class="col-md-5"></div>
            
            <div class="col-md-2">   
                <a href="{{route('account.create')}}">
                <button type="button" class="btn btn-outline-primary"  >
                    <i class="fa fa-user"  aria-hidden="true"></i> Create Customers
                  </button>
                </a>
            </div>
        
        </div>
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
                @foreach ($users as $row )
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
                    <td>{{$row->vat_number}}</td>
                    <td>{{$row->pan_number}}</td>
                    <td>
                        <a href="{{route('account.edit',['id'=>$row->id])}}">
                            <i class="far fa-edit"></i> 
                        </a>
                        
                        <a data-toggle="modal" class="view"  data-id="{{$row->id}}" data-target="#exampleModalCenter">
                             <i class="far fa-eye"></i>
                        </a>
                        <a class="deleteAccount" id="{{$row->id}}" href="">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- Bootstrap model --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i>  Customer Deatils</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                {{-- body start --}}
              <div class="row">
                  <div class="col-sm-4"><h5>Name:</h5></div>
                  <div class="col-sm-5"><p id="customerName"></p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><b>Customer Type:</b></div>
                <div class="col-sm-5"><span id="customerType" class="badge badge-dark"></span></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Shop Name:</b></div>
                    <div class="col-sm-5"><p id="customerShop"><strong></strong></p></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>House Address:</b></div>
                    <div class="col-sm-5"><p id="houseAddress"><strong></strong></p></div>
                </div>
                <div class="row">
                  <div class="col-sm-4"><b>Shop Address:</b></div>
                  <div class="col-sm-5"><p id="shopAddress"><strong></strong></p></div>
              </div>
              <div class="row">
                <div class="col-sm-4"><b>Phone Number 1:</b></div>
                <div class="col-sm-5"><p id="contactNum1"><strong></strong></p></div>
             </div>
             <div class="row">
              <div class="col-sm-4"><b>Phone Number 2:</b></div>
              <div class="col-sm-5"><p id="contactNum2"><strong></strong></p></div>
            </div>
            <div class="row">
              <div class="col-sm-4"><b>Email:</b></div>
              <div class="col-sm-5"><p id="emails"><strong></strong></p></div>
            </div>
            <div class="row">
              <div class="col-sm-4"><b>Vat No:</b></div>
              <div class="col-sm-5"><p id="vatNo"><strong></strong></p></div>
            </div>
            <div class="row">
              <div class="col-sm-4"><b>Pan No:</b></div>
              <div class="col-sm-5"><p id="panNo"><strong></strong></p></div>
            </div>
              {{-- body stop --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              
            </div>
          </div>
        </div>
      </div>

      {{-- Ajax --}}
      @section('account.index')
      <script>
          $(document).ready(function() {
            $(".view").click(function(){

           const id = $(this).attr("data-id");
            
           $.ajax({
               type: "GET",
               url:"view/"+id,
               data:{
                  id 
               },
               success: function(data) {
                   
                $('#customerName').html(data.name);
                $('#customerType').html(data.account_type);
                $('#customerShop').html(data.shop_name);
                $('#houseAddress').html(data.home_address);
                $('#shopAddress').html(data.shop_address);
                $('#contactNum1').html(data.contact_number_1);
                $('#contactNum2').html(data.contact_number_2);
                $('#emails').html(data.email);
                $('#vatNo').html(data.vat_number);
                $('#panNo').html(data.pan_number);

               }
           })
       });

    });
      </script>
      <script>
        $(document).ready(function(){
          
          $(".deleteAccount").click(function(e){
            e.preventDefault();
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
                // else {
                //   swal("Your imaginary file is safe!");
                // }
          });
          });
        });
      </script>
          
      @endsection
@endsection