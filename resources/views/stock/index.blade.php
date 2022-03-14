@extends('layouts.app')
@section('content')
<div class="row">

</div>
<div class="card-body">
    <table class="table table-striped table-bordered  yajra-datatable" width="100%">
        <thead>
            <tr>
                <th width="5%">S.N.</th>
                <th>Product Name</th>
                <th>Product Batch No</th>
                <th>Product Shop Code</th>
                <th>Quantity</th>
                <th>Wholesale Price</th>
                <th width="6%">Status</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@section('stock.index')
<script>
    $(function(){
    // YajraBox-Datatable
    var table =$('.yajra-datatable').DataTable({
    
    lengthMenu: [
    [ 50, 80, 100, -1 ],
    [ '50 rows', '80 rows', '100 rows', 'Show all' ]
    ],
    processing:true,
    serverSide:true,
    ajax:"{{route('stock.getIndexAjax')}}",
        columns:[
        {data: 'DT_RowIndex'},
        {data: 'product_name'},
        {data: 'batch_number' },
        {data: 'product_shop_code'},
        {data: 'quantity'},
        {data: 'wholeSale_price'},
        {
        data: 'action',orderable: true, searchable: true,
        },
        ],
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    });
   
    $('body').on('change', '#statusSwitch', function () {
        var btnId = $(this).attr("data-id");
        if ($(this).is(':checked')) {
        $.ajax({
            type: "POST",
            url:"/stock/statusSwitch/"+btnId,
            data: {
            "_token":$('input[name="_token"]').val(),
            "id":btnId,
        },
        
        });
    }
    else {
        $.ajax({
        type: "POST",
        url:"/stock/statusSwitch/"+btnId,
        data: {
        "_token":$('input[name="_token"]').val(),
        "id":btnId,
        },
        
        });
    }
    });
</script>
@endsection

@endsection