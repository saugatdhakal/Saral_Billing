<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

use Illuminate\Support\Facades\DB;

class AccountLedgerController extends Controller
{
    public function index(){
        $account = DB::table('accounts')->get(['id','name']);
        return view('accountLedger.index',
        [
            'account'=>$account,
            'searchedAccount'=>null,
            'accountLedger'=>null,
            'drAmount'=>null,
            'crAmount'=>null,
            'sale'=>null,
            'balance'=>null,
        ]);
    }
     public function searchLedger(Request $request)
    {
          $balance =0;
          $drAmount=0;
          $crAmount=0;
        $request->validate(
            [
                'account_id'=>'required'
            ]
        );
        $sale= Sale::where('account_id',$request->account_id)->with('Saleitems.product')->get();

        $account = DB::table('accounts')->get(['id','name']);
        
        $searchedAccount = DB::table('accounts')->where('id',$request->account_id)
        ->get(['id','name','contact_number_1','email','account_type'])->first();

        
        
        $accountLedger=null;
        if(empty($request->fromDate) && empty($request->toDate)){
            $accountLedger = DB::table('account_ledgers')
            ->where('account_id',$request->account_id)
            ->get(['date','particular','invoice_number',
            'debit_amount','credit_amount','balance','sales_id']);
        }
        else{
           $accountLedger = DB::table('account_ledgers')
           ->where('account_id',$request->account_id)
           ->whereBetween('date',[$request->fromDate,$request->toDate])
           ->get(['date','particular','invoice_number','debit_amount','credit_amount','balance','sales_id']);
            
        }
        
         if(count($accountLedger)>0){
        $balance = $accountLedger->last()->balance;  
        $drAmount =$accountLedger->sum('debit_amount');
        $crAmount =$accountLedger->sum('credit_amount');
        }
  
       
      
        return view('accountLedger.index',
        [
            'account'=>$account,
            'searchedAccount'=>$searchedAccount,
            'accountLedger'=>$accountLedger,
            'drAmount'=>$drAmount,
            'crAmount'=>$crAmount,
            'sale'=>$sale,
            'balance'=>$balance
        ]);
    }
}
