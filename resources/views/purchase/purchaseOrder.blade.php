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
                <div class="col-md-2" style="font-size: 17px;">
                    Bill Date : {{$data->bill_date}}
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
                <div class="col-md-2" style="font-size: 17px;">
                    Invocie No: {{$data->invoice_number}}
                </div>
            </div>
        </div>
    </div>
    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">

        @foreach ($errors->all() as $err)

        <li style="color:red">{{$err}}</li>
        @endforeach

    </div>
    @endif
    {{-- Error on repeated product --}}
    <div class="row">
        <div class="col-md">
            @if (Session::has('fail'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (Session::get('fail') as $session)
                    <li>{{$session}}</li>
                    @endforeach
                    {{-- <li>{!! \Session::get('fail') !!}</li> --}}
                </ul>
            </div>
            @endif
        </div>
    </div>
    <form action="{{route('purchaseItem.store',['id'=>$data->purchase_id])}}" method="POST">
        @csrf
        <div class="card m-2 shadow">
            <div class="row m-2">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Product Name / Code</label>
                        <select class="selects form-control form-select " style="width: 100%" name="productId"
                            autofocus>
                            <option value="" selected disabled>---Select Product -----</option>
                            @foreach ($product as $row)
                            <option data-id="{{$row->unit}}" value="{{$row->id}}">{{$row->name}} /
                                {{$row->product_code}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <label class="fw-bold">Quantity</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="quantity" min="1" step="0.01"
                            placeholder="Quantity">

                        <span class="input-group-text fw-bold" id="unit">pcs</span>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Rate</label>
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="rate" placeholder="Rate">
                            <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Discount</label>
                        <div class="input-group">
                            <input type="number" min="1" step="0.01" min="0" class="form-control"
                                name="discount_percent" placeholder="Discount">
                            <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
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

    {{-- Product List table --}}
    <div class="card mb-4 m-2">


        <div class="card-body shadow">

            <table class="table table-striped   yajra-datatable" width="100%">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Product Name / Code</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Discount %</th>
                        <th>Margin Total</th>
                        <th width="9%">Action</th>

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
                        <td>{{$row->discount_percent}}%</td>
                        <td>{{$row->margin_total}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="edit" data-id="{{$row->id}}" data-bs-toggle="modal"
                                        data-bs-target="#productList">
                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                    </a>

                                </div>
                                <div class="col-md-5">
                                    <a class="delete" data-id="{{$row->id}}">
                                        <i class="fa-solid fa-trash-can-list fa-xl "></i>
                                    </a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            @php
            $discount=$list->sum('discount_amount')
            @endphp
            @php
            $amount = $list->sum('amount');
            @endphp
            <div class="" style="margin-right: 280px;">
                <div class="row float-right ">

                    <p class="fw-bold" style="font-size:18px">Total Amount : <span id="totalAmount">
                            @if ($amount == 0)
                            0
                            @else
                            {{$amount}}
                            @endif
                        </span></p>
                </div>
                <br>
                <br>
                
                <div class="row float-right">
                    <p class="fw-bold" style="font-size:18px">Discount Amount : <span id="discountAmount">
                            @if ($discount == 0)
                            0
                            @else
                            {{$discount}}
                            @endif
                        </span>
                    </p>
                </div>
                <br>
                <br>
                @php
                $roundedAmount =ceil($amount - $discount);
                $rounded=round($roundedAmount-($amount - $discount),2);
                @endphp
                <div class="row float-right ">
                
                    <p class="fw-bold" style="font-size:18px">Round Up : <span id="roundUp">
                            @if ($amount == 0)
                            0
                            @else
                           
                            {{$rounded}}
                            @endif
                        </span></p>
                </div>
                <br>
                <br>
                <div class="row float-right">
                    <p class="fw-bold" style="font-size:18px">Net Amount : <span id="netAmount">
                            @if ($list->sum('discount_amount') == 0 && $list->sum('amount') == 0)
                            0
                            @else
                            {{$roundedAmount}}
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Extra Purchase Amount and save button --}}
<div class="card m-2">
    <div class="card-body shadow ">
        <form action="{{route('purchaseItem.completeInvoice',['id'=>$data->purchase_id])}}" method="POST">
            @csrf

            <div class="row m-2">

                <div class="col-md-3">
                    <label class="fw-bold">GST</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="gst" step="0.01"  placeholder="Amount">

                        <span class="input-group-text fw-bold" id="unit"><i class="fa-solid fa-coin"></i></span>
                    </div>
                    <br>
                    <label class="fw-bold">Extra charge</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="extra_amount"  step="0.01" placeholder="Amount">

                        <span class="input-group-text fw-bold" id="unit"><i
                                class="fa-solid fa-truck-container"></i></span>
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="fw-bold">Remark</label><br />
                    <textarea name="remark" cols="40" rows="5"></textarea>
                </div>
                <div class="col-md-2 mt-5">
                    <br>
                    <button type="submit" style="font-size: 17px" class="btn btn-success"><i
                            class="fa-solid fa-floppy-disk-circle-arrow-right"></i>
                        Finish and Save </button>
                </div>

            </div>
        </form>
    </div>

</div>

{{-- Product Model --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-regular fa-cart-plus"></i> ADD PRODUCT
                </h5>
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
                                <br>

                                <div class="row ">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary m-2"><i
                                                class="fa-solid fa-plus"></i> Add item</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-secondary m-2 " data-bs-dismiss="modal"><i
                                                class="fa-solid fa-xmark"></i> Close</button>
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

{{-- Edit Product List --}}
<div class="modal fade" id="productList" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-regular fa-cart-plus"></i> Edit PRODUCT
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height:800px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <form action="{{route('purchaseItem.updateList')}}" method="POST">
                                @csrf
                                <input type="number" id="id" name="id" hidden required>
                                <div class="div">
                                    <select id="selected" class=" form-control form-select " style="width: 100%"
                                        name="productId">
                                        <option value="" selected disabled>---Select Product -----</option>
                                        @foreach ($product as $row)
                                        <option data-id="{{$row->unit}}" value="{{$row->id}}">{{$row->name}} /
                                            {{$row->product_code}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <br>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="modelQuantity" min="1" step="0.01"
                                        name="quantity" placeholder="Quantity" required>

                                    <span class="input-group-text fw-bold" id="unit">pcs</span>
                                </div>
                                <br>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="modelRate" name="rate"
                                        placeholder="Rate" required>
                                    <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                </div>
                                <br>
                                <div class="input-group">
                                    <input type="number" class="form-control" min="0" step="0.01" id="modelDis"
                                        name="discount_percent" placeholder="Discount">
                                    <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                                </div>
                                <br>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="modelWhole" name="wholesalePrice"
                                        placeholder="Wholesale" required>
                                    <span class="input-group-text"><i class="fa-solid fa-rupee-sign"></i></span>
                                </div>
                                <br>
                                <br>

                                <div class="row ">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary m-2"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit item</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-secondary m-2 " data-bs-dismiss="modal"><i
                                                class="fa-solid fa-xmark"></i> Close</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@section('purchase.purchaseOrder')
<script>
    $(document).ready(function() {
        // *  datatable //

    
    $('.yajra-datatable').DataTable({
        "bPaginate": false,
        "paging": false,
    });

    // unit chnage
    $("select").change(function() {
        
        const unit= $(this).find(':selected').attr('data-id')
        $('#unit').html(unit);
    });
    
    //Deleting Product list 
   $('body').on('click', '.delete', function () {
    var btnId = $(this).attr("data-id");
    $.ajax({
        type: "DELETE",
        url:"/purchaseItem/deletePurchaseList/"+btnId,
        data: { 
            "_token":$('input[name="_token"]').val(),
            "id":btnId,
        },
        success: function(data){
        window.location.reload();
        }
    }
    );
    });

    //Editing
    $('body').on('click', '.edit', function () {
        var btnId = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "/purchaseItem/editProductList/"+btnId,
            data: {
                'id': btnId,
            }, 
            success: function (data) {
                $('#selected').val(data.product_id);
               $('#selected').select2(
                   {
                    theme: "bootstrap-5",
                    dropdownParent: $('#productList .modal-content')
                   }
               ).trigger('change');
               
                $('#id').val(data.id);
               $('#modelQuantity').val(data.quantity);
               $('#modelRate').val(data.rate);
               $('#modelDis').val(data.discount_percent);
               $('#modelWhole').val(data.wholesale_price);
            }
        })
    });


    

        // * Alert Animation //
     $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () { 
        $(this).remove();
     });

 //    Product code in bootstrap model
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
                  );
        }
    );



// * select 2 implementation //
    $('#selecteds').select2(
    {
    theme: "bootstrap-5",
    dropdownParent: $('#staticBackdrop .modal-content')
    }
    );
    $('#selected').select2(
    {
    theme: "bootstrap-5",
    dropdownParent: $('#productList .modal-content')
    }
    );


    // * button if no result found in product select //
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