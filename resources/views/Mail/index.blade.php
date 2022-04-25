@extends('layouts.app')
@section('content')

<center style="margin-top:10px;">
    <h1>
        SARAL EMAIL <i class="fa-solid fa-truck-fast"> </i>
    </h1>
</center>
<hr>
<form class="row g-3 needs-validation" action="{{route('salesEmail.index',['id'=>$account->sales_id])}}" method="POST">
    @csrf
    <div class="row m-2">
        <div class="col-md-2">From</div>
        <div class="col-md-4"><input type="text" value="{{$config->email}}" class="form-control" disabled></div>
    </div>
    <div class="row m-2">
        <div class="col-md-2">To</div>
        <div class="col-md-4"><input type="text" name="email_id" class="form-control" value="{{$account->email}}"
                placeholder="Receiver Email" required></div>
    </div>
    <div class="row m-2">
        <div class="col-md-2">Subject</div>
        <div class="col-md-4"><input type="text" name="subject" class="form-control" placeholder="Subject of mail">
        </div>
    </div>
    <div class="row m-2">
        <div class="col-md-2">Content</div>
        <div class="col-md-4"><textarea type="text" name="content" class="form-control" style="width:100%;height:300%"
                placeholder="Subject of mail">
        </textarea>
        </div>

    </div>
    <div class="row">
        <div class="col-md-7" style="margin-top:130px">
            <center>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"> Send </i></button>
            </center>
        </div>
    </div>
</form>



@endsection