<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Stock;
use App\Models\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PurchaseItemRequest;

class PurchaseItemController extends Controller
{
   public function store(PurchaseItemRequest $request,$id){
      $repeat = PurchaseItem::checkUniqueProduct($id,$request->productId);
      if($repeat){
         return back()->withFail(['Product is repeated!! Update Exiting product or Create new']);
      }
      \DB::transaction(function()use($request,$id){
      $item = new PurchaseItem();
      $item->storeAndUpdatePurchase($item,$request,$id); //model

      $stock = new Stock();
      $item->storeAndUpdateStock($stock,$item);

      });
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
      \DB::transaction(function()use($request){
         $item = PurchaseItem::where('id',$request->id)->get()->first();
         $stock = Stock::where('purchase_item_id',$request->id)->get()->first();
         $item->storeAndUpdatePurchase($item,$request,$item->purchase_id); //Purchase Item 
         $item->storeAndUpdateStock($stock,$item); //Stock
      });
 
      return back();
   }


   public function completeInvoice(Request $request,$id){
     
       $purchase = Purchase::withSum('items','amount')
         ->withSum('items','discount_amount')
         ->find($id);
         
      \DB::transaction(function()use($purchase,$request,$id){
       PurchaseItem::invoiceSave($purchase,$request);
      
       $supplierLedger = new SupplierLedger();
      $supplierLedger->storeLedger($supplierLedger,$purchase,$purchase->supplier_id);
      
      });
       return redirect()->route('purchase.index');

   }

}
