<?php
use App\Libraries\Nepali_Calendar;
use Illuminate\Support\Facades\DB;
use App\Libraries\Format_Nepali_Money;  

if(!function_exists('getFiscalYear')){
function getFiscalYear(){
   $fiscal= DB::table('configs')->get('fiscal_year')->first();
   $split=str_split($fiscal->fiscal_year, 2);
   return $split;
}
}
if(!function_exists('getPurchaseInvoice')){
function getPurchaseInvoice(){
 $purchaseInvoice= DB::table('configs')->get('purchase_bill_number')->first();
 $fiscal_year= getFiscalYear();
 $num =str_pad($purchaseInvoice->purchase_bill_number,5,'0',STR_PAD_LEFT);
 $invoice= "0$fiscal_year[0]/0$fiscal_year[1]/$num";
 return $invoice;
}
}

if(!function_exists('getNepaliDate')){
function getNepaliDate($date){
  $cal = new Nepali_Calendar();
  return $cal->eng_to_nep($date);  
}
}

if(!function_exists('nepaliCurrencyFormate')){
function nepaliCurrencyFormate($num){
    $mon = new Format_Nepali_Money();
    return $mon->money_format_nep($num);
}
}
?>
