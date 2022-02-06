@extends('layouts.app')

@section('content')

<div class="m-1">
    <p style="font-size:30px;font-family:georgia,garamond,serif;">Edit Product Form</p>
</div>
<hr>
{{-- Error catch --}}

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
            <div class="alert alert-danger" id="error" role="alert">
                @foreach ($errors->all() as $err)
                <li style="color:red">{{$err}}</li>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

{{-- // --}}
<div class="card  m-2">
    <form class="row g-3 needs-validation" action="/product/{{$prod->id}}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- // --}}
        <div class="row m-2 mt-4">
            <div class="col-md-2 col-sm-2 m-1" style="font-family:georgia,garamond,serif;">
                Product Type
            </div>
            &#160&#160&#160&#160&#160
            <div class="col-md-1 col-sm-3">
                <input class="form-check-input" type="radio" name="item_type" id="exampleRadios1" value="SALES" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Sales
                </label>
            </div>
            <div class="col-md-3 col-sm-3">
                <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2" value="SERVICE">
                <label class="form-check-label" for="exampleRadios2">
                    Serivce
                </label>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 col-sm-2 m-1" style="font-family:georgia,garamond,serif;">
                Product code
            </div>
            <div class="col-md-4">
                <input type="number" name="code" id="pro_code" value="{{$prod->product_code}}" class="form-control"
                   disabled required>
                <div class="invalid-feedback">
                    Product Code is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Product Name
            </div>
            <div class="col-md-4">
                <input type="text" id="name" class="form-control" value="{{$prod->name}}" name="name" placeholder="Name"
                    autofocus required>
                <div class="invalid-feedback">
                    Product Name is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Product Unit
            </div>
            <div class="col-md-4    ">
                <select class="prod_unit form-control form-select" name="unit">
                    <option value="" selected disabled>---Select Product Unit---</option>
                    <option value="mtr" {{($prod->unit == 'mtr') ? 'selected' :''}}>MTR</option>
                    <option value="cm" {{($prod->unit == 'cm') ? 'selected' :''}}>CM</option>
                    <option value="pcs" {{($prod->unit == 'pcs') ? 'selected' :''}}>PCS</option>
                </select>
                <div class="invalid-feedback">
                    Unit code is Empty !!
                </div>
            </div>

        </div>
        <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Product Category
            </div>
            <div class="col-md-4">
                <select class="prod_unit form-control form-select" name="category">
                    <option value="" selected disabled>---Select Product Unit---</option>
                    {{$rows = DB::table('categories')->where('deleted_by',NULL)->get(['id','name']);}}
                    @foreach ($rows as $row)
                    <option value="{{$row->id}}" {{($prod->category_id == $row->id) ? 'selected' :''}} >{{$row->name}}
                    </option>
                    @endforeach

                </select>
                <div class="invalid-feedback">
                    Unit code is Empty !!
                </div>
            </div>

        </div>
        &ensp;
        <div class="row mt-4 mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-4">&ensp;&ensp;
                <button type="submit" style="font-family:georgia,garamond,serif;"
                    class="btn btn-outline-primary">Submit</button>
                &ensp;&ensp;
                <a href="{{route('product.index')}}">
                    <button type="button" style="font-family:georgia,garamond,serif;"
                        class="btn btn-outline-danger ">Cancel</button>
                </a>
            </div>
        </div>


    </form>
</div>

@section('supplier.create')
<script>
    $(document).ready(function() {

        var forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call(forms).forEach( function( form)
        {
            form.addEventListener("submit", function(event) 
            {
                if(!form.checkValidity())
                {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add("was-validated");
            }, false);
        });
        
        $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
            document.getElementById('name').focus()
        $(this).remove();
        });

    });
    
    $(document).ready(function() {
    $('.prod_unit').select2(
        {
        theme: "bootstrap-5",
        }
    );
   
    });


   
</script>
@endsection
@endsection