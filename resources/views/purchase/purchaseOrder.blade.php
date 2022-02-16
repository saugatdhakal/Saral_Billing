@extends('layouts.app')
@section('content')
<div class="continer-fluid">
    {{-- top-level --}}
    <div class="card m-2">
        <div class="card card-body shadow ">
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    Bill From : {{$data->supplier_name}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size: 17px;">
                    Purchase Date : {{$data->purchase_date }}
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    Address : {{$data->address}}
                </div>
                <div class="col-md-5 fw-bold" style="font-size: 20px;"> Purchase #{{$data->invoice_number}}</div>
                <div class="col-md-2" style="font-size: 17px;">
                    Transaction Date : {{$data->transaction_date}}
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    LR No: {{$data->lr_no}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-3" style="font-size: 17px;">
                    Bill Date: {{$data->bill_date}}
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">

        @foreach ($errors->all() as $err)

        <li style="color:red">{{$err}}</li>
        @endforeach

    </div>
    @endif
    <form action="{{route('purchaseItem.store',['id'=>$data->purchase_id])}}" method="POST">
        @csrf
        <div class="card m-2 shadow">
            <div class="row m-2">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Product Name / Code</label>
                        <select class="selects form-control form-select " style="width: 100%" name="productId">
                            <option value="" selected disabled>---Select Product -----</option>
                            @foreach ($product as $row)
                            <option data-id="{{$row->unit}}" value="{{$row->id}}">{{$row->name}} /
                                {{$row->product_code}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label class="fw-bold">Quantity</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity">

                        <span class="input-group-text fw-bold" id="unit">pcs</span>
                    </div>
                </div>

                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Rate</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="rate" placeholder="Rate">
                            <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Wholesale</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="wholesalePrice" placeholder="Wholesale">
                            <span class="input-group-text"><i class="fa-solid fa-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button type="submit" class="btn btn-primary m-2"><i class="fa-solid fa-plus"></i> Add item</button>
            </center>
        </div>
    </form>


    <div class="card mb-4 m-2">


        <div class="card-body shadow">

            <table class="table table-striped table-bordered  yajra-datatable" width="100%">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Product Name / Code</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Whole Sale</th>
                        <th>Margin Total</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @if($list)
                    @php $i=0; @endphp
                    @foreach ($list as $row )
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$row->name}} / {{$row->product_code}}</td>
                        <td>{{$row->unit}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>{{$row->rate}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->wholesale_price}}</td>
                        <td>{{$row->margin_total}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <button style="width: 100%" type="button" id="{{$row->id}}"
                                        class="btn btn-success edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                </div>
                                <div class="col-md-5">
                                    <button style="width: 100%" type="button" id="{{$row->id}}"
                                        class="btn btn-danger delete">
                                        <i class="fa-solid fa-circle-minus"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- Product Model --}}
<div class="modal fade" id="staticBackdrop" style="overflow:hidden;" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height:800px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <form action="{{route('product.store')}}" method="POST">
                                @csrf

                                <div class="container">
                                    <input class="form-check-input" type="radio" name="item_type" id="exampleRadios1"
                                        value="SALES" checked>


                                    <label class="form-check-label" for="exampleRadios1">
                                        Sales
                                    </label>
                                    &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;

                                    <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2"
                                        value="SERVICE">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Serivce
                                    </label>
                                </div>
                                <br>
                                <input type="number" name="code" id="pro_code" value="" placeholder="Product Code"
                                    class="form-control" required>
                                <br>
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Name" autofocus required>
                                <br>
                                <select class="select form-control form-select" style="width: 100%" name="unit">
                                    <option value="" selected disabled>---Select Product Unit---</option>
                                    <option value="mtr">MTR</option>
                                    <option value="cm">CM</option>
                                    <option value="pcs">PCS</option>
                                </select>
                                <br>
                                <select id="selecteds" class="select form-control form-select" style="width: 100%"
                                    name="category">
                                    <option value="" selected disabled>---Select Category Unit---</option>
                                    {{$rows = DB::table('categories')->where('deleted_by',NULL)->get(['id','name']);}}
                                    @foreach ($rows as $row)
                                    <option value={{$row->id}} >{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <br>

                                <div class="row">
                                    <div class="col-md-3">
                                        <input value="submit" type="submit"
                                            class="m-2 bg-primary btn text-white fw-bold">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-secondary m-2"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> --}}
        </div>
    </div>
</div>

@section('purchase.purchaseOrder')
<script>
    $(document).ready(function() {

    $('.yajra-datatable').DataTable({
        "bPaginate": false,
        "info": false,
        "paging": false,
    });
    $("select").change(function() {
        
        const unit= $(this).find(':selected').attr('data-id')
        $('#unit').html(unit);
        
        // alert(unit);
    });
    // document.addEventListener ("keydown", function (zEvent) {
    //     // && zEvent.altKey zEvent.ctrlKey
    // if ( zEvent.altKey && zEvent.key == "ƒ") { // case sensitive
    //     alert("got it");
    // }
    // zEvent.stopPropagation ();       
    // zEvent.preventDefault ();
    // } );
        $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
        
        $(this).remove();
        });

   $('body').on('click', '.prod', function () {
        $.ajax({
                    type: "GET",
                    url:"/purchaseItem/getProductCode",
                    data: {  },
                    success: function(data){
                    //   alert(data); 
                      $('#pro_code').val(data);
                      }

                    }
                  )
        }
    );

$('#selecteds').select2(
{
theme: "bootstrap-5",
dropdownParent: $('#staticBackdrop .modal-content')
}
);

$('.selects').select2(
{
theme: "bootstrap-5",
    language: {
    noResults: function() {
    return `<button style="width: 100%" type="button"  class="btn btn-primary prod" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">+ Add New Item</button>
    </li>`;
    }
    },
    
    escapeMarkup: function (markup) {
    return markup;
    }

}
);
});

</script>


@endsection

@endsection