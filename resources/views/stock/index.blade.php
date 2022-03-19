@extends('layouts.app')
@section('content')
<div class="row mt-2">
    <center>
        <h1 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;  ">
            Product Stock
        </h1>
    </center>
</div>
<div class="row">
</div>
<div class="card-body">
    <table class="table table-striped table-bordered  yajra-datatable" width="100%">
        <thead>
            <tr>
                <th width="5%">S.N.</th>
                <th>Product Name</th>
                <th>Category</th>
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
    var currentDate = new Date()
    var day = currentDate.getDate()
    var month = currentDate.getMonth() + 1
    var year = currentDate.getFullYear()
    var d = day + "/" + month + "/" + year;

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
        {data:'category'},
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
        'copy', 'csv', 'excel',
         {
             extend: 'pdfHtml5',
                text: 'PDF',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6],
                modifier: {
                page: 'current'
                }
                },
                customize: function(doc){
                    doc.pageMargins = [20,20,20,20];
                    doc.styles.tableHeader.fontSize = 14;
                    doc.styles.title.fontSize = 30;
                    //Table Body size
                    doc.defaultStyle.fontSize = 12;
                    //Table width
                    doc.content[1].table.widths =
                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');

                    //Footer
                    doc['footer']=(function(page, pages) {
                    return {
                    columns: [
                    'Date of Export : '+ d,
                    {
                    // This is the right column
                    alignment: 'right',
                    text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }]
                    }
                    ],
                    margin: [10, 0]
                    }
                    });
                     
                },
                header: true,
                title: 'Product Stock List',
                orientation: 'landscape',
                
                
         }
         , 
        {
            extend: 'print',
            title:'Stock List  (Date of Export) : '+ d,
           exportOptions: {
            columns: [0,1,2,3,4,5,6]
            },
            customize: function ( win ) {
              
                $(win.document.body).find( 'table' )
                .addClass( 'compact' )
                .css( 'font-size', 'inherit' );
            }
        },
        {
        extend: 'print',
        text: 'Print Product Code',
        title:'Stock List',
        exportOptions: {
        columns: [0,1,4]
        },
        customize: function ( win ) {
        $(win.document.body)
        .css( 'font-size', '10pt' )
        
        // .prepend(
        // '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
        // );
        
        $(win.document.body).find( 'table' )
        .addClass( 'compact' )
        .css( 'font-size', 'inherit' );
        }
        }
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