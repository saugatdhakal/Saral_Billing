@extends('layouts.app')
@section('content')

<div class="row mb-3 p-0 mt-2 mr-3">

    <div class="col-md-12 clearfix ">
        <button type="button" id="add" class="btn btn-outline-primary float-right" data-bs-toggle="modal"
            data-bs-target="#category" autofouces >
            <i class="fa fa-user" aria-hidden="true"></i> Add Category
        </button>
        <a class="float-right mr-2" href="{{route('category.CategoryTrash')}}">
            <button type="button" class="btn btn-outline-danger">
                <i class="fas fa-user-times"></i> Trash Category
            </button>
        </a>
    </div>
</div>


<div class="card mb-4 m-2">
    <div class="card-header">
        <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="tdue" focusable="false" data-prefix="fas"
            data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
            <path fill="currentColor"
                d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z">
            </path>
        </svg><!-- <i class="fas fa-table me-1"></i> Font Awesome fontawesome.com -->
        Category List
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered  yajra-datatable" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th width="6%">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


{{-- Category Create Model --}}

<div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" placeholder="id" id="id" class="form-control m-2 ">
                                <input type="text" name="name" id="name" placeholder="Category Name"
                                    class="form-control m-2 ">
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

{{-- Edit Category --}}

<div class="modal fade" id="editCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <form action="{{route('category.categoryUpdate')}}" method="GET">
                                @csrf
                                <input type="hidden" name="id" placeholder="id" id="ids" value=""
                                    class="form-control m-2 ">
                                <label for="names">Category Name</label>
                                <input type="text" name="name" id="names" placeholder="Category Name" value=""
                                    class="form-control m-2 ">
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

@section('category.index')
<script>
    $(function(){
// YajraBox-Datatable
    var table=$('.yajra-datatable').DataTable({
        lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        processing:true,
        serverSide:true,
        ajax:"{{route('category.yajraTableIndex')}}",
        columns:[
            {data: 'categorynames'},
            {data: 'username'},

            {data: 'created_at'},
            {data: 'updated_at'},
            {
            data: 'action',orderable: true, searchable: true,
            },
        ]
    });
    // Editing category
    $('body').on('click', '.btnEdit', function () {
    $('#editCategory').modal('toggle');
    const id = $(this).attr("data-id");

    $.ajax({
    type: "GET",
    url:'/category/'+id+'/edit',
    data:{
    id
    },
    success: function(data) {
     //console.log(data);
    // alert(data.name);
     $('#ids').val(data.id);
    $('#names').val(data.name);
    }
    })
    });
});

$('body').on('click', '.deleteCategory', function () {
var btnId = $(this).attr("id");
swal({
title: "Are you sure?",
text: "Deleted Data will move to Trash",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {

if (willDelete) {
$.ajax({
type: "DELETE",
url:"/category/"+btnId,
data: {
"_token":$('input[name="_token"]').val(),
"id":btnId,
},
success: function(data){
// alert(data);
if(data == "DeleteSuccess"){
swal(" Your Data has been Move to Trash!!", {
icon: "success",
}).then((willDelete)=>{
location.reload();
});
}

}
})
}

});

});

</script>
@endsection
@endsection