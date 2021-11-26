@extends('layouts.app')

@section('content')

<div class="row mb-3 p-0 mt-2 ">
  
  <div class="col-md-12 clearfix ">
    <a class="float-right" href="{{route('account.create')}}">
      <button type="button" class="btn btn-outline-primary"  >
          <i class="fa fa-user"  aria-hidden="true"></i> Create Customers
        </button>
      </a>
  
  
  
    <a class="float-right mr-2"  href="{{route('account.trash')}}">
      <button type="button" class="btn btn-outline-danger"  >
        <i class="fas fa-user-times"></i> Trash Customers
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
        
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>remark</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>remark</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @php $i=0; @endphp
                @foreach ($suppliers as $row )
                <tr>
                    <td>{{++$i}}</td>

                    <td>{{$row->name}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{empty($row->contact_number)? "EMPTY" : $row->contact_number}}</td>
                    <td>{{empty($row->contact_person)? "Empty" : $row->contact_person}}</td>
                    <td>{{empty($row->email)? "EMPTY": $row->email }}</td>
                    <td>{{empty($row->remark)? "EMPTY":$row->remark}}</td>
                    <td>
                        <a class="btnEdit" href="{{route('account.edit',['id'=>$row->id])}}">
                            <i class="far fa-edit fa-lg"></i> 
                        </a>
                        &#160 {{-- space  --}}
                        <a data-toggle="modal" class="view"  data-id="{{$row->id}}" data-target="#exampleModalCenter">
                             <i class="far fa-eye 
                             "></i>
                        </a>
                        &#160
                        <a class="deleteAccount" id="{{$row->id}}" >
                          <i class="fas fa-trash-alt fa-lg"></i>
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
                <div class="row" id="ShopNameDiv">
                    <div class="col-sm-4"><b>Shop Name:</b></div>
                    <div class="col-sm-5"><p id="customerShop"><strong></strong></p></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>House Address:</b></div>
                    <div class="col-sm-5"><p id="houseAddress"><strong></strong></p></div>
                </div>
                <div class="row" id="ShopAddress">
                  <div class="col-sm-4"><b>Shop Address:</b></div>
                  <div class="col-sm-5"><p id="shopAddress"><strong></strong></p></div>
              </div>
              <div class="row">
                <div class="col-sm-4"><b>Phone Number 1:</b></div>
                <div class="col-sm-5"><p id="contactNum1"><strong></strong></p></div>
             </div>
             <div class="row" id="Phone2">
              <div class="col-sm-4"><b>Phone Number 2:</b></div>
              <div class="col-sm-5"><p id="contactNum2"><strong></strong></p></div>
            </div>
            <div class="row">
              <div class="col-sm-4"><b>Email:</b></div>
              <div class="col-sm-5"><p id="emails"><strong></strong></p></div>
            </div>
            <div class="row" id="VATNO">
              <div class="col-sm-4"><b>Vat No:</b></div>
              <div class="col-sm-5"><p id="vatNo"><strong></strong></p></div>
            </div>
            <div class="row" id="PANNO">
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

@endsection