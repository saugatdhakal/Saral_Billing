<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalesReport;


class SalesReport extends Model
{
    use HasFactory;
    
    
   public static function ifCheck($account_id,$sales_type,$fromDate,$toDate){

    if(empty($account_id) and empty($sales_type) and empty($fromDate) and empty($toDate)){ // if every things is empty
        return 'error';
    }
    else if(!$account_id and !$sales_type and !$fromDate and $toDate){ // only to date error catch
        return 'error';
    }
    else if(!$account_id && !$sales_type && $fromDate && !$toDate){ //Only from date to search
        return SalesReport::from($fromDate);
    }
    else if($account_id and !$sales_type and !$fromDate and !$toDate){// Only ACCOUNT to search
        return SalesReport::account($account_id);
    }
    else if(!$account_id and $sales_type and !$fromDate and !$toDate){ // Only Sale Type 
        
        return SalesReport::sales_type($sales_type);
    }
    else if(!$account_id and !$sales_type and $fromDate and $toDate){ // from date and to date
        return SalesReport::fromTo($fromDate,$toDate);
    }
    else if($account_id && $sales_type && !$fromDate && !$toDate){ // account and sales types
        return SalesReport::accountType($account_id,$sales_type);
    }
    else if($account_id && $sales_type && $fromDate && !$toDate){ // account , sales types , from date
        return SalesReport::accountTypeFrom($account_id,$sales_type,$fromDate);
    }
    
    else if($account_id && $sales_type && $fromDate && $toDate){ // all selected 
        return SalesReport::accountType($account_id,$sales_type,$fromDate,$toDate);
    }
      else if($account_id && !$sales_type && $fromDate && $toDate){ // account , from date , to date
        return SalesReport::accountFromTo($account_id,$fromDate,$toDate);
    }
     else if(!$account_id && $sales_type && $fromDate && $toDate){ // sales type , from date , to date
        return SalesReport::accountFromTo($account_id,$fromDate,$toDate);
    }
   }

   public static function account($account_id){
       return DB::table('sales')
            ->where('sales.account_id',$account_id)
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }

   public static function sales_type($sales_type){
        return DB::table('sales')
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->whereIn('sales_type',$sales_type)
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();    

   }

   public static function fromTo($fromDate,$toDate){
            return DB::table('sales')
             ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
             ->whereBetween('sales_date',[$fromDate,$toDate])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }
   public static function accountFromTo($account_id,$fromDate,$toDate){
            return DB::table('sales')
             ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->where('sales.account_id',$account_id)
             ->whereBetween('sales_date',[$fromDate,$toDate])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }
    public static function accountType($account_id,$sales_type){
            return DB::table('sales')
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->where('sales.account_id',$account_id)
            ->whereIn('sales_type',$sales_type)
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }

   public static function accountTypeFrom($account_id,$sales_type,$fromDate){
       return DB::table('sales')
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->where('sales.account_id',$account_id)
            ->whereIn('sales_type',$sales_type)
            ->whereBetween('sales_date',[$fromDate,date('Y-m-d')])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }
   public static function  from($fromDate){
        return DB::table('sales')
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->whereBetween('sales_date',[$fromDate,date('Y-m-d')])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }
    public static function  salesTypeFromTo($sales_type,$fromDate,$toDate){
        return DB::table('sales')
            ->where('sales.status','COMPLETED')
            ->orWhere('sales.status','RETURN')
            ->whereIn('sales_type',$sales_type)
            ->whereBetween('sales_date',[$fromDate,$toDate])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }


}
