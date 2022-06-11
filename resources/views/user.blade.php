@extends('layouts.app')

@section('content')
<center class="m-2">
    <h1> <i class="fa-solid fa-users"></i> USER LIST</h1>
</center>
@if (count($errors)>0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error }} </li>
        @endforeach
    </ul>
</div>
@if (\Session::has('success'))
<div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
</div>

@endif
@endif
{{-- Error on repeated product --}}
<div class="row">
    <div class="col-md">
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
    <hr>
    <div class="row">
        <div class="col-md-12">


            <div class="row m-2">
                <div class="col-md-4"></div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addUser"
                        class="btn btn-outline-primary"><i class="fa-solid fa-user-plus"></i> ADD USER</button>
                </div>
            </div>
            {{-- <center>Total user {{Auth::user()->count()}}</center> --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Register at</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0; @endphp
                    @foreach ($user as $row)
                    <tr>
                        <td>
                            {{++$i}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}} </td>
                        <td>{{($row->isadmin == 1)? 'ADMIN':'CASHIER'}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <button style="width: 100%" type="button" class="btn btn-primary changePassword"
                                        data-bs-toggle="modal" data-id="{{$row->id}}" data-bs-target="#change_password">
                                        <i class="fa-solid fa-key"></i> Change Password</button>
                                </div>
                                <div class="col-md-4">
                                    <button style="width: 100%" type="button" class="btn btn-success edit"
                                        data-bs-toggle="modal" data-id="{{$row->id}}"
                                        data-bs-target="#change_details"><i class="fa-solid fa-user-gear"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>





    {{-- model controller for Add user --}}
    <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">NEW USER REGISTER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                <li>{{$err}}</li>
                                @endforeach



                                @endif
                                <form action="{{route('user.addUser')}}" method="GET">
                                    @csrf
                                    <input type="text" name="name" placeholder="Name" class="form-control m-2">
                                    <input type="text" name="email" placeholder="Email" class="form-control m-2 ">
                                    <input type="text" name="password" placeholder="Password" class="form-control m-2">
                                    <select name="is_admin" class="form-select m-2">
                                        <option value="0">Cashier</option>
                                        <option value="1">Admin</option>
                                    </select>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <input value="submit" type="submit"
                                                class="m-2 bg-primary btn text-white fw-bold">
                                            Create
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-secondary m-2"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of model of add User --}}



    {{-- model controller for password --}}
    <div class="modal fade" id="change_password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <form action="{{route('user.updatePassword')}}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" placeholder="id" id="ids" class="form-control m-2">
                                    <input type="text" name="first_password" id="firstPassword"
                                        placeholder="New Password" class="form-control m-2 ">
                                    <input type="text" name="second_password" id="secondPassword"
                                        placeholder="Reapet New Password" class="form-control m-2">


                                    <div class="row">
                                        <div class="col-md-3">
                                            <input value="Save" type="submit" 
                                                class="m-2 bg-primary btn text-white fw-bold">
                                            
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-secondary m-2"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of model of password --}}

    {{-- model controller for user details --}}
    <div class="modal fade" id="change_details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Users Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <form id="submitForm" action="{{route('user.updateDetails')}}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" placeholder="id" id="id" class="form-control m-2 ">
                                    <input type="text" name="name" placeholder="Name" id="names"
                                        class="form-control m-2 ">
                                    <input type="text" name="email" placeholder="Email" id="email"
                                        class="form-control m-2">
                                    <select name="is_admin" class="form-select m-2">
                                        <option value="0" {{($row->isadmin == 0)?'selected': ''}}>Cashier</option>
                                        <option value="1" {{($row->isadmin == 1)?'selected': ''}}>Admin</option>
                                    </select>


                                    <div class="row">
                                        <div class="col-md-3">
                                            <input value="submit" type="submit"
                                                class="m-2 bg-primary btn text-white fw-bold">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-secondary m-2"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of user details --}}
    @section('userDetails')
    <script>
        $(document).ready(function() {
       $(".edit").click(function(){

           const id = $(this).attr("data-id");
         
           $.ajax({
               type: "GET",
               url:"{{route('user.changeDeatils')}}",
               data:{
                   id
               },
               success: function(data) {
                //    console.log(data);
                //    alert(data.name);
                   $('#id').val(data.id);
                   $('#names').val(data.name);
                   $('#email').val(data.email);

               }
           })
       });

    });
    </script>

    <script>
        $(document).ready(function() {
        $(".changePassword").click(function(){
            const id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url:"{{route('user.changePassword')}}",
                data:{id},
                success: function(data) {
                    $('#ids').val(data.id);
                }

            })
        });

        $("#submitForm").on('submit', function(){
            
        });
    });
    // Alert
    $(".alert").first().hide().slideDown(500).delay(4000).slideUp(500, function () {
    
    $(this).remove();
    });
    </script>
    @endsection




    @endsection