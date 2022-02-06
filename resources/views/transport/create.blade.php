@extends('layouts.app')
@section('content')


<div class="row m-1">
    <div class="col-md-1"></div>
    <strong class="mt-2 " style="font-size:150%;">
        <ol class="breadcrumb" style="background-color: #ffffff;">
            <li class="breadcrumb-item "><a href={{route("transport.index")}}>Transport</a></li>
            <li class="breadcrumb-item active " aria-current="page">Create</li>
        </ol>
    </strong>

</div>
<h2 class="m-2">New Tranport Details</h2>
@if ($errors->any())
<div class="alert alert-danger" role="alert">

    @foreach ($errors->all() as $err)

    <li style="color:red">{{$err}}</li>
    @endforeach

</div>
@endif
<div class="card flex-center m-2">
    <form class="row g-3 mt-2 needs-validation" action="{{route('transport.store')}}" method="POST" novalidate>
        @csrf
        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Transport Name
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="name" placeholder="Transport Name" autoFocus="true"
                    required>
                <div class="invalid-feedback">
                    Transport Name is Empty!!
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Address
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="address" placeholder="Transport Address" required>
                <div class="invalid-feedback">
                    Addess is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Contact Number
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="number" placeholder="Contact Number" required>
                <div class="invalid-feedback">
                    Contact Number is Empty!!
                </div>
            </div>
        </div>

        <div class="row m-2">
            <div class="col-md-2 m-1" style="font-family:georgia,garamond,serif;">
                Remark
            </div>
            <div class="col-md-4">

                <textarea class="form-control" name="remark" placeholder="Remark" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>
        </div>

        <div class="row mt-4 mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-4">&ensp;&ensp;
                <button type="submit" style="font-family:georgia,garamond,serif;"
                    class="btn btn-outline-primary">Submit</button>
                &ensp;&ensp;
                <a href="{{route('transport.index')}}">
                    <button type="button" style="font-family:georgia,garamond,serif;"
                        class="btn btn-outline-danger ">Cancel</button>
                </a>
            </div>
        </div>
    </form>
    
    @section('transport.create')
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
</div>


@endsection