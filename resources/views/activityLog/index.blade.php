@extends('layouts.app')
@section('content')

<center style="margin-top: 10px">
    <h1>
        <i class="fa-solid fa-file-user"> USER ACTIVITY LOG</i>
    </h1>
</center>
<hr>
<div class="card-body">

    <table class="table" id="activity-table" width="100%">
        <thead>
            <tr>
                <th width="5%">SN</th>
                <th>Log Name</th>
                <th>Action</th>
                <th>Subject Id</th>
                <th>Subject Type</th>
                <th>Create At</th>
                <th>Update At</th>
                <th width="7%">Action</th>
            </tr>
        </thead>

        <tbody>

        </tbody>
    </table>

</div>
@section('sales.index')
<script>
    $(function(){
    // YajraBox-Datatable
     var table =$('#activity-table').DataTable({   
    lengthMenu: [
    [ 50, 70, 100, -1 ],
    [ '50 rows', '70 rows', '100 rows', 'Show all' ]
    ],
    processing:true,
    serverSide:true,
    ajax:"{{route('activityLog.ajaxActivityData')}}",
    columns:[
    {data: 'DT_RowIndex'},
    {data: 'log_name'},
    {data: 'event' },
    {data: 'subject_id'},
    {data: 'subject_type'},
    {data: 'created_at'},
    {data: 'updated_at'},
    {
    data: 'action',orderable: true, searchable: true,
    },
    ]
    });
});
</script>
@endsection
@endsection