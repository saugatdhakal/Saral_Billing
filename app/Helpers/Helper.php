<?php
use App\Libraries\Nepali_Calendar;
use Illuminate\Support\Facades\DB;
use App\Models\Config;
use App\Libraries\Format_Nepali_Money; 
use App\Libraries\Number_Into_Words;  
use Illuminate\Support\Facades\Mail;

if(!function_exists('getConfig')){
  function getConfig(){
   return Config::where('id',1)->select('name','address','email','contact_number')->first(); 
  }
  }
  if(!function_exists('creditOverDue')){
    function creditOverDue($balance,$account_id){
      
      $account = DB::table('accounts')->where('id',$account_id)->get(['name','email'])->first();
      $data['balance'] = $balance;
      $data['name'] =$account->name;

        $mail=Mail::send('Mail.CreditOverDueMail',$data,function($message) use ($account){
            $message->from('pujafancystore1@gmail.com');
            $message->to($account->email);//Receiver Email Address
            $message->subject("CREDIT OVER DUE EMAIL'.$account->name.'");
        });

    }
  }
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

if(!function_exists('getSalesReturnInvoice')){
function getSalesReturnInvoice(){
 $saleReturnInvoice= DB::table('configs')->get('sales_return_bill_number')->first();
 $fiscal_year= getFiscalYear();
 $num =str_pad($saleReturnInvoice->sales_return_bill_number,5,'0',STR_PAD_LEFT);
 $invoice= "0$fiscal_year[0]/0$fiscal_year[1]/$num";
 return $invoice;
}
}

if(!function_exists('getSalesInvoice')){
function getSalesInvoice(){
 $saleInvoice= DB::table('configs')->get('sales_bill_number')->first();
 $fiscal_year= getFiscalYear();
 $num =str_pad($saleInvoice->sales_bill_number,5,'0',STR_PAD_LEFT);
 $invoice= "0$fiscal_year[0]/0$fiscal_year[1]/$num";
 return $invoice;
}
}

if(!function_exists('getNepaliDate')){
function getNepaliDate($date){
  $splitDate= explode("-",$date);
  $cal = new Nepali_Calendar();
  $nep=$cal->eng_to_nep($splitDate[0],$splitDate[1],$splitDate[2]); 
  return ($nep["year"].'-'.$nep["month"].'-'.$nep["date"]); 
}
}
if(!function_exists('getTodayNepaliDate')){
function getTodayNepaliDate($yy,$mm,$dd){
  $splitDate= explode("-",$date);
  $cal = new Nepali_Calendar();
  $nep=$cal->eng_to_nep($yy,$mm,$dd); 
  return ($nep["year"].'-'.$nep["month"].'-'.$nep["date"]); 
}
}

if(!function_exists('nepaliCurrencyFormate')){
function nepaliCurrencyFormate($num){
    $mon = new Format_Nepali_Money();
    return $mon->money_format_nep($num);
}
}

if(!function_exists('covertShopCode')){
function covertShopCode($num){
    $code = ($num*2)+400;
    return $code;
}
}

if(!function_exists('intoWords')){
function intoWords($num){
  $words= new Number_Into_Words();
  return $words->number_to_word($num);
}
}

?>
