@extends('layouts.app')

@section('content')
<div class="m-1">
    <p style="font-size:30px">New Customer</p>
</div>
<hr>
{{-- // --}}
<form class="row g-3 needs-validation" action="{{route('account.update',['id'=>$account->id])}}" method="POST" novalidate>
@csrf
<div class="row m-2">
    <div class="col-md-2 ">
        Customer Type 
    </div>
    <div class="col-md-1">
        <div class="form-check">
            <input class="form-check-input" type="radio" id="Business" name="CutomerType" value="Business" >
            <label class="form-check-label" for="Business">
              Business
            </label>
          </div>
    </div>
    <div class="col-md-1">
        <div class="form-check">
            <input class="form-check-input" type="radio" id="Individual" name="CutomerType" value="Individual">
            <label class="form-check-label" for="Individual">
              Individual
            </label>
          </div>
    </div>
</div>
{{-- // --}}

<div class="row m-2">
    <div class="col-md-2 m-1">
        Primary Contact
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" name="name" value="{{$account->name}}" placeholder="First Name" required>
        <div class="invalid-feedback">
        Customer Name is Empty
        </div>  
    </div>
    
   
</div>
<div class="row m-2" id="company">
    <div class="col-md-2 m-1">
        Company Name
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" value="{{$account->shop_name}}" name="companyName" placeholder="" required>
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
        <input type="text" class="form-control" value="{{$account->home_address}}"  placeholder="Home Address" name="homeAddress" placeholder="" required>
        <div class="invalid-feedback">
        Home Address is Empty
        </div>  
    </div>
    <div class="col-md-2" id="shopAddress">
        <input type="text" class="form-control" value="{{$account->shop_address}}" id="Addressshop" placeholder="Shop Address" name="shopAddress" placeholder="" required >
        <div class="invalid-feedback">
        Shop address is Empty
        </div>  
    </div>
    <div class="col-md-2" id="divAddress">
        <button type="button"  id="addbtn" class="btn btn-dark">Same Address </button>
    </div>

</div>
<div class="row m-2">
    <div class="col-md-2 m-1">
        Email
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" value="{{$account->email}}" name="email" placeholder="" required>
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
        <input type="text" class="form-control " value="{{$account->contact_number_1}}" name="mobile1" placeholder="Mobile" required>
        <div class="invalid-feedback">
        Phone Number is Empty
        </div>  
    </div>
    <div class="col-md-2" id="workPhone">
        <input type="text" class="form-control" value="{{$account->contact_number_2}}" name="mobile2" placeholder="Work phone" >
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
        <input type="text" class="form-control" value="{{$account->pan_number}}" name="pan" placeholder="" required>
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
        <input type="text" class="form-control" value="{{$account->vat_number}}" name="vat" placeholder="" required>
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
        <textarea class="form-control"  name="remark" rows="3">{{$account->remark}}</textarea>
    </div>

</div>
<div class="row mt-4">
<div class="col-md-2"></div>
<div class="col-md-4">&ensp;&ensp;
<button type="submit" class="btn btn-outline-primary">Submit</button>
&ensp;&ensp;
<a href="{{route('Account.index')}}">
    <button type="button" class="btn btn-outline-danger ">Cancle</button>
   </a>
</div>
</div>

</form>

@section('account.create')
<script>
$(document).ready(function() {
$("#divAddress").hide();

$("#Individual").click(function(){
  $('#company').hide();
  $('#shopAddress').hide();
  $('#workPhone').hide();
  $('#PAN').hide();
  $('#VAT').hide();
});
$("#Business").click(function(){
    $('#company').show();
    $('#shopAddress').show();
    $('#workPhone').show();
    $('#PAN').show();
  $('#VAT').show();
});
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

///
});
</script>

@endsection

<script>
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
  </script>
@endsection