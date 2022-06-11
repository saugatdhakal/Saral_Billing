@extends('layouts.app')

@section('content')

<div class="m-1">
    <p style="font-size:30px;font-family:georgia,garamond,serif;">New Product Form</p>
</div>
<hr>


{{-- Error catch --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
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

<div class="row">
    <div class="col-md-10">

        <div class="container-fluid">


            <form class="row g-3 needs-validation" action="{{route('product.store')}}" method="POST" novalidate>
                @csrf

                <div class="row m-2 mt-4">
                    <div class="col-md-2  m-1" style="font-family:georgia,garamond,serif;">
                        Product Type
                    </div>
                    &#160&#160&#160&#160&#160
                    <div class="col-md-1 ">
                        <input class="form-check-input" type="radio" name="item_type" id="exampleRadios1" value="SALES"
                            checked>


                        <label class="form-check-label" for="exampleRadios1">
                            Sales
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <input class="form-check-input" type="radio" name="item_type" id="exampleRadios2"
                            value="SERVICE">
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
                        <input type="number" name="code" id="pro_code" min="0" oninput="this.value = Math.abs(this.value)" value="{{$code}}" class="form-control" required>
                        <div class="invalid-feedback">
                            Product Name is Empty!!
                        </div>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                        Product Name
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                            placeholder="Name" autofocus required>
                        <div class="invalid-feedback">
                            Product Name is Empty!!
                        </div>
                    </div>
                </div>

                <div class="row m-2" id="company">
                    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                        Product Unit
                    </div>
                    <div class="col-md-4 col-sm-12 col-lg-4  ">
                        <select class="select form-control form-select" style="width: 100%" name="unit">
                            <option value="" selected disabled>---Select Product Unit---</option>
                            <option value="mtr">MTR</option>
                            <option value="cm">CM</option>
                            <option value="pcs">PCS</option>
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
                    <div class=" col-md-4 col-sm-12 col-lg-4">
                        <select class="selects form-control form-select" style="width: 100%" name="category">
                            <option value="" selected disabled>---Select Category Unit---</option>
                            {{$rows = DB::table('categories')->where('deleted_by',NULL)->get(['id','name']);}}
                            @foreach ($rows as $row)
                            <option value={{$row->id}} >{{$row->name}}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Category is Empty !!
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
    </div>
</div>
{{-- Product Model --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-regular fa-cart-plus"></i> Add New
                    Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height:800px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <p style="font-weight: bold;font-size:18px">Category Name</p>
                                <input type="text" name="name" id="pro_code" class="form-control" required>
                                <br>
                                <div class="row ">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary m-2"><i
                                                class="fa-solid fa-plus"></i> Add Category</button>
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
    
    $('.select').select2(
        {  
        theme: "bootstrap-5",
        }
    );
        
   

    
$('.selects').select2(
{
theme: "bootstrap-5",
language: {
noResults: function() {
return `<button style="width: 100%" type="button" class="btn btn-primary prod" data-bs-toggle="modal"
    data-bs-target="#staticBackdrop">+ Add New Category</button>
</li>`;
}
},

escapeMarkup: function (markup) {
return markup;
}

}
);


   
</script>
@endsection
@endsection