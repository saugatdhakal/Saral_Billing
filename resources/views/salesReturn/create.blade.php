@extends('layouts.app')

@section('content')

<div class="m-1">
    <p style="font-size:30px;font-family:georgia,garamond,serif;">New Sale Return Form</p>
</div>
<hr>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<div class="container-fluid">
    <form class="row g-3 needs-validation" action="{{route('salesReturn.store')}}" method="POST" novalidate>
        @csrf
        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Invoice Number
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" value="{{$invoice}}" name="invoiceNo"
                    placeholder="Invoice Number" disabled required>
                <div class="invalid-feedback">
                    Invoice Number is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Sale Date / Sale Invoice / Customer Name
            </div>
            <div class="col-md-4">
                <select class="selects form-select" style="width: 100%" name="salesId">
                    <option value="" selected disabled>---Select Sales Invoice ---</option>

                    @foreach ($sale as $row)
                    <option value={{$row->id}} > Date:- {{$row->sales_date}} / Invoice:- {{$row->invoice_number}}/ Name:- {{$row->name}}</option>
                    @endforeach

                </select>
                <div class="invalid-feedback">
                    Supplier is Empty !!
                </div>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Transaction Date
            </div>
            <div class="col-md-4">
                <input type="date" id="" class="form-control" name="transactionDate">
                <div class="invalid-feedback">
                    Transaction Date is Empty !!
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Sale Date
            </div>
            <div class="col-md-4">
                <input type="date" id="" class="form-control" name="saleReturnDate">
                <div class="invalid-feedback">
                    Sale Date is Empty !!
                </div>
            </div>
        </div>
        {{-- <div class="row m-2" id="company">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Sale Type
            </div>
            <div class="col-md-4">
                <select class="selects form-control form-select" style="width: 100%" name="saleType">
                    <option value="" selected disabled>---Select Sales Type ---</option>
                    <option value="DIRECT">DIRECT</option>
                    <option value="RETURN">RETURN</option>
                </select>
                <div class="invalid-feedback">
                    Sale Type is Empty !!
                </div>
            </div>
        </div> --}}


        &#160&#160
        <div class="row  mt-4">
            <div class="col-md-2"></div>
            <div class="col-md-4">&ensp;&ensp;
                <button type="submit" style="font-family:georgia,garamond,serif;"
                    class="btn btn-outline-primary">Continue</button>
                &ensp;&ensp;
                <a href="{{route('sale.index')}}">
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