@extends('layouts.app')

@section('content')

<div class="m-1">
    <p style="font-size:30px;font-family:georgia,garamond,serif;">New Purchase Form</p>
</div>
<hr>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
{{-- // --}}
<div class="container-fluid">
<form class="row g-3 needs-validation" action="{{route('purchase.store')}}" method="POST" novalidate>
    @csrf
    <div class="row m-2">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            Invoice Number
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control"
                value="{{$purchaseInvoice}}"
                name="invoiceNo" min="0" oninput="this.value = Math.abs(this.value)" placeholder="Invoice Number" disabled required>
            <div class="invalid-feedback">
                Invoice Number is Empty!!
            </div>
        </div>
    </div>

    <div class="row m-2" id="company">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            Supplier Name
        </div>
        <div class="col-md-4">
            <select class="selects form-control form-select" style="width: 100%" name="supplierId">
                <option value="" selected disabled>---Select Supplier ---</option>
                {{$rows = DB::table('suppliers')->where('deleted_by',NULL)->get(['id','name']);}}
                @foreach ($rows as $row)
                <option value={{$row->id}} >{{$row->name}}</option>
                @endforeach
    
            </select>
            <div class="invalid-feedback">
                Supplier is Empty !!
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            Bill Number
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="billNo" placeholder="Bill Number" required>
            <div class="invalid-feedback">
                Bill Number is Empty!!
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            Bill Date
        </div>
        <div class="col-md-4">
            <input type="date" min="2022-01-01" max="2022-12-31" class="form-control" name="billDate">
            <div class="invalid-feedback">
                Bill Date is Empty !!
            </div>
        </div>

    </div>

    <div class="row m-2">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            Issue Date
        </div>
        <div class="col-md-4">
            <input type="date" min="2022-01-01" max="2022-12-31" class="form-control" name="transactionDate">
            <div class="invalid-feedback">
                Issue Date is Empty !!
            </div>
        </div>
    </div>



    <div class="row m-2">
        <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
            LR NO
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="lrNo" placeholder="LR Number">
            <div class="invalid-feedback">
                LR Number is Empty !!
            </div>
        </div>
    </div>


    &#160&#160
    <div class="row  mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-4">&ensp;&ensp;
            <button type="submit" style="font-family:georgia,garamond,serif;"
                class="btn btn-outline-primary">Continue</button>
            &ensp;&ensp;
            <a href="{{route('purchase.index')}}">
                <button type="button" style="font-family:georgia,garamond,serif;"
                    class="btn btn-outline-danger ">Cancel</button>
            </a>
        </div>
    </div>

</form>
</div>
@section('purchase.create')
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
        // Alert 
        $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
        
        $(this).remove();
        });

        $(document).ready(function() {
        $('.selects').select2(
        {
        theme: "bootstrap-5",
            
        }
        );
        
        });
    });
</script>
@endsection
@endsection