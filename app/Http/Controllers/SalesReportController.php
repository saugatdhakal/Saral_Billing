<?php

namespace App\Http\Controllers;
use App\Models\SalesReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index(){
        

        $account = DB::table('accounts')->get(['id','name']);
        return view('salesReport.index',['account'=>$account,'sales'=>null,'sum'=>null]);
    }

    public function searchReport(Request $request){
        $account = DB::table('accounts')->get(['id','name']);
        $sales =SalesReport::ifCheck($request->account_id,$request->sales_type,$request->fromDate,$request->toDate);
        if($sales=='error'){
            return redirect()->back()->withFail(['Every Filed should not be Empty','Wrong Search']);     
        }
        $sum = $sales->sum('net_amount');
        return view('salesReport.index',['account'=>$account,'sales'=>$sales,'sum'=>$sum]);

    }
}
