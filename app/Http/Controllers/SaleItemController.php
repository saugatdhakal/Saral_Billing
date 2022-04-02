<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Http\Requests\SaleItemRequest;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;


class SaleItemController extends Controller
{
    public function store(SaleItemRequest $request,$id){
      
        $saleItem = new SaleItem();
        $saleItem->storeUpdate($saleItem,$request,$id);
        Toastr::success('Post added successfully :)','Success');
        return redirect()->back();

        
    }

    public function updateSalesItem(SaleItemRequest $request)
    {
        $saleItem = SaleItem::find($request->id);
        $saleItem->storeUpdate($saleItem,$request,$request->id);
        return back();
    }

    public function stockSelect($id){
       return  DB::table('stocks')
        ->where('stocks.status','ACTIVE')
        ->join('purchase_items','purchase_items.id','=','stocks.purchase_item_id')
        ->where('purchase_items.product_id',$id)
        ->select(['stocks.id as stock_id','purchase_items.id as product_id','stocks.batch_number','stocks.quantity','stocks.wholesale_price'])
        ->get();
    }

    public function stockEdit($id){
        return DB::table('sale_items')
        ->where('sale_items.id',$id)
        ->get(['id','stock_id','rate','quantity','product_id','discount_amount'])->first();
        
    }
}
