<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\DB;


class PurchaseItem extends Model
{
    use HasFactory;
    use Userstamps;
     protected $fillable=[
        'quantity',
        'amount',
        'discount_percent',
        'discount_amount',
        'wholesale_price',
        'margin_per_item',
        'margin_total',
        'purchase_item_type',
        'product_id',
        'purchase_id',
    ];
     public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public  function storeAndUpdatePurchase(PurchaseItem $item, $request,$id){
        $item->quantity = $request->quantity;//5
        $item->rate = $request->rate;//10
        $item->discount_percent =(!empty($request->discount_percent))?$request->discount_percent:'0';
        $item->discount_amount = ($item->discount_percent == 0)? '0' : $request->discount_percent/100 * $request->rate*($request->quantity);
        $item->amount = $request->quantity * $request->rate; //5*10
        $item->wholesale_price = $request->wholesalePrice;//20
        $item->margin_per_item = $item->wholesale_price - ($item->rate - ($request->discount_percent/100 * $request->rate));
        $item->margin_total = $request->quantity * $item->margin_per_item;//5*10
        $item->product_id = $request->productId;
        $item->purchase_id = $id;
        $item->save();
    }
    public function storeAndUpdateStock($stock,$item){
        $stock->batch_number = time();
        $stock->product_shop_code = covertShopCode($item->wholesale_price);
        $stock->quantity = $item->quantity;
        $stock->wholeSale_price = $item->wholesale_price;
        $stock->purchase_item_id = $item->id;
        $stock->save();
    }

    public static function checkUniqueProduct($pur_id,$prod_id){
          $data = DB::table('purchase_items')->where('purchase_id',$pur_id)->where('product_id',$prod_id)->get(['id']); 
          if(count($data) !=0){
            return true;
         }
         return false;
    }

    public static function invoiceSave(Purchase $purchase,$request){
        $roundedAmount =ceil($purchase->items_sum_amount - $purchase->items_sum_discount_amount);
       $purchase->gts =(!empty($request->gst)? $request->gst : 0 ) ; //*! Need to change gts into gts database
       $purchase->extra_charges = (!empty($request->extra_amount)? $request->extra_amount : 0 );
       $purchase->status = 'COMPLETED';
       $purchase->total_amount = $purchase->items_sum_amount;
       $purchase->discount_amount = $purchase->items_sum_discount_amount;
       $purchase->rounding =round($roundedAmount-($purchase->total_amount - $purchase->discount_amount),2);
       $purchase->net_amount = $roundedAmount + $purchase->gts + $purchase->extra_amount; // *! Need to complete it net amount
       $purchase->remark = !empty($request->remark)?($request->remark) : null;   
       $purchase->save();
    }


}
