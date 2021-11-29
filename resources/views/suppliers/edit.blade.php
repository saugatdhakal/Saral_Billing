@extends('layouts.app')

@section('content')

<div class="m-1">
    <p style="font-size:30px;font-family:georgia,garamond,serif;">Edit Supplier Deatils</p>
</div>
<hr>
{{-- // --}}
<form class="row g-3 needs-validation" action="{{route('supplier.update',['id'=>$suppliers->id])}}" method="POST" novalidate>
@csrf

{{-- // --}}

<div class="row m-2">
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Supplier Name
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" name="supplier_name" value="{{$suppliers->name}}" required>
        <div class="invalid-feedback">
        Supplier Name is Empty!!
        </div>  
    </div>
</div>

<div class="row m-2" id="company" >
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Contact Person Name
    </div>
    <div class="col-md-4">
        <input type="text" id="" class="form-control" value="{{$suppliers->contact_person}}" name="contact_person_name">
        <div class="invalid-feedback">
            Contact Person Name is Empty !!
        </div>  
    </div>

</div>

<div class="row m-2">
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Email
    </div>
    <div class="col-md-4">
        <input type="email" class="form-control" name="email" value="{{$suppliers->email}}">
        <div class="invalid-feedback">
        Email is Empty !!
        </div>  
    </div>
</div>


<div class="row m-2">
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Address
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" id="homeAddress"  name="address" value="{{$suppliers->address}}" required>
        <div class="invalid-feedback">
        Address is Empty !!
        </div>  
    </div>
</div>


<div class="row m-2">
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Contact Number
    </div>
    <div class="col-md-4">
        <input type="number" class="form-control " name="contact_number" value="{{$suppliers->contact_number}}"  >
        <div class="invalid-feedback">
        Contact Number is Empty !!
        </div>  
    </div>
</div>


<div class="row m-2">
    <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
        Remark
    </div>
    <div class="col-md-4">
        <textarea class="form-control" name="remark" rows="3">{{$suppliers->remark}}</textarea>
    </div>

</div>
<div class="row mt-4">
<div class="col-md-2"></div>
<div class="col-md-4">&ensp;&ensp;
<button type="submit" style="font-family:georgia,garamond,serif;" class="btn btn-outline-primary">Submit</button>
&ensp;&ensp;
<a href="{{route('supplier.index')}}">
 <button type="button" style="font-family:georgia,garamond,serif;" class="btn btn-outline-danger ">Cancel</button>
</a>
</div>
</div>

</form>
@section('supplier.edit')
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
    });
</script>
@endsection
@endsection