@extends('layouts.app')

@section('content')
<!-- Chart's container -->
<center>
    <h1>Sales Charts</h1>
</center>
<div id="chart" style="height: 300px;">

</div>
@section('salesChart')
<script>
    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sales_chart')",
        hooks: new ChartisanHooks()
        .colors(['#ECC94B', '#4299E1'])
        .responsive()
        .beginAtZero()
        .legend({ position: 'bottom' })
        .title('Daily Sales Amount')
        .datasets([{ type: 'line', fill: false,borderColor: 'rgb(75, 192, 192)', }]),
        });
</script>
@endsection
@endsection