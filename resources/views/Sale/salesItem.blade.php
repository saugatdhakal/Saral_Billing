@extends('layouts.app')
@section('content')
<div class="continer-fluid">
    {{-- top-level --}}
    <div class="card m-2">
        <div class="card card-body shadow ">
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    Bill To : {{$sales->name}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-2" style="font-size: 17px;">
                    Bill Date : {{$sales->sales_date}}
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    Home Address : {{$sales->home_address}}
                </div>
                <div class="col-md-5 fw-bold" style="font-size: 20px;"> SALES # {{$sales->invoice_number}} </div>
                <div class="col-md-2" style="font-size: 17px;">
                    Transaction Date : {{$sales->transaction_date}}
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-4" style="font-size: 17px;">
                    Shop Addrresses : {{empty($sales->shop_address)? 'EMPTY':$sales->shop_address}}
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-2" style="font-size: 17px;">
                    Invocie No: {{$sales->invoice_number}}
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
    {{!! Toastr::message() !!}}
    <form action="{{route('salesItem.store',['id'=>$sales->id])}}" method="POST">
        @csrf
        <div class="card m-2 shadow">
            <div class="row m-2">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Product Name / Code</label>
                        <select class=" form-select " id="productSelect" style="width: 100%" name="productId" autofocus>
                            <option value="" selected disabled>---Select Product -----</option>
                            @foreach ($product as $row)
                            <option data-id="{{$row->unit}}" value="{{$row->id}}">{{$row->name}} /
                                {{$row->product_code}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12" id="stockSelect" style="display: none">
                    <label class="fw-bold">Stock</label>
                    <select name="stockId" id="stocks" class="form-select">
                    </select>
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
                    <label class="fw-bold" for="exampleInputEmail1">Re-Rate</label>
                    <div class="input-group">
                        <input type="number" id="re-Rate" class="form-control" name="reRate"
                            aria-label="Text input with segmented dropdown button" min="1" step="0.01">

                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li id="1.1"><a class="dropdown-item ">1.1</a></li>
                            <li id="1.2"><a class="dropdown-item np">1.2</a></li>
                            <li id="1.3"><a class="dropdown-item np">1.3</a></li>
                            <li id="1.4"><a class="dropdown-item np">1.4</a></li>
                            <li id="1.5"><a class="dropdown-item np">1.5</a></li>
                            <li id="1.6"><a class="dropdown-item np">1.6</a></li>
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">Discount Amount</label>
                        <div class="input-group">
                            <input type="number" min="1" step="0.01" min="0" class="form-control" name="discount_amount"
                                placeholder="">
                            <span class="input-group-text"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                        </div>
                    </div>
                </div>

            </div>
            <center>
                <button type="submit" class="btn btn-primary m-2"><i class="fa-solid fa-plus"></i> Add item</button>
            </center>
        </div>
    </form>
    <div class="card m-2">
        <div class="card-body shadow">
            <table class="table table-striped dataTable" width="100%">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Product Name / Code</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th width="9%">Discount Amount</th>
                        <th width="9%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0 @endphp
                    @foreach ($saleItems as $row )
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->unit}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>{{$row->rate}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->discount_amount}}</td>
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
                </tbody>
            </table>
            @php
            $discount=$saleItems->sum('discount_amount')
            @endphp
            @php
            $amount = $saleItems->sum('amount');
            @endphp
            <div class="" style="margin-right: 290px;">
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
                            @if ($discount == 0 && $amount == 0)
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

    {{-- Edit Product List --}}
    <div class="modal fade" id="productList" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-regular fa-cart-plus"></i> Edit Sales
                        Item
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height:800px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <form action="{{route('salesItem.updateSalesItem',['id'=>$sales->id])}}" method="POST">
                                    @csrf
                                    <input type="number" id="id" name="id" hidden required>

                                    <div class="div">
                                        <select class=" form-select " id="productSelectModel" style="width: 100%"
                                            name="productId" autofocus>
                                            <option value="" selected disabled>---Select Product -----</option>
                                            @foreach ($product as $row)
                                            <option data-id="{{$row->unit}}" value="{{$row->id}}">{{$row->name}} /
                                                {{$row->product_code}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <br>
                                    <div id="stockSelect">

                                        <select name="stockId" id="moduleStocks" class="form-select">
                                        </select>
                                    </div>

                                    <br>

                                    <div class="input-group">
                                        <div class="input-group">
                                            <input type="number" id="modelQuantity" class="form-control" name="quantity"
                                                min="1" step="0.01" placeholder="Quantity">
                                            <span class="input-group-text fw-bold" id="unit">pcs</span>
                                        </div>
                                    </div>

                                    <br>


                                    <div class="input-group">
                                        <input type="number" id="moduleReRate" class="form-control" name="reRate"
                                            aria-label="" placeholder="Re-Rate" min="1" step="0.01">

                                        <button type="button"
                                            class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li id="1.1"><a class="dropdown-item ">1.1</a></li>
                                            <li id="1.2"><a class="dropdown-item np">1.2</a></li>
                                            <li id="1.3"><a class="dropdown-item np">1.3</a></li>
                                            <li id="1.4"><a class="dropdown-item np">1.4</a></li>
                                            <li id="1.5"><a class="dropdown-item np">1.5</a></li>
                                            <li id="1.6"><a class="dropdown-item np">1.6</a></li>
                                            {{-- <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                                        </ul>
                                    </div>


                                    <br>

                                    <div class="input-group">
                                        <input type="number" class="form-control" id="modelDiscountA"
                                            name="discount_amount" placeholder="Wholesale" required>
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
                                            <button type="button" class="btn btn-secondary m-2 "
                                                data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
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

    @section('sales.salesItem')
    <script>
        $(document).ready(function() {
        // *  datatable //

    
    $('.dataTable').DataTable({
        "bPaginate": false,
        "paging": false,
    });
    //*Re-Rate calculating 
    $('ul.dropdown-menu li').click(function(e)
    {
        e.preventDefault();
        var rate = $(this).attr('id');
        var amount = $('#stocks').find(":selected").attr('data-rate');
        $('#re-Rate').val(parseInt(rate*amount));
    //    alert();
      
    });

    // unit chnage
    $("select").change(function() {
        
        const unit= $(this).find(':selected').attr('data-id')
        $('#unit').html(unit);
        
        // alert(unit);
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
        // alert(data);
        // $('#sel_users').val(data.product_id);
        // $('#sel_users').select2().trigger('change');
        window.location.reload();
        }
    }
    );
    });

    //Editing
    $('body').on('click', '.edit', function () {
        var btnId = $(this).attr("data-id");
        // alert(btnId);
        $.ajax({
            type: "GET",
            url: "/salesItem/stockEdit/"+btnId,
            data: {
                'id': btnId,
            }, 
            success: function (data) {

                console.log(data);
                $('#productSelectModel').val(data.product_id);
               $('#productSelectModel').select2(
                   {
                    theme: "bootstrap-5",
                    dropdownParent: $('#productList .modal-content')
                   }
               ).trigger('change');
               
                $('#id').val(data.id);
               $('#modelQuantity').val(data.quantity);
               $('#moduleReRate').val(data.rate);
               $('#modelDiscountA').val(data.discount_amount);
            //    $('#modelWhole').val(data.wholesale_price);
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
    
    // $('#stockSelect').select2(
    // {
    // theme: "bootstrap-5",
    // }
    // );
    $('#productSelect').select2(
    {
    theme: "bootstrap-5",
    }
    );
    $('#productSelectModel').select2(
    {
    theme: "bootstrap-5",
    dropdownParent: $('#productList .modal-content')
    }
    );

    $("#productSelectModel").change(function() {
        var product_id= $(this).val();
        // console.log(product_id);
        // alert(product_id);
        $.ajax({
        type: "GET",
        url:"/salesItem/stockSelect/"+product_id,
        data:{product_id},
        success: function(data) {
        // console.log(data);
        
        $('#moduleStocks').empty();
        $.each(data,function(index,stock){
        // console.log(stock);
        $('#moduleStocks').append('<option data-rate="'+stock.wholesale_price+'" value="'+ stock.stock_id + '">'+'Batch:-' +
            stock.batch_number + ' / '+'Qty:-'
            + stock.quantity +' / ' +'Sp:- '+ stock.wholesale_price + '</option>');
        
        })
        },
        // error: function() {
        //
        // }
        });
        });

    $("#productSelect").change(function() {
    var product_id= $(this).val();
    // console.log(product_id);
    // alert(product_id);
    $.ajax({
    type: "GET",
    url:"/salesItem/stockSelect/"+product_id, 
    data:{product_id},
    success: function(data) {
    // console.log(data);
    $('#stockSelect').show();
    $('#stocks').empty();
    $.each(data,function(index,stock){
    // console.log(stock);
    $('#stocks').append('<option data-rate="'+stock.wholesale_price+'" value="'+ stock.stock_id + '">'+'Batch:-' + stock.batch_number + ' / '+'Qty:-'
        + stock.quantity +' / ' +'Sp:- '+ stock.wholesale_price + '</option>');
    
    })
    },
    // error: function() {
    //
    // }
    });
    });
    


    // * button if no result found in product select //
    
    });
    </script>


    @endsection

    @endsection