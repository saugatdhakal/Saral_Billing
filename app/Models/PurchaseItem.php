<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

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

    public  function storePurchase(PurchaseItem $item, $request,$id){
        $item->quantity = $request->quantity;//5
        $item->rate = $request->rate;//10
        $item->amount = $request->quantity * $request->rate; //5*10
        $item->wholesale_price = $request->wholesalePrice;//20
        $item->margin_per_item = $item->wholesale_price - $item->rate;//20-10 =10
        $item->margin_total = $request->quantity * $item->margin_per_item;//5*10
        $item->product_id = $request->productId;
        $item->purchase_id = $id;
        $item->save();
    }
}
