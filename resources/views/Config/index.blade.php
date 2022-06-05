@extends('layouts.app')
@section('content')
<center>
    <h1>
        <i class="fa-solid fa-gears"></i> SOFTWARE CONFIGURE
    </h1>
</center>
<hr>
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
<form action="{{route('configuration.updateConfig')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">SOFTWARE NAME</div>
                <div class="col-md-3 mt-1">
                    <input type="text" class="form-control" name="name" value="{{$config->name}}" placeholder=" Name"
                        required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">ADDRESS</div>
                <div class="col-md-3 mt-1">
                    <input type="text" class="form-control" name="address" value="{{$config->address}}"
                        placeholder="Address" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">CONTACT NUMBER</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="contact_number" min="0"
                        value="{{$config->contact_number}}" placeholder="Numbers" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">EMAIL ADDRESS</div>
                <div class="col-md-3 mt-1">
                    <input type="email" class="form-control" name="email" value="{{$config->email}}"
                        placeholder="@gmail.com" required>
                </div>
            </div>

            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">FISCAL YEAR</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="fiscal_year" min="0"
                        value="{{$config->fiscal_year}}" placeholder="7879" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">SALES BILL NUMBER</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="sales_bill_number"
                        value="{{$config->sales_bill_number}}" min="0" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">SALES RETURN BILL NUMBER</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="sales_return_bill_number"
                        value="{{$config->sales_return_bill_number}}" min="0" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">PURCHASE BILL NUMBER</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="purchase_bill_number"
                        value="{{$config->purchase_bill_number}}" min="0" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">PURCHASE RETURN BILL NUMBER</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="purchase_return_bill_number"
                        value="{{$config->purchase_return_bill_number}}" min="0" required>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">LIMITE DUE CREDIT</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="limite_credit"
                        value="{{$config->credit_over_due_warning}}" min="0">
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-2" style="font-size:23px;margin-top:5px">MINIMUM STOCK</div>
                <div class="col-md-3 mt-1">
                    <input type="number" class="form-control" name="min_stock"
                        value="{{$config->minimum_stock_warning}}" min="0">
                </div>
            </div>

            <button type="submit" style="margin-left: 5cm;margin-top:10px" class="btn btn-primary"><i
                    class="fa-solid fa-floppy-disk-pen fa-lg"> SAVE</i></button>

        </div>
</form>
<div class="col-md-3">

    <div class="alert alert-danger" style="font-size:20px" role="alert">
        <i class="fa-solid fa-brake-warning fa-lg"> </i> UNDERSTAND SETTING BEFORE CHANGING ANYTHING!
    </div>
</div>


</div>
@section('config')
<script>
    $("#err").first().hide().slideDown(500).delay(4000).slideUp(500, function () {

$(this).remove();
});
</script>
@endsection
@endsection