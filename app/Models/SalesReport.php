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

    if(empty($account_id) and empty($sales_type) and empty($fromDate) and empty($toDate)){
        return 'error';
    }
    else if(!$account_id and !$sales_type and !$fromDate and $toDate){
        return 'error';
    }
    else if($account_id and !$sales_type and !$fromDate and !$toDate){
        return SalesReport::account($account_id);
    }
    else if(!$account_id and $sales_type and !$fromDate and !$toDate){
        return SalesReport::sales_type($sales_type);
    }
    else if(!$account_id and !$sales_type and $fromDate and $toDate){
        return SalesReport::fromTo($fromDate,$toDate);
    }
    else if($account_id && $sales_type && !$fromDate && !$toDate){
        return SalesReport::accountType($account_id,$sales_type);
    }
    else if($account_id && $sales_type && $fromDate && !$toDate){
        return SalesReport::accountTypeFrom($account_id,$sales_type,$fromDate);
    }
    else if($account_id && $sales_type && $fromDate && $toDate){
        return SalesReport::accountType($account_id,$sales_type,$fromDate,$toDate);
    }
   }

   public static function account($account_id){
       return DB::table('sales')
            ->where('sales.account_id',$account_id)
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }

   public static function sales_type($sales_type){
        return DB::table('sales')
            ->whereIn('sales_type',$sales_type)
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }

   public static function fromTo($fromDate,$toDate){
            return DB::table('sales')
             ->whereBetween('sales_date',[$fromDate,$toDate])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }

    public static function accountType($account_id,$sales_type){
            return DB::table('sales')
            ->where('sales.account_id',$account_id)
            ->whereIn('sales_type',$sales_type)
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();
   }

   public static function accountTypeFrom($account_id,$sales_type,$fromDate){
       return DB::table('sales')
            ->where('sales.account_id',$account_id)
            ->whereIn('sales_type',$sales_type)
            ->whereBetween('sales_date',[$fromDate,date('Y-m-d')])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }
   public static function  accountTypeFromTo($account_id,$sales_type,$fromDate,$toDate){
        return DB::table('sales')
            ->where('sales.account_id',$account_id)
            ->whereIn('sales_type',$sales_type)
            ->whereBetween('sales_date',[$fromDate,$toDate])
            ->join('accounts','accounts.id','=','sales.account_id')
            ->select(['sales.sales_date','sales.invoice_number','accounts.name','sales.net_amount','sales.sales_type'])
            ->get();

   }

}
