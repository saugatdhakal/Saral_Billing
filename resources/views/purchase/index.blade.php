@extends('layouts.app')
@section('content')

<div class="row mb-3 p-0 mt-2 mr-3">
    <div class="col-md-12 clearfix ">
        <a class="float-right mr-2" href="{{route('purchase.create')}}">
            <button type="button" id="add" class="btn btn-outline-primary float-right" data-bs-toggle="modal"
                data-bs-target="#category" autofocus>
                <i class="fa fa-user" aria-hidden="true"></i> Add Purchase
            </button>
        </a>
        <a class="float-right mr-2" href="{{route('product.productTrash')}}">
            <button type="button" class="btn btn-outline-danger">
                <i class="fas fa-user-times"></i> Trash Purchase
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
        Purchase List
    </div>

    <div class="card-body">

        <table class="table table-striped table-bordered  yajra-datatable" width="100%">
            <thead>
                <tr>
                    <th width="5%">SN</th>
                    <th>Supplier Name</th>
                    <th>Invoice No</th>
                    <th>Transaction date</th>
                    <th>Bill Date</th>
                    <th>Bill No</th>
                    <th>Lr No</th>
                    <th>Net Amount</th>
                    <th width="9%">Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </div>
</div>
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
                [ 30, 40, 50, -1 ],
                [ '30 rows', '40 rows', '50 rows', 'Show all' ]
            ],
            processing:true,
            serverSide:true,
            ajax:"{{route('purchase.ajaxIndex')}}",
            columns:[
            {data: 'DT_RowIndex'},
            {data: 'name'},
            {data: 'invoice_number' },
            {data: 'transaction_date'},
            {data: 'bill_date'},
            {data: 'bill_no'},
            {data: 'lr_no'},
            {data: 'net_amount'},
            {
            data: 'action',orderable: true, searchable: true,
            },
    ]
    });
    });
   

</script>

@endsection

@endsection