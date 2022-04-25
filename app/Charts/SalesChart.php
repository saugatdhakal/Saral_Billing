<?php

declare(strict_types = 1);

namespace App\Charts;
use App\Models\Sale;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use Illuminate\Support\Facades\DB;

use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class SalesChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
         $sales = DB::select("select sum(net_amount) as net_amount,sales_date from sales group by sales_date;");

            $date = [];
            $amount = [];
        foreach ($sales as $sale){
            array_push($date,$sale->sales_date);
            array_push($amount,$sale->net_amount);
        }
            
        return Chartisan::build()
            ->labels($date)
            ->dataset('Sales',$amount)
           ;
    }
}