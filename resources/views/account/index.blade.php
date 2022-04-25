@extends('layouts.app')

@section('content')
<div class="container-fluid">
  @if(Session::has('success'))
  <script>
    swal("Customer Updated!", "{{Session::get('success')}}", "success");
  </script>
  {{-- {{Session::get('success')}} --}}
  @endif
  @if(Session::has('successes'))
  <script>
    swal("Customer Created!", "{{Session::get('successes')}}", "success");
  </script>
  {{-- {{Session::get('success')}} --}}
  @endif
  <div class="m-2">
    <h1>
      &#160 <u> Account Dashboard</u>
    </h1>

  </div>
  <div class="row m-2 mt-3">

    <div class="col-md-3">
      <div class="card shadow mb-3" style="max-width: 18rem;">


        <div class="card-body text-success">
          <h1>
            <center>{{DB::table('accounts')->where('deleted_by',NULL)->get()->count();}}</center>
          </h1>
        </div>

        <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);background-color:yellow;">
          <h5>Total Customer</h5>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-3" style="max-width: 18rem;">


        <div class="card-body text-success">
          <h1>
            <center>{{DB::table('accounts')->where('deleted_by',NULL)->where('account_type','BUSINESS')->count();}}
            </center>
          </h1>
        </div>

        <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
          <h5>Business Customer</h5>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-3" style="max-width: 18rem;">


        <div class="card-body text-success">
          <h1>
            <center>{{DB::table('accounts')->where('deleted_by',NULL)->where('account_type','INDIVIDUAL')->count();}}
            </center>
          </h1>
        </div>

        <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
          <h5>Individual Customer</h5>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card shadow mb-3" style="max-width: 18rem;">


        <div class="card-body text-success">
          <h1>
            <center>{{DB::table('accounts')->get()->count();}}</center>
          </h1>
        </div>

        <div class="card-footer bg-transparent shadow " style="color:rgb(128,128,128);">
          <h5>New Customer</h5>
        </div>
      </div>
    </div>


  </div>
  <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
    You are currently using <strong>BETA VERISON !!</strong> Features will be added in future .
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="row mb-2 p-0  ">
    <div class="col-md-8"></div>
    <div class="col-md-2">
      <a href="{{route('account.create')}}">
        <button type="button" class="btn btn-outline-primary">
          <i class="fa fa-user" aria-hidden="true"></i> Create Customers
        </button>
      </a>
    </div>

    <div class="col-md-2 p-0">
      <a href="{{route('account.trash')}}">
        <button type="button" class="btn btn-outline-danger">
          <i class="fas fa-user-times"></i> Trash Customers
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
      Customer List
    </div>

    <div class="card-body">

      <table id="datatable">
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

        </tfoot>
        <tbody>
          @php $i=0; @endphp
          @foreach ($users as $row )
          <tr>
            <td>{{++$i}}</td>
            <td>
              @if($row->account_type == "BUSINESS")
              <span class="badge badge-primary">BUSINESS</span>
              @else
              <span class="badge badge-secondary">INDIVIDUAL</span>
              @endif
            </td>
            <td>{{$row->name}}</td>
            <td>{{($row->account_type == "Business")? $row->shop_address: $row->home_address}}</td>
            <td>{{$row->contact_number_1}}</td>
            <td>{{empty($row->vat_number)? "EMPTY": $row->vat_number }}</td>
            <td>{{empty($row->pan_number)? "EMPTY":$row->pan_number}}</td>
            <td>
              <a class="btnEdit" href="{{route('account.edit',['id'=>$row->id])}}">
                <i class="far fa-edit fa-lg"></i>
              </a>
              &#160 {{-- space --}}
              <a data-toggle="modal" class="view" data-id="{{$row->id}}" data-target="#supplierDetails">
                <i class="far fa-eye fa-lg"></i>
              </a>
              &#160
              <a class="deleteAccount" id="{{$row->id}}">
                <i class="fas fa-trash-alt fa-lg"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


  {{-- Bootstrap model --}}
  <div class="modal fade" id="supplierDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-address-card"></i> Customer Deatils</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- body start --}}
          <div class="row">
            <div class="col-sm-4">
              <h5>Name:</h5>
            </div>
            <div class="col-sm-5">
              <p id="customerName"></p>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4"><b>Customer Type:</b></div>
            <div class="col-sm-5"><span id="customerType" class="badge badge-dark"></span></div>
          </div>
          <div class="row" id="ShopNameDiv">
            <div class="col-sm-4"><b>Shop Name:</b></div>
            <div class="col-sm-5">
              <p id="customerShop"><strong></strong></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4"><b>House Address:</b></div>
            <div class="col-sm-5">
              <p id="houseAddress"><strong></strong></p>
            </div>
          </div>
          <div class="row" id="ShopAddress">
            <div class="col-sm-4"><b>Shop Address:</b></div>
            <div class="col-sm-5">
              <p id="shopAddress"><strong></strong></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4"><b>Phone Number 1:</b></div>
            <div class="col-sm-5">
              <p id="contactNum1"><strong></strong></p>
            </div>
          </div>
          <div class="row" id="Phone2">
            <div class="col-sm-4"><b>Phone Number 2:</b></div>
            <div class="col-sm-5">
              <p id="contactNum2"><strong></strong></p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4"><b>Email:</b></div>
            <div class="col-sm-5">
              <p id="emails"><strong></strong></p>
            </div>
          </div>
          <div class="row" id="VATNO">
            <div class="col-sm-4"><b>Vat No:</b></div>
            <div class="col-sm-5">
              <p id="vatNo"><strong></strong></p>
            </div>
          </div>
          <div class="row" id="PANNO">
            <div class="col-sm-4"><b>Pan No:</b></div>
            <div class="col-sm-5">
              <p id="panNo"><strong></strong></p>
            </div>
          </div>
          {{-- body stop --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
</div>
{{-- Ajax --}}
@section('account.index')
<script>
  $('#datatable').DataTable({
    
  })
  $(document).ready(function() {

        $(".close").click(function(){
          $('#supplierDetails').modal('hide');
        });
        $(".btn").click(function(){
        $('#supplierDetails').modal('hide');
        });
            $(".view").click(function(){
            $('#supplierDetails').modal('toggle');
           const id = $(this).attr("data-id");
           console.log(id); 
           $.ajax({
               type: "GET",
               url:"view/"+id,
               data:{
                  id 
               },
               cache: false,
               success: function(data) {
                if(data.account_type=="INDIVIDUAL"){
                  $('#ShopNameDiv').hide();
                  $('#ShopAddress').hide();
                  $('#Phone2').hide();
                  $('#VATNO').hide();
                  $('#PANNO').hide();
                  
                }
                else if(data.account_type=="BUSINESS"){
                  $('#ShopNameDiv').show();
                  $('#ShopAddress').show();
                  $('#Phone2').show();
                  $('#VATNO').show();
                  $('#PANNO').show();
                  $('#customerShop').html(data.shop_name);
                  $('#shopAddress').html(data.shop_address);
                  $('#contactNum2').html(data.contact_number_2);
                  $('#vatNo').html(data.vat_number);
                  $('#panNo').html(data.pan_number)
                  }
                $('#customerName').html(data.name);
                $('#customerType').html(data.account_type);
                $('#houseAddress').html(data.home_address);
                $('#contactNum1').html(data.contact_number_1);
                $('#emails').html(data.email);
                
                
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