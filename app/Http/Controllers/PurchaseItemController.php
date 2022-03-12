<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PurchaseItemRequest ;

class PurchaseItemController extends Controller
{
   public function store(PurchaseItemRequest $request,$id){
    $item = new PurchaseItem();
    $item->storePurchase($item,$request,$id); //model
    return back();
   }
   public function getProductCode(){
      $code=Product::generateUniqueNumber();
      return $code;
   }
   public function deletePurchaseList($id){
      PurchaseItem::find($id)->delete();
   }
   public function editProductList($id){
    return DB::table('purchase_items')
        ->where('purchase_items.id',$id)
        ->select('purchase_items.id','purchase_items.product_id','purchase_items.discount_percent','purchase_items.quantity','purchase_items.rate','purchase_items.wholesale_price')
        ->get()->first();
   }
   public function updateList(PurchaseItemRequest $request){
      $item = PurchaseItem::get()->find($request->id);
      $item->storePurchase($item,$request,$item->purchase_id);
      return back();
   }

   public function completeInvoice(Request $request,$id){
       $purchase = Purchase::withSum('items','amount')
                                ->withSum('items','discount_amount')
                                ->find($id);

       $roundedAmount =ceil($purchase->total_amount - $purchase->discount_amount);
      
       $purchase->gts =(!empty($request->gst)? $request->gst : '0' ) ; //*! Need to change gts into gts database
       $purchase->extra_charges = (!empty($request->extra_amount)? $request->extra_amount : '0' );
       $purchase->status = 'COMPLETED';
       $purchase->total_amount = $purchase->items_sum_amount;
       $purchase->discount_amount = $purchase->items_sum_discount_amount;
       $purchase->rounding = round($roundedAmount-($purchase->total_amount - $purchase->discount_amount),2);
       $purchase->net_amount = $roundedAmount + $purchase->gts + $purchase->extra_amount; // *! Need to complete it net amount
       $purchase->remark = !empty($request->remark)?($request->remark) : null;   
       $purchase->save();

       return redirect()->route('purchase.index');

   }

}
