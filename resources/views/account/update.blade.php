@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        @if (Session::has('fail'))
        <div class="alert alert-danger" id="err">
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
<div class="m-1">
    <p style="font-size:30px">New Customer</p>
</div>
<hr>
{{-- // --}}
<form class="row g-3 needs-validation" action="{{route('account.update',['id'=>$account->id])}}" method="POST"
    novalidate>
    @csrf
    <div class="row m-2">
        <div class="col-md-2 ">
            Customer Type
        </div>
        <div class="col-md-1">
            <div class="form-check" id="bussinessRadio">
                <input class="form-check-input" type="radio" id="Business" name="CutomerType" value="BUSINESS" required>
                <label class="form-check-label" for="Business">
                    Business
                </label>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-check" id="individualRadio">
                <input class="form-check-input" type="radio" id="Individual" name="CutomerType" value="INDIVIDUAL"
                    required>
                <label class="form-check-label" for="Individual">
                    Individual
                </label>
            </div>
        </div>
    </div>
    {{-- // --}}

    <div class="row m-2">
        <div class="col-md-2 m-1">
            Customer Name
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" value="{{$account->name}}" name="name" placeholder="First Name"
                required>
            <div class="invalid-feedback">
                First Name is Empty
            </div>
        </div>
    </div>
    <div class="row m-2" id="company">
        <div class="col-md-2 m-1">
            Company Name
        </div>
        <div class="col-md-4">
            <input type="text" id="companyName" value="{{$account->shop_name}}" class="form-control" name="companyName">
            <div class="invalid-feedback">
                Company name is Empty
            </div>
        </div>

    </div>
    <div class="row m-2">
        <div class="col-md-2 m-1">
            Address
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" id="homeAddress" value="{{$account->home_address}}"
                placeholder="Home Address" name="homeAddress" required>
            <div class="invalid-feedback">
                Home Address is Empty
            </div>
        </div>
        <div class="col-md-2" id="shopAddress" class="CompanyDiv">
            <input type="text" class="form-control" id="Addressshop" value="{{$account->shop_address}}"
                placeholder="Shop Address" name="shopAddress">
            <div class="invalid-feedback">
                Shop address is Empty
            </div>
        </div>
        <div class="col-md-2" id="divAddress">
            <button type="button" id="addbtn" class="btn btn-dark">Same Address </button>
        </div>

    </div>
    <div class="row m-2">
        <div class="col-md-2 m-1">
            Email
        </div>
        <div class="col-md-4">
            <input type="email" class="form-control" value="{{$account->email}}" name="email"
                placeholder="example (abc@gmail.com)">
            <div class="invalid-feedback">
                Email is Empty
            </div>
        </div>

    </div>
    <div class="row m-2">
        <div class="col-md-2 m-1">
            Customer Phone
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" value={{$account->contact_number_1}} name="mobile1"
            placeholder="Mobile" required>
            <div class="invalid-feedback">
                Phone Number is Empty
            </div>
        </div>
        <div class="col-md-2" id="workPhone">
            <input type="number" id="WorkPhoneNo" value={{$account->contact_number_2}} class="form-control"
            name="mobile2" placeholder="Work phone" >
            <div class="invalid-feedback">
                Work phone is Empty
            </div>
        </div>
    </div>
    <div class="row m-2" id="PAN">
        <div class="col-md-2 m-1">
            PAN Number
        </div>
        <div class="col-md-4">
            <input type="number" id="Pan" value="{{$account->pan_number}}" class="form-control" name="pan">
            <div class="invalid-feedback">
                PAN Number is Empty
            </div>
        </div>
    </div>
    <div class="row m-2" id="VAT">
        <div class="col-md-2 m-1">
            VAT Number
        </div>
        <div class="col-md-4">
            <input type="number" id="Vat" value="{{$account->vat_number}}" class="form-control" name="vat">
            <div class="invalid-feedback">
                VAT Number is Empty
            </div>
        </div>

    </div>
    <div class="row m-2">
        <div class="col-md-2 m-1">
            Remark
        </div>
        <div class="col-md-4">
            <textarea class="form-control" name="remark" rows="3"> {{$account->remark}}</textarea>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-4">&ensp;&ensp;
            <button type="submit" class="btn btn-outline-primary">Submit</button>
            &ensp;&ensp;
            <a href="{{route('Account.index')}}">
                <button type="button" class="btn btn-outline-danger ">Cancel</button>
            </a>
        </div>
    </div>

</form>

@section('account.update')
<script>
    $(document).ready(function() {
        //Getting data from controller to script
        var acc = <?php echo json_encode($account->account_type); ?>;  
        
            if(acc == "BUSINESS"){
                $('#Business').click();
                radioBusiness();   
            }else{
                $('#Individual').click();
                radioIndividual();
            }
        $("#divAddress").hide();
        function radioBusiness(){
            
            $('#individualRadio').hide();
            $('#companyName').attr('required',true);
            $('#Addressshop').attr('required',true);
            $('#WorkPhoneNo').attr('required',true);
            $('#Pan').attr('required',true);
            $('#Vat').attr('required',true);
            $('#company').show();
            $('#addbtn').show();
            $('#shopAddress').show();
            $('#workPhone').show();
            $('#PAN').show();
            $('#VAT').show();
        }
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
        }
        );
        function radioIndividual(){
            $('#bussinessRadio').hide();
            $('#companyName').attr('required',false);
            $('#Addressshop').attr('required',false);
            $('#WorkPhoneNo').attr('required',false);
            $('#Pan').attr('required',false);
            $('#Vat').attr('required',false);
            $('#addbtn').hide();
            // Hiding Input Text Field
            $('#company').hide();
            $('#shopAddress').hide();
            $('#workPhone').hide();
            $('#PAN').hide();
            $('#VAT').hide();
        }
        var timer=null;
        $("#homeAddress").bind('keypress', function(){
        var radioname= $('input[name="CutomerType"]:checked').val();
        
            if (timer){
                clearTimeout(timer);
            }
            timer = setTimeout(function(){
                
                $("#divAddress").show(function(){
                    $("#addbtn").click(function(){
                        var value=$("#homeAddress").val();
                    $('#Addressshop').val(value);
                    // $value="";
                    })
                });
            }, 1000);
            
        });
    
    
    });

</script>

@endsection
@endsection