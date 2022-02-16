<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
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

}
