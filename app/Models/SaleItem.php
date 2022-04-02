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
        ->select(['stocks.rate','stocks.batch_number','stocks.wholeSale_price'])
        ->get()
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
}
