<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SaleItem extends Model
{
    use HasFactory;


    public function storeUpdate(SaleItem $saleItem,$request,$id){
        $stockItems = DB::table('stocks')
        ->where('stocks.id',$request->stockId)
        ->get(['stocks.rate','stocks.batch_number','stocks.wholeSale_price'])
        ->first();

        $sale = DB::table('sales')
        ->where('id',$id)
        ->get('invoice_number')->first();

        $saleItem->product_id = $request->productId;
        $saleItem->quantity = $request->quantity;

        if(!empty($request->reRate)){
           if($stockItems->wholeSale_price > $request->reRate){
             return redirect()->back()->withFail(['RE-RATE SHOULD NOT BE LESS THAN ACTUAL RATE']);     
            }
            $saleItem->rate= $request->reRate;
            $saleItem->amount= $saleItem->quantity * $request->reRate;
        }else{
            $saleItem->rate= $stockItems->wholeSale_price;
            $saleItem->amount = $saleItem->quantity * $stockItems->wholeSale_price;
        }
        if(!empty( $request->discount_amount)){
            $saleItem->discount_amount = $request->discount_amount;
        }
        $saleItem->batch_number = $stockItems->batch_number;
        $saleItem->invoice_number = $sale->invoice_number;
        $saleItem->stock_id = $request->stockId;
        $saleItem->sales_id = $id;
        $saleItem->profit_per_item = $saleItem->rate - $stockItems->rate;//* purchase cost - (reRate or WholeSale Price)
        $saleItem->profit_total = $saleItem->profit_per_item * $saleItem->quantity;
        $saleItem->save();

    }


     public static function completeSalesInvoice($request,$id){

         $saleItem = DB::table('sale_items')
        ->where('sales_id',$id)
        ->get(['amount','discount_amount']);
        
        $sumAmount = $saleItem->sum('amount');
        $sumDiscount=  $saleItem->sum('discount_amount');

        $sale = Sale::where('id',$id)->get()->first();

        $roundedAmount =ceil($sumAmount - $sumDiscount);

        if($request->pay_mode =='CHEQUE'){
            $request->validate([
                'cheque_no'=>'required|integer',
                'cheque_date'=>'required',
                'bank_name'=>'required|string',
                'account_name'=>'required|string',
                'received_amount'=>'required|integer',
            ]);
        $cheque = new Cheque();
        $cheque->account_id = $sale->account_id;
        $cheque->sales_id = $id;
        $cheque->cheque_no = $request->cheque_no;
        $cheque->date_of_cheque = $request->cheque_date;
        $cheque->bank_name = $request->bank_name;
        $cheque->account_name =$request->account_name;
        $cheque->amount = $request->received_amount;
        $cheque->save();
        } 
        $sale->total_amount = $sumAmount;
        $sale->extra_charges = empty($request->extra_charge)? 0:$request->extra_charge;
        $sale->discount_amount = empty($request->discount_amount)? 0 : $request->discount_amount;
        $sale->rounding =round($roundedAmount-($sumAmount - $sumDiscount),2);
        $sale->net_amount = ($roundedAmount + $sale->extra_charges) - $sale->discount_amount ; 
        $sale->paymode = empty($request->pay_mode) ? null : $request->pay_mode;
        
        //Received Amount not equal to received_amount then it will be due 
        if($request->received_amount != $sale->net_amount || $request->pay_mode == null){
            $sale->sales_type ="CREDIT";
        }   
        $sale->status = 'COMPLETED';
        $sale->save();
        
    }
   
}
